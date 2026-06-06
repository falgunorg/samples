<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\SampleType;
use App\Models\User;
use App\Models\SampleImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Imports\SampleImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Company;

class SampleController extends Controller {

    public function index() {
        $buyers = Buyer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $sampleTypes = SampleType::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        $users = User::select('id', 'name')->get();

        return view('admin.samples.index', compact('buyers', 'categories', 'sampleTypes', 'users', 'companies'));
    }

    public function apiSamples(Request $request) {
        $query = Sample::with(['buyer', 'category', 'sampleType']);

        if ($request->has('buyer_filter') && $request->buyer_filter !== 'all') {
            $query->where('buyer_id', $request->buyer_filter);
        }
        if ($request->has('category_filter') && $request->category_filter !== 'all') {
            $query->where('category_id', $request->category_filter);
        }

        return DataTables::of($query)
                        ->addColumn('checkbox', function ($sample) {
                            return '<input type="checkbox" class="sample-checkbox" value="' . $sample->id . '">';
                        })
                        ->addColumn('buyer_name', function ($sample) {
                            return $sample->buyer ? $sample->buyer->name : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('category_name', function ($sample) {
                            return $sample->category ? $sample->category->name : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('sample_type', function ($sample) {
                            return $sample->sampleType ? $sample->sampleType->name : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('category', function ($sample) {
                            return $sample->category ? $sample->category->name : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('show_photo', function ($sample) {
                            // Using standard asset path relative to public/upload
                            $url = $sample->thumbnail ? asset('upload/' . $sample->thumbnail) : asset('no-image.png');
                            return '<img src="' . $url . '" class="img-thumbnail" style="width:50px; height:50px; object-fit:cover;">';
                        })
                        ->addColumn('status_label', function ($sample) {
                            return $sample->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
                        })
                        ->addColumn('action', function ($sample) {
                            return '<div class="btn-group">' .
                                    '<a href="' . route('admin.samples.show', $sample->id) . '" class="btn btn-sm btn-default" title="View Token"><i class="fa fa-eye"></i></a>' .
                                    '<a href="' . route('admin.samples.edit', $sample->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>' .
                                    '<button onclick="deleteData(' . $sample->id . ')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>' .
                                    '</div>';
                        })
                        ->rawColumns(['checkbox', 'buyer_name', 'category_name', 'sample_type', 'show_photo', 'status_label', 'action'])
                        ->make(true);
    }

    public function create() {
        $buyers = Buyer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $sampleTypes = SampleType::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        return view('admin.samples.create', compact('buyers', 'categories', 'sampleTypes', 'companies'));
    }

    public function store(Request $request) {
        $request->validate([
            'sample_name' => 'required|string|max:255',
            'style_no' => 'required|string|max:255',
            'buyer_id' => 'required|exists:buyers,id',
            'category_id' => 'required|exists:categories,id',
            'sample_type_id' => 'required|exists:sample_types,id',
            'item_type_id' => 'required|exists:item_types,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'gallery']);
        $data['featured'] = $request->has('featured');
        $data['status'] = $request->has('status');

        // Handle Main Thumbnail Upload directly into public/upload/samples
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/samples'), $filename);
            $data['thumbnail'] = 'samples/' . $filename;
        }

        $sample = Sample::create($data);

        // Handle Gallery Uploads directly into public/upload/samples/gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $imageFile) {
                $filename = 'gal_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('upload/samples/gallery'), $filename);

                $sample->images()->create([
                    'image_path' => 'samples/gallery/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.samples.index')->with('success', 'Garment Sample successfully registered!');
    }

    public function edit($id) {
        $sample = Sample::with('images')->findOrFail($id);
        $buyers = Buyer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $sampleTypes = SampleType::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');
        return view('admin.samples.edit', compact('sample', 'buyers', 'categories', 'sampleTypes', 'companies'));
    }

    public function update(Request $request, $id) {
        $sample = Sample::findOrFail($id);

        $request->validate([
            'sample_name' => 'required|string|max:255',
            'style_no' => 'required|string|max:255',
            'buyer_id' => 'required|exists:buyers,id',
            'category_id' => 'required|exists:categories,id',
            'sample_type_id' => 'required|exists:sample_types,id',
            'item_type_id' => 'required|exists:item_types,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'gallery']);
        $data['featured'] = $request->has('featured');
        $data['status'] = $request->has('status');

        if ($request->hasFile('thumbnail')) {
            // Unlink current file if existing from native public path
            if ($sample->thumbnail && File::exists(public_path('upload/' . $sample->thumbnail))) {
                File::delete(public_path('upload/' . $sample->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/samples'), $filename);
            $data['thumbnail'] = 'samples/' . $filename;
        }

        $sample->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $imageFile) {
                $filename = 'gal_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('upload/samples/gallery'), $filename);

                $sample->images()->create([
                    'image_path' => 'samples/gallery/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.samples.index')->with('success', 'Garment Sample updated successfully!');
    }

    public function show($id) {
        // Explicitly load relationships for view processing
        $sample = Sample::with(['buyer', 'category', 'sampleType', 'images'])->findOrFail($id);
        return view('admin.samples.show', compact('sample'));
    }

    public function destroy($id) {
        $sample = Sample::with('images')->findOrFail($id);

        if ($sample->thumbnail && File::exists(public_path('upload/' . $sample->thumbnail))) {
            File::delete(public_path('upload/' . $sample->thumbnail));
        }

        foreach ($sample->images as $photo) {
            if ($photo->image_path && File::exists(public_path('upload/' . $photo->image_path))) {
                File::delete(public_path('upload/' . $photo->image_path));
            }
            $photo->delete();
        }

        $sample->delete();

        return response()->json([
                    'success' => true,
                    'message' => 'Sample profile permanently purged.'
        ]);
    }

    public function deleteGalleryImage($id) {
        $image = SampleImage::findOrFail($id);

        if ($image->image_path && File::exists(public_path('upload/' . $image->image_path))) {
            File::delete(public_path('upload/' . $image->image_path));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function import(Request $request) {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new SampleImport, $request->file('excel_file'));
            return back()->with('success', 'Samples imported successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error during import: ' . $e->getMessage());
        }
    }
}

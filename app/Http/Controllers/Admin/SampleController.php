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

   public function index(Request $request) {
    $buyers = Buyer::pluck('name', 'id');
    $categories = Category::pluck('name', 'id');
    $sampleTypes = SampleType::pluck('name', 'id');
    $companies = Company::pluck('name', 'id');
    $users = User::select('id', 'name')->get();

    // Session State Management Tracker
    // If the URL has query parameters, the user is modifying filters -> Save them to session.
    // If the URL is empty but session has old data -> Use session data.
    $filterKeys = ['search', 'buyer_id', 'category_id', 'location', 'sort_by', 'sort_order', 'page'];

    if ($request->anyFilled($filterKeys) || $request->has('page')) {
        foreach ($filterKeys as $key) {
            session(['samples_index_' . $key => $request->input($key)]);
        }
    } else {
        // No explicit query parameters: Pull previously stored parameters back into the request context
        foreach ($filterKeys as $key) {
            if (session()->has('samples_index_' . $key)) {
                $request->merge([$key => session('samples_index_' . $key)]);
            }
        }
    }

    // Initialize Query Builder
    $samples = Sample::with([
        'buyer',
        'category',
        'sampleType',
        'images'
    ]);

    // Global Search
    if ($request->filled('search')) {
        $search = $request->search;
        $samples->where(function ($q) use ($search) {
            $q->where('po', 'like', "%{$search}%")
                ->orWhere('season', 'like', "%{$search}%")
                ->orWhere('style', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('color', 'like', "%{$search}%")
                ->orWhere('tag', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('qty', 'like', "%{$search}%")
                ->orWhereHas('buyer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });
    }

    // Buyer Filter
    if ($request->filled('buyer_id')) {
        $samples->where('buyer_id', $request->buyer_id);
    }

    // Category Filter
    if ($request->filled('category_id')) {
        $samples->where('category_id', $request->category_id);
    }

    // Company Filter
    if ($request->filled('company_id')) {
        $samples->where('company_id', $request->company_id);
    }

    // Sample Type Filter
    if ($request->filled('sample_type_id')) {
        $samples->where('sample_type_id', $request->sample_type_id);
    }

    // Color Filter
    if ($request->filled('color')) {
        $samples->where('color', 'like', '%' . $request->color . '%');
    }

    // Tag Filter
    if ($request->filled('tag')) {
        $samples->where('tag', 'like', '%' . $request->tag . '%');
    }

    // Location Filter
    if ($request->filled('location')) {
        $samples->where('location', 'like', '%' . $request->location . '%');
    }

    // Dynamic Sorting Logic mapping
    $sortBy = $request->sort_by ?? 'id'; 
    $sortOrder = strtolower($request->sort_order) === 'asc' ? 'asc' : 'desc';
    $allowedSorts = ['id', 'po', 'season', 'style', 'name', 'color', 'qty', 'created_at'];

    if (in_array($sortBy, $allowedSorts)) {
        $samples->orderBy($sortBy, $sortOrder);
    } else {
        $samples->orderBy('id', 'desc');
    }

    // Execute Pagination (Reads current page from the merged request context smoothly)
    $samples = $samples->paginate(50)->withQueryString();

    return view('admin.samples.index', compact(
        'buyers',
        'categories',
        'sampleTypes',
        'users',
        'companies',
        'samples'
    ));
}

    public function apiSamples(Request $request) {
        // 1. Build Query with relationships and hardcode your descending sort order directly into Eloquent
        $query = Sample::with(['buyer', 'category', 'sampleType', 'images'])
                ->orderBy('created_at', 'desc');

        // 2. Apply dropdown filters if they are active
        if ($request->has('buyer_filter') && $request->buyer_filter !== 'all' && !empty($request->buyer_filter)) {
            $query->where('buyer_id', $request->buyer_filter);
        }
        if ($request->has('category_filter') && $request->category_filter !== 'all' && !empty($request->category_filter)) {
            $query->where('category_id', $request->category_filter);
        }

        // 3. Process via DataTables engine
        return DataTables::of($query)
                        ->addColumn('checkbox', function ($sample) {
                            return '<input type="checkbox" class="sample-checkbox" value="' . $sample->id . '">';
                        })
                        ->addColumn('buyer_name', function ($sample) {
                            return $sample->buyer ? e($sample->buyer->name) : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('category_name', function ($sample) {
                            return $sample->category ? e($sample->category->name) : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('sample_type', function ($sample) {
                            return $sample->sampleType ? e($sample->sampleType->name) : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('category', function ($sample) {
                            return $sample->category ? e($sample->category->name) : '<span class="text-muted">N/A</span>';
                        })
                        ->addColumn('show_photo', function ($sample) {
                            $mainThumbRecord = $sample->images->first(function ($image) {
                                return !str_contains($image->image_path, 'gallery/');
                            });
                            $url = $mainThumbRecord ? asset('upload/samples/' . $mainThumbRecord->image_path) : asset('no-image.png');
                            return '<img src="' . $url . '" class="img-thumbnail" style="width:50px; height:50px; object-fit:cover;" onerror="this.src=\'' . asset('no-image.png') . '\'">';
                        })
                        ->addColumn('status_label', function ($sample) {
                            return strtolower($sample->status) === 'active' || $sample->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>';
                        })
                        ->addColumn('action', function ($sample) {
                            return '<div class="btn-group">' .
                                    '<a href="' . route('admin.samples.show', $sample->id) . '" class="btn btn-sm btn-default" title="View"><i class="fa fa-eye"></i></a>' .
                                    '<a href="' . route('admin.samples.edit', $sample->id) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>' .
                                    '<button onclick="deleteData(' . $sample->id . ')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>' .
                                    '</div>';
                        })
                        ->rawColumns(['checkbox', 'buyer_name', 'category_name', 'sample_type', 'category', 'show_photo', 'status_label', 'action'])

                        // Bypass Yajra DataTables dynamic query sort overrides completely
                        ->order(function ($q) {
                            // Leave this empty so DataTables doesn't try to change your Eloquent sort order
                        })
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
        ]);

        // Explicitly map inputs onto your precise Model database columns
        $data = [
            'name' => $request->input('sample_name'),
            'style' => $request->input('style_no'),
            'buyer_id' => $request->input('buyer_id'),
            'category_id' => $request->input('category_id'),
            'sample_type_id' => $request->input('sample_type_id'),
            'po' => $request->input('po'),
            'season' => $request->input('season'),
            'color' => $request->input('color'),
            'size_range' => $request->input('size_range'),
            'qty' => $request->input('qty', 0),
            'tag' => $request->input('tag', 'New Arrival'),
            'location' => $request->input('location'),
            'user_id' => auth()->id() ?? $request->input('user_id'),
            'company_id' => $request->input('company_id'),
            'featured' => $request->has('featured') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ];

        $sample = Sample::create($data);

        // Handle Thumbnail Upload -> Save raw filename into the image mapping relationship table
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/samples'), $filename);

            $sample->images()->create([
                'image_path' => $filename // Stored raw without path prefix anomalies
            ]);
        }

        // Handle Secondary Gallery Uploads -> Save into public/upload/samples/gallery/
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $imageFile) {
                $filename = 'gal_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('upload/samples/gallery'), $filename);

                $sample->images()->create([
                    'image_path' => 'gallery/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.samples.index')->with('success', 'Garment Sample successfully registered!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $sample = Sample::with('images')->findOrFail($id);
        $buyers = Buyer::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $sampleTypes = SampleType::pluck('name', 'id');
        $companies = Company::pluck('name', 'id');

        return view('admin.samples.edit', compact('sample', 'buyers', 'categories', 'sampleTypes', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $sample = Sample::findOrFail($id);

        $request->validate([
            'sample_name' => 'required|string|max:255',
            'style_no' => 'required|string|max:255',
            'buyer_id' => 'required|exists:buyers,id',
            'category_id' => 'required|exists:categories,id',
            'sample_type_id' => 'required|exists:sample_types,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048',
        ]);

        // Explicitly map updated inputs to your Model database schema properties
        $data = [
            'name' => $request->input('sample_name'),
            'style' => $request->input('style_no'),
            'buyer_id' => $request->input('buyer_id'),
            'category_id' => $request->input('category_id'),
            'sample_type_id' => $request->input('sample_type_id'),
            'po' => $request->input('po'),
            'season' => $request->input('season'),
            'color' => $request->input('color'),
            'size_range' => $request->input('size_range'),
            'qty' => $request->input('qty', 0),
            'tag' => $request->input('tag', 'New Arrival'),
            'location' => $request->input('location'),
            'company_id' => $request->input('company_id'),
            'featured' => $request->has('featured') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ];

        // Process Thumbnail Swap updates cleanly
        if ($request->hasFile('thumbnail')) {
            // Find and extract the old main image entry (doesn't contain gallery/ directory sub-string)
            $oldMainImage = $sample->images()->where('image_path', 'NOT LIKE', 'gallery/%')->first();

            if ($oldMainImage) {
                $oldFilePath = public_path('upload/samples/' . $oldMainImage->image_path);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
                $oldMainImage->delete(); // Remove old image tracking row
            }

            // Save new display thumbnail asset
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/samples'), $filename);

            $sample->images()->create([
                'image_path' => $filename
            ]);
        }

        // Apply textual update arrays directly
        $sample->update($data);

        // Process Additional Multi-Gallery Append uploads
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $imageFile) {
                $filename = 'gal_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('upload/samples/gallery'), $filename);

                $sample->images()->create([
                    'image_path' => 'gallery/' . $filename
                ]);
            }
        }

        return redirect()->route('admin.samples.index')->with('success', 'Garment Sample updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $sample = Sample::with(['buyer', 'category', 'sampleType', 'images'])->findOrFail($id);
        return view('admin.samples.show', compact('sample'));
    }

    /**
     * Remove the specified resource from storage along with all related assets.
     */
    public function destroy($id) {
        $sample = Sample::with('images')->findOrFail($id);

        // Delete all images mapped in your relationship table safely from physical disk locations
        foreach ($sample->images as $photo) {
            if ($photo->image_path) {
                $targetDiskPath = public_path('upload/samples/' . $photo->image_path);
                if (File::exists($targetDiskPath)) {
                    File::delete($targetDiskPath);
                }
            }
            $photo->delete();
        }

        // Drop parent sample data profile row natively
        $sample->delete();

        return response()->json([
                    'success' => true,
                    'message' => 'Sample profile and all image files permanently purged.'
        ]);
    }

    /**
     * Delete an isolated individual gallery image item via async interface demands.
     */
    public function deleteGalleryImage($id) {
        $image = SampleImage::findOrFail($id);

        if ($image->image_path) {
            $targetDiskPath = public_path('upload/samples/' . $image->image_path);
            if (File::exists($targetDiskPath)) {
                File::delete($targetDiskPath);
            }
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

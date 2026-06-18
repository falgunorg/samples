<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller {

    public function index() {
        return view('admin.categories.index');
    }

    public function apiData() {
        return DataTables::of(Category::query())
                        ->addColumn('image_render', function ($row) {
                            // Since $row->img now contains 'upload/categories/filename.ext', 
                            // we pass it straight to asset()
                            $url = $row->img && File::exists(public_path($row->img)) ? asset($row->img) : asset('no-image.png'); // Ensure public/no-image.png exists

                            return '<img src="' . $url . '" class="img-thumbnail" style="width:50px; height:50px; object-fit:cover;">';
                        })
                        ->addColumn('action', function ($row) {
                            return '<div class="btn-group">' .
                                    '<button onclick="editForm(' . $row->id . ')" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>' .
                                    '<button onclick="deleteData(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>' .
                                    '</div>';
                        })
                        ->rawColumns(['image_render', 'action'])
                        ->make(true);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,avif,webp|max:2048'
        ]);

        $imgRelativePath = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('upload/categories'), $filename);
            // Save the exact relative path from the public directory
            $imgRelativePath = 'upload/categories/' . $filename;
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'img' => $imgRelativePath
        ]);

        return response()->json(['success' => true, 'message' => 'Category entry saved.']);
    }

    public function edit($id) {
        return response()->json(Category::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,avif,webp|max:2048'
        ]);

        $data = ['name' => $request->name, 'slug' => Str::slug($request->name)];

        if ($request->hasFile('img')) {
            // Delete old file using the unified path format
            if ($category->img && File::exists(public_path($category->img))) {
                File::delete(public_path($category->img));
            }

            $file = $request->file('img');
            $filename = 'cat_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/categories'), $filename);

            $data['img'] = 'upload/categories/' . $filename;
        }

        $category->update($data);
        return response()->json(['success' => true, 'message' => 'Category updated.']);
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);

        // Delete file using the unified path format
        if ($category->img && File::exists(public_path($category->img))) {
            File::delete(public_path($category->img));
        }

        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category purged.']);
    }
}

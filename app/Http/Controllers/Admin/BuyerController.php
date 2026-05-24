<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BuyerController extends Controller {

    public function index() {
        return view('admin.buyers.index');
    }

    public function apiData() {
        return DataTables::of(Buyer::query())
                        ->addColumn('action', function ($row) {
                            return '<div class="btn-group"><button onclick="editForm(' . $row->id . ')" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>' .
                                    '<button onclick="deleteData(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></div>';
                        })->rawColumns(['action'])->make(true);
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        Buyer::create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
        return response()->json(['success' => true, 'message' => 'Buyer successfully registered.']);
    }

    public function edit($id) {
        return response()->json(Buyer::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $request->validate(['name' => 'required|string|max:255']);
        Buyer::findOrFail($id)->update(['name' => $request->name, 'slug' => Str::slug($request->name) . '-' . time()]);
        return response()->json(['success' => true, 'message' => 'Buyer profile updated.']);
    }

    public function destroy($id) {
        Buyer::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Buyer removed.']);
    }
}

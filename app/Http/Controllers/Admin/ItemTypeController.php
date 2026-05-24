<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemTypeController extends Controller
{
    public function index() { return view('admin.item_types.index'); }
    public function apiData() {
        return DataTables::of(ItemType::query())->addColumn('action', function($row){
            return '<div class="btn-group"><button onclick="editForm('.$row->id.')" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>'.
                   '<button onclick="deleteData('.$row->id.')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></div>';
        })->rawColumns(['action'])->make(true);
    }
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        ItemType::create($request->all());
        return response()->json(['success' => true, 'message' => 'Material Item Type appended successfully.']);
    }
    public function edit($id) { return response()->json(ItemType::findOrFail($id)); }
    public function update(Request $request, $id) {
        ItemType::findOrFail($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'Material configuration altered.']);
    }
    public function destroy($id) { ItemType::findOrFail($id)->delete(); return response()->json(['success' => true, 'message' => 'Configuration dropped.']); }
}
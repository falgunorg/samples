<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SampleType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SampleTypeController extends Controller {

    public function index() {
        return view('admin.sample_types.index');
    }

    public function apiData() {
        return DataTables::of(SampleType::query())->addColumn('action', function ($row) {
                    return '<div class="btn-group"><button onclick="editForm(' . $row->id . ')" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>' .
                            '<button onclick="deleteData(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></div>';
                })->rawColumns(['action'])->make(true);
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        SampleType::create($request->all());
        return response()->json(['success' => true, 'message' => 'Production stage verified.']);
    }

    public function edit($id) {
        return response()->json(SampleType::findOrFail($id));
    }

    public function update(Request $request, $id) {
        SampleType::findOrFail($id)->update($request->all());
        return response()->json(['success' => true, 'message' => 'Stage rules updated.']);
    }

    public function destroy($id) {
        SampleType::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Stage dropped.']);
    }
}

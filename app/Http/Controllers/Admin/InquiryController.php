<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller {

    public function index() {
        $inquiries = Inquiry::latest()->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show($id) {
        $inquiry = Inquiry::findOrFail($id);

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy($id) {
        Inquiry::findOrFail($id)->delete();

        return redirect()->back();
    }
}

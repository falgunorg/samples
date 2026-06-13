<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller {

    public function index() {
        // Fetching inquiries along with their sample relationship
        $inquiries = Inquiry::with('sample')->latest()->paginate(20);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show($id) {
        $inquiry = Inquiry::findOrFail($id);

        // Automatically mark as read when viewed
        $inquiry->update(['is_read' => true]);

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function toggleRead($id) {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_read = !$inquiry->is_read;
        $inquiry->save();

        return redirect()->back()->with('success', 'Inquiry status updated.');
    }

    public function destroy($id) {
        Inquiry::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Inquiry deleted successfully.');
    }
}

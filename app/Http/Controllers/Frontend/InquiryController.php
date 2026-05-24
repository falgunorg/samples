<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sample_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Inquiry::create($request->all());

        return redirect()->back()->with('success', 'Inquiry sent successfully');
    }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Sample;
use Illuminate\Http\Request;

class SampleController extends Controller {

    public function index(Request $request) {
        $query = Sample::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('sample_name', 'like', '%' . $request->search . '%')
                        ->orWhere('style_no', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->buyer) {
            $query->where('buyer_id', $request->buyer);
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->item_type) {
            $query->where('item_type_id', $request->item_type);
        }

        $samples = $query->latest()->paginate(12);

        $buyers = Buyer::all();
        $categories = Category::all();

        return view('frontend.samples.index', compact(
                        'samples',
                        'buyers',
                        'categories',
                ));
    }

    public function show($id) {
        $sample = Sample::with([
                    'images',
                    'buyer',
                    'category',
                ])->findOrFail($id);

        $relatedSamples = Sample::with('buyer')
                ->where('category_id', $sample->category_id)
                ->where('id', '!=', $sample->id)
                ->take(4)
                ->get();

        return view('frontend.samples.show', compact(
                        'sample',
                        'relatedSamples'
                ));
    }

    public function details() {
        return view('frontend.samples.show');
    }

    public function ajaxFilter(Request $request) {
        $samples = Sample::query();

        if ($request->search) {
            $samples->where('sample_name', 'like', '%' . $request->search . '%');
        }

        if ($request->buyer) {
            $samples->where('buyer_id', $request->buyer);
        }

        $samples = $samples->latest()->get();

        return view('frontend.samples.ajax', compact('samples'))->render();
    }
}

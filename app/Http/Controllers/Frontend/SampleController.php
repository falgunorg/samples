<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Sample;
use Illuminate\Http\Request;

class SampleController extends Controller {

    public function index(Request $request) {
        $search = trim($request->input('search'));
        $buyerFilter = $request->input('buyer');
        $categoryFilter = $request->input('category');

        // 1. Build Query with eager loading relationships
        $query = Sample::with(['buyer', 'category', 'images'])->has('images');

        $query->where(function ($q) {
            $q->where('status', 'active')
                    ->orWhere('status', 'Active')
                    ->orWhere('status', '1');
        });

        // Apply Filters
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('style', 'LIKE', "%{$search}%")
                        ->orWhere('po', 'LIKE', "%{$search}%");
            });
        }

        if ($buyerFilter && !in_array($buyerFilter, ['All Buyers', 'All', ''])) {
            $query->whereHas('buyer', function ($q) use ($buyerFilter) {
                $q->where('name', $buyerFilter);
            });
        }

        if ($categoryFilter && !in_array($categoryFilter, ['All Categories', 'All', ''])) {
            $query->whereHas('category', function ($q) use ($categoryFilter) {
                $q->where('name', $categoryFilter);
            });
        }

        // Paginate matching records
        $samples = $query->latest()->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return view('frontend.samples.partials.grid_items', compact('samples'))->render();
        }

        // Dropdown populations
        $buyers = Buyer::has('samples')->get();
        if ($buyers->isEmpty()) {
            $buyers = Buyer::all();
        }

        // Full Category list for original select dropdown options
        $allCategories = Category::has('samples')->get();
        if ($allCategories->isEmpty()) {
            $allCategories = Category::all();
        }

        // Dynamic extraction of TOP 5 categories by total active samples
        $topCategories = Category::withCount(['samples' => function ($q) {
                        $q->where('status', 'active')->orWhere('status', 'Active')->orWhere('status', '1');
                    }])->orderBy('samples_count', 'desc')->take(11)->get();

        return view('frontend.samples.index', compact('samples', 'buyers', 'allCategories', 'topCategories'));
    }

    public function show($id) {
        $sample = Sample::with(['buyer', 'category', 'images', 'sampleType'])->findOrFail($id);
        $relatedSamples = Sample::with(['buyer', 'category'])
                ->where('category_id', $sample->category_id)
                ->where('id', '!=', $sample->id)
                ->limit(4)
                ->get();

        return view('frontend.samples.show', compact('sample', 'relatedSamples'));
    }

    public function storeInquiry(Request $request, $id) {
        $sample = Sample::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);
        $validated['sample_id'] = $sample->id;
        \App\Models\Inquiry::create($validated);

        return redirect()->back()->with('success', 'Your inquiry has been sent successfully!');
    }
}

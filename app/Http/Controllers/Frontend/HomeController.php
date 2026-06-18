<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Sample;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        $featuredSamples = Sample::latest()
                ->where('featured', 1)
                ->take(8)
                ->get();

        $latestSamples = Sample::latest()
                ->take(12)
                ->get();
        $samples = Sample::latest()
                ->take(12)
                ->get();

        $buyers = Buyer::all();
        $categories = Category::whereNotNull('img')
                ->where('img', '!=', '')
                ->withCount('samples')
                ->orderBy('samples_count', 'desc')
                ->take(16)
                ->get();

        return view('frontend.home', compact(
                        'featuredSamples',
                        'latestSamples',
                        'samples',
                        'buyers',
                        'categories'
                ));
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function categories(Request $request) {
        $search = trim($request->input('search'));

        $query = Category::withCount('samples')
                ->orderBy('samples_count', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        $categories = $query->paginate(12)->withQueryString();

        // --- ADD THIS AJAX CHECK ---
        if ($request->ajax()) {
            // Renders only the grid item views and provides metadata for the JS script
            $html = '';
            foreach ($categories as $cat) {
                $html .= '
    <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in">
        <a href="' . route('categories.show', $cat->slug) . '">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm category-card">
                <img src="' . asset($cat->img) . '" class="w-100 category-img" alt="' . $cat->name . '" style="height: 380px; background: #ffcd39; object-fit: contain;"> 
                <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                    <h6 class="text-white fw-bold mb-0">' . $cat->name . '</h6>
                    <small class="text-warning">' . $cat->samples_count . ' Samples</small>
                </div>
            </div>
        </a>
    </div>';
            }

            return response()->json([
                        'html' => $html,
                        'nextPageUrl' => $categories->nextPageUrl(),
                        'hasMorePages' => $categories->hasMorePages()
            ]);
        }
        // ----------------------------

        return view('frontend.categories.index', compact('categories'));
    }

    // Add Category model import if missing: use App\Models\Category;

    public function category_details(Request $request, $slug) {
        // 1. Find the specific category or fail cleanly
        $category = Category::where('slug', $slug)->firstOrFail();

        $search = trim($request->input('search'));
        $buyerName = $request->input('buyer');

        // 2. Fetch dependencies for filter elements
        $buyers = \App\Models\Buyer::all();
        $allCategories = Category::all();
        $topCategories = Category::withCount('samples')
                ->orderBy('samples_count', 'desc')
                ->take(5)
                ->get();

        // 3. Query the samples belonging explicitly to this category
        $query = $category->samples()->latest();

        // Apply Filter Actions
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('style_no', 'LIKE', "%{$search}%"); // assuming style_no exists
            });
        }

        if (!empty($buyerName) && $buyerName !== 'All Buyers') {
            $query->whereHas('buyer', function ($q) use ($buyerName) {
                $q->where('name', $buyerName);
            });
        }

        $samples = $query->paginate(12)->withQueryString();

        // 4. Return raw HTML response cleanly if requested via AJAX load-more request
        if ($request->ajax()) {
            return view('frontend.samples.partials.grid_items', compact('samples'))->render();
        }

        return view('frontend.categories.show', compact('category', 'samples', 'buyers', 'allCategories', 'topCategories'));
    }
}

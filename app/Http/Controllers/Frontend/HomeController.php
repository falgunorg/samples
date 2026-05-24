<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Sample;

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
        $categories = Category::all();

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
}

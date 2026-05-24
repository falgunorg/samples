@extends('layouts.guest')

@section('title', 'FALGUN | Premium Sample Collection')

@section('content')
<div class="page-sample-index">

    <!-- =========================================
    NAVBAR
    ========================================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">

        <div class="container">

            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">
                FALGUN
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('samples.index') }}">
                            Samples
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#categories">
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#factories">
                            Factories
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('contact') }}"
                           class="btn btn-warning rounded-pill px-4 fw-semibold">
                            Contact Us
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>



    <!-- =========================================
    SAMPLES SECTION
    ========================================= -->
    <section class="py-5 bg-white">

        <div class="container">

            @php

            $samples = [

            [
            'id'=>1,
            'name'=>'Oversized Premium Tee',
            'buyer'=>'ZARA',
            'category'=>'T-Shirts',
            'img'=>'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'id'=>2,
            'name'=>'Luxury Denim Jacket',
            'buyer'=>'H&M',
            'category'=>'Denim',
            'img'=>'https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'id'=>3,
            'name'=>'Modern Activewear',
            'buyer'=>'NIKE',
            'category'=>'Sportswear',
            'img'=>'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'id'=>4,
            'name'=>'Premium Polo Collection',
            'buyer'=>'PUMA',
            'category'=>'Polo',
            'img'=>'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'id'=>5,
            'name'=>'Luxury Hoodie',
            'buyer'=>'ADIDAS',
            'category'=>'Hoodies',
            'img'=>'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'id'=>6,
            'name'=>'Formal Shirt Series',
            'buyer'=>'MANGO',
            'category'=>'Formal Wear',
            'img'=>'https://images.unsplash.com/photo-1603252109303-2751441dd157?q=80&w=1200&auto=format&fit=crop'
            ]

            ];

            @endphp

            <!-- TITLE -->
            <div class="position-relative">
                <div class="row align-items-center g-4">

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-3">

                        <span class="filter-mini-title">
                            FIND YOUR STYLE
                        </span>

                        <h3 class="fw-bold mb-2">
                            Filter Samples
                        </h3>

                        <p class="text-muted small mb-0">
                            Search premium apparel collections by buyer, category, or garment type.
                        </p>

                    </div>

                    <!-- FILTER FORM -->
                    <div class="col-lg-9">

                        <form method="GET">

                            <div class="row g-3">

                                <!-- SEARCH -->
                                <div class="col-lg-4">

                                    <div class="modern-input-group">

                                        <span class="input-icon">
                                            <i class="fas fa-search"></i>
                                        </span>

                                        <input type="text"
                                               class="form-control modern-input"
                                               placeholder="Search samples...">

                                    </div>

                                </div>

                                <!-- BUYER -->
                                <div class="col-lg-3">

                                    <div class="modern-select-group">

                                        <span class="input-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </span>

                                        <select class="form-select modern-select">

                                            <option>All Buyers</option>
                                            <option>ZARA</option>
                                            <option>H&M</option>
                                            <option>NIKE</option>
                                            <option>PUMA</option>

                                        </select>

                                    </div>

                                </div>

                                <!-- CATEGORY -->
                                <div class="col-lg-3">

                                    <div class="modern-select-group">

                                        <span class="input-icon">
                                            <i class="fas fa-tags"></i>
                                        </span>

                                        <select class="form-select modern-select">

                                            <option>All Categories</option>
                                            <option>T-Shirts</option>
                                            <option>Denim</option>
                                            <option>Sportswear</option>
                                            <option>Formal Wear</option>

                                        </select>

                                    </div>

                                </div>

                                <!-- BUTTON -->
                                <div class="col-lg-2">

                                    <button class="btn filter-btn w-100">
                                        Apply
                                    </button>

                                </div>

                            </div>

                            <!-- QUICK TAGS -->
                            <div class="mt-4 d-flex flex-wrap gap-2">

                                <span class="quick-filter active">
                                    All
                                </span>

                                <span class="quick-filter">
                                    New Arrival
                                </span>

                                <span class="quick-filter">
                                    Trending
                                </span>

                                <span class="quick-filter">
                                    Streetwear
                                </span>

                                <span class="quick-filter">
                                    Denim
                                </span>

                                <span class="quick-filter">
                                    Activewear
                                </span>
                                <span class="quick-filter">
                                    Nightwear
                                </span>
                                <span class="quick-filter">
                                    Sportswear
                                </span>


                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <br/>

            <!-- GRID -->
            <div class="row g-4">

                @foreach($samples as $sample)

                <div class="col-lg-4 col-md-6" data-aos="fade-up">

                    <div class="base-sample-card bg-white rounded-4 overflow-hidden shadow-sm">

                        <!-- IMAGE -->
                        <div class="sample-image-wrapper position-relative">

                            <img src="{{ $sample['img'] }}"
                                 class="sample-image">

                            <!-- CATEGORY -->
                            <div class="position-absolute top-0 start-0 p-3">

                                <span class="badge bg-danger px-3 py-2">
                                    {{ $sample['category'] }}
                                </span>

                            </div>

                            <!-- WISHLIST -->
                            <div class="position-absolute top-0 end-0 p-3">

                                <button class="btn btn-light rounded-circle shadow-sm wishlist-btn">
                                    <i class="far fa-heart"></i>
                                </button>

                            </div>

                        </div>

                        <!-- CONTENT -->
                        <div class="p-4">

                            <!-- BUYER -->
                            <small class="text-warning fw-bold text-uppercase">
                                {{ $sample['buyer'] }}
                            </small>

                            <!-- NAME -->
                            <h5 class="fw-bold mt-2 sample-title">
                                {{ $sample['name'] }}
                            </h5>

                            <!-- DESCRIPTION -->
                            <p class="text-muted small">
                                Premium export-quality apparel designed for global fashion brands.
                            </p>

                            <!-- FOOTER -->
                            <div class="d-flex justify-content-between align-items-center">

                                <a href="{{ route('samples.details') }}"
                                   class="btn btn-dark rounded-pill px-4">
                                    View Details
                                </a>

                                <span class="text-muted small">
                                    New Arrival
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>
            <br/>
            <br/>

            <div class="text-center">
                <a class="btn btn-outline-dark btn-lg rounded-pill px-4" href="#">
                    LOAD MORE
                </a>
            </div>

        </div>

    </section>

    <!-- =========================================
    CTA SECTION
    ========================================= -->
    <section class="py-5 bg-dark text-white text-center">

        <div class="container py-4">

            <h2 class="fw-bold">
                Looking For Custom Apparel Manufacturing?
            </h2>

            <p class="text-light opacity-75 mt-3">
                Contact FALGUN for premium garment production solutions.
            </p>

            <a href="#"
               class="btn btn-warning btn-lg rounded-pill px-5 mt-3">
                Contact Us
            </a>

        </div>

    </section>

</div>
@endsection
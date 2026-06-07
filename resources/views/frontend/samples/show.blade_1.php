@extends('layouts.guest')

@section('title', 'Premium Sample Details | FALGUN')

@section('content')

@php

$sample = [
'id' => 1,
'name' => 'Premium Oversized Streetwear Hoodie',
'buyer' => 'ZARA',
'category' => 'Streetwear',
'fabric' => '100% Cotton Fleece',
'gsm' => '320 GSM',
'color' => 'Jet Black',
'description' => 'Premium export-quality oversized hoodie designed for modern street fashion brands with high-end finishing and comfort fit.',

'thumbnail' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1400&auto=format&fit=crop',

'gallery' => [

'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop',

'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop',

'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1200&auto=format&fit=crop',

]

];

$relatedSamples = [

[
'name'=>'Luxury Denim Jacket',
'buyer'=>'H&M',
'img'=>'https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=1200&auto=format&fit=crop'
],

[
'name'=>'Modern Sportswear Set',
'buyer'=>'NIKE',
'img'=>'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop'
],

[
'name'=>'Premium Polo Collection',
'buyer'=>'PUMA',
'img'=>'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop'
]

];

@endphp


<div class="page-sample-details">

    <!-- =========================================
    NAVBAR
    ========================================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">

        <div class="container">

            <a class="navbar-brand fw-bold fs-3"
               href="{{ route('home') }}">
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
                        <a class="nav-link"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"
                           href="{{ route('samples.index') }}">
                            Samples
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">

                        <a href="#inquiry"
                           class="btn btn-warning rounded-pill px-4 fw-semibold">
                            Send Inquiry
                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- =========================================
    BREADCRUMB
    ========================================= -->
    <section class="bg-light border-bottom py-3">

        <div class="container">

            <nav>

                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"
                           class="text-decoration-none">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('samples.index') }}"
                           class="text-decoration-none">
                            Samples
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        {{ $sample['name'] }}
                    </li>

                </ol>

            </nav>

        </div>

    </section>

    <!-- =========================================
    DETAILS SECTION
    ========================================= -->
    <section class="py-5 bg-white">

        <div class="container">

            <div class="row g-5">

                <!-- LEFT -->
                <div class="col-lg-6">

                    <!-- MAIN IMAGE -->
                    <div class="main-image-card rounded-4 overflow-hidden shadow-sm">

                        <img src="{{ $sample['thumbnail'] }}"
                             class="sample-main-image">

                    </div>

                    <!-- GALLERY -->
                    <div class="row g-3 mt-3">

                        @foreach($sample['gallery'] as $img)

                        <div class="col-4">

                            <div class="gallery-thumb overflow-hidden rounded-4">

                                <img src="{{ $img }}"
                                     class="gallery-image">

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-6">

                    <!-- CATEGORY -->
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        {{ $sample['category'] }}
                    </span>

                    <!-- TITLE -->
                    <h1 class="display-5 fw-bold mt-3">
                        {{ $sample['name'] }}
                    </h1>

                    <!-- BUYER -->
                    <div class="d-flex align-items-center gap-3 mt-4">

                        <div class="buyer-logo">
                            {{ substr($sample['buyer'],0,1) }}
                        </div>

                        <div>

                            <small class="text-muted d-block">
                                Buyer
                            </small>

                            <strong>
                                {{ $sample['buyer'] }}
                            </strong>

                        </div>

                    </div>

                    <!-- DESCRIPTION -->
                    <p class="lead text-muted mt-4">
                        {{ $sample['description'] }}
                    </p>

                    <!-- INFO -->
                    <div class="row g-4 mt-3">

                        <div class="col-md-6">

                            <div class="sample-info-card">

                                <small class="text-muted d-block">
                                    Fabric
                                </small>

                                <strong>
                                    {{ $sample['fabric'] }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="sample-info-card">

                                <small class="text-muted d-block">
                                    GSM
                                </small>

                                <strong>
                                    {{ $sample['gsm'] }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="sample-info-card">

                                <small class="text-muted d-block">
                                    Color
                                </small>

                                <strong>
                                    {{ $sample['color'] }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="sample-info-card">

                                <small class="text-muted d-block">
                                    MOQ
                                </small>

                                <strong>
                                    3000 PCS
                                </strong>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex gap-3 flex-wrap mt-5">

                        <a href="#inquiry"
                           class="btn btn-dark btn-lg rounded-pill px-5">
                            Send Inquiry
                        </a>

                        <button class="btn btn-outline-dark btn-lg rounded-pill px-4">

                            <i class="far fa-heart me-2"></i>
                            Wishlist

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
    RELATED ITEMS
    ========================================= -->
    <section class="py-5 bg-white">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-5">

                <div>

                    <span class="text-warning fw-bold text-uppercase small">
                        More Samples
                    </span>

                    <h2 class="fw-bold mb-0">
                        Related Collections
                    </h2>

                </div>

                <a href="{{ route('samples.index') }}"
                   class="btn btn-outline-dark rounded-pill px-4">
                    View All
                </a>

            </div>

            <div class="row g-4">

                @foreach($relatedSamples as $item)

                <div class="col-lg-4 col-md-6">

                    <div class="related-card">

                        <div class="overflow-hidden">

                            <img src="{{ $item['img'] }}"
                                 class="related-image">

                        </div>

                        <div class="p-4">

                            <small class="text-warning fw-bold">
                                {{ $item['buyer'] }}
                            </small>

                            <h5 class="fw-bold mt-2">
                                {{ $item['name'] }}
                            </h5>

                            <p class="text-muted small">
                                Premium export-quality apparel collection.
                            </p>

                            <a href="#"
                               class="btn btn-dark rounded-pill px-4">
                                View Details
                            </a>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- =========================================
    INQUIRY SECTION
    ========================================= -->
    <section id="inquiry" class="py-5 bg-light">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">

                    <div class="inquiry-card">

                        <div class="text-center mb-5">

                            <span class="text-warning fw-bold text-uppercase small">
                                Inquiry Form
                            </span>

                            <h2 class="fw-bold">
                                Interested In This Sample?
                            </h2>

                            <p class="text-muted">
                                Send us your inquiry and our merchandising team will contact you.
                            </p>

                        </div>

                        <form>

                            <div class="row g-4">

                                <!-- NAME -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Full Name
                                    </label>

                                    <input type="text"
                                           class="form-control modern-field"
                                           placeholder="Your Name">

                                </div>

                                <!-- EMAIL -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Email Address
                                    </label>

                                    <input type="email"
                                           class="form-control modern-field"
                                           placeholder="Your Email">

                                </div>

                                <!-- PHONE -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Phone Number
                                    </label>

                                    <input type="text"
                                           class="form-control modern-field"
                                           placeholder="Phone Number">

                                </div>

                                <!-- COMPANY -->
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Company Name
                                    </label>

                                    <input type="text"
                                           class="form-control modern-field"
                                           placeholder="Company Name">

                                </div>

                                <!-- MESSAGE -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold">
                                        Message
                                    </label>

                                    <textarea rows="6"
                                              class="form-control modern-field"
                                              placeholder="Write your inquiry..."></textarea>

                                </div>

                                <!-- BUTTON -->
                                <div class="col-12">

                                    <button class="btn btn-dark btn-lg rounded-pill px-5">
                                        Send Inquiry
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>
                <div class="col-lg-5">

                    <!-- RIGHT SIDE DESIGN -->
                    <div class="position-relative h-100">

                        <!-- MAIN CARD -->
                        <div class="contact-side-card position-relative overflow-hidden">

                            <!-- TOP -->
                            <div class="mb-4">

                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                    WHY FALGUN
                                </span>

                                <!--                            <h3 class="fw-bold mt-4 text-white">
                                                                Premium Apparel Manufacturing Partner
                                                            </h3>
                                
                                                            <p class="text-light opacity-75 mt-3">
                                                                From concept to production, FALGUN delivers world-class garments
                                                                with modern manufacturing facilities and strong compliance standards.
                                                            </p>-->

                            </div>

                            <!-- FEATURES -->
                            <div class="d-flex flex-column gap-3 ">

                                <!-- ITEM -->
                                <div class="feature-box">

                                    <div class="feature-icon">
                                        <i class="fas fa-tshirt"></i>
                                    </div>

                                    <div>

                                        <h6 class="fw-bold text-white mb-1">
                                            Premium Quality
                                        </h6>

                                        <small class="text-light opacity-75">
                                            Export-quality garments with strict QC process
                                        </small>

                                    </div>

                                </div>

                                <!-- ITEM -->
                                <div class="feature-box">

                                    <div class="feature-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>

                                    <div>

                                        <h6 class="fw-bold text-white mb-1">
                                            Global Buyers
                                        </h6>

                                        <small class="text-light opacity-75">
                                            Serving international fashion brands worldwide
                                        </small>

                                    </div>

                                </div>

                                <!-- ITEM -->
                                <div class="feature-box">

                                    <div class="feature-icon">
                                        <i class="fas fa-industry"></i>
                                    </div>

                                    <div>

                                        <h6 class="fw-bold text-white mb-1">
                                            3 Modern Factories
                                        </h6>

                                        <small class="text-light opacity-75">
                                            Knit, woven and denim manufacturing units
                                        </small>

                                    </div>

                                </div>

                                <!-- ITEM -->
                                <div class="feature-box">

                                    <div class="feature-icon">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>

                                    <div>

                                        <h6 class="fw-bold text-white mb-1">
                                            Fast Production
                                        </h6>

                                        <small class="text-light opacity-75">
                                            Efficient production & timely shipment delivery
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <!-- STATS -->
                            <div class="row mt-3">

                                <div class="col-4">

                                    <div class="mini-stat-card">

                                        <h4 class="fw-bold mb-1">
                                            40+
                                        </h4>

                                        <small>
                                            Years
                                        </small>

                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="mini-stat-card">

                                        <h4 class="fw-bold mb-1">
                                            20+
                                        </h4>

                                        <small>
                                            Countries
                                        </small>

                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="mini-stat-card">

                                        <h4 class="fw-bold mb-1">
                                            500K+
                                        </h4>

                                        <small>
                                            Capacity
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <!-- FLOATING CIRCLE -->
                            <div class="floating-circle"></div>

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </section>
</div>

@endsection
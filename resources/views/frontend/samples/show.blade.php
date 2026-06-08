@extends('layouts.guest')

@section('title', $sample->name . ' | FALGUN')

@section('content')
<div class="page-sample-details">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">FALGUN</a>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('samples.index') }}">Samples</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="#inquiry" class="btn btn-warning rounded-pill px-4 fw-semibold">Send Inquiry</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BREADCRUMB -->
    <section class="bg-light border-bottom py-3">
        <div class="container">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('samples.index') }}" class="text-decoration-none">Samples</a></li>
                    <li class="breadcrumb-item active">{{ $sample->name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- DETAILS SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                <!-- LEFT GALLERY SIDE -->
                <div class="col-lg-6">
                    <!-- MAIN HERO IMAGE (Reads directly from public/upload/samples/) -->
                    <div style="text-align: center; padding: 15px" class="main-image-card rounded-4 overflow-hidden   mb-3">
                        @php 
                        $firstImageRecord = $sample->images->first();

                        // Build the source link: if image path contains 'gallery/', point there; otherwise use main folder.
                        if ($firstImageRecord) {
                        $isGalleryFile = str_contains($firstImageRecord->image_path, 'gallery/');
                        $firstImg = $isGalleryFile 
                        ? asset('upload/samples/' . $firstImageRecord->image_path)
                        : asset('upload/samples/' . $firstImageRecord->image_path);
                        } else {
                        $firstImg =asset('no-image.png'); ;
                        }
                        @endphp
                        <img src="{{ $firstImg }}" 
                             class="sample-main-image" 
                             id="expandedImg" 
                             alt="{{ $sample->name }}" 
                             style="width:100%; height: 100%; object-fit: cover; border-radius: 15px">
                    </div>

                    <!-- RECURSIVE SUB-THUMBNAILS GALLERY -->
                    @if($sample->images->count() > 1)
                    <div class="row g-3 mt-2">
                        @foreach($sample->images as $img)
                        <div class="col-4">
                            <div class="gallery-thumb overflow-hidden rounded-4 border" 
                                 style="cursor:pointer; height: 110px;"
                                 onclick="switchPreview(this.querySelector('img').src)">

                                <!-- Simply append the string value directly since database values already track folder context perfectly -->
                                <img src="{{ asset('upload/samples/' . $img->image_path) }}" 
                                     class="gallery-image" 
                                     alt="Gallery image asset"
                                     style="width:100%; height:100%; object-fit: cover;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- RIGHT SPECS SIDE -->
                <div class="col-lg-6">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        {{ $sample->category->name ?? 'Apparel' }}
                    </span>

                    <h1 class="display-5 fw-bold mt-3">{{ $sample->name }}</h1>

                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="buyer-logo bg-dark text-white d-flex align-items-center justify-content-center rounded-circle" style="width:50px; height:50px; font-weight:bold;">
                            {{ substr($sample->buyer->name ?? 'F', 0, 1) }}
                        </div>
                        <div>
                            <small class="text-muted d-block">Buyer</small>
                            <strong>{{ $sample->buyer->name ?? 'International Brand' }}</strong>
                        </div>
                    </div>

                    <p class="lead text-muted mt-4">
                        Premium export-quality garment sample. Designed meticulously keeping compliance, comfort fit, and high-end texture alignment parameters intact.
                    </p>

                    <!-- SPECS MATRIX -->
                    <div class="row g-4 mt-3">
                        <div class="col-md-6">
                            <div class="sample-info-card p-3 border rounded">
                                <small class="text-muted d-block">Season / Type</small>
                                <strong>{{ $sample->season ?? 'All Season' }} / {{ $sample->sampleType->name ?? 'Production' }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sample-info-card p-3 border rounded">
                                <small class="text-muted d-block">Color</small>
                                <strong>{{ $sample->color ?? 'As per request' }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sample-info-card p-3 border rounded">
                                <small class="text-muted d-block">Tag</small>
                                <strong>{{ $sample->tag ?? 'N/A' }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sample-info-card p-3 border rounded">
                                <small class="text-muted d-block">Style</small>
                                <strong>{{ $sample->style ?? "N/A" }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 flex-wrap mt-5">
                        <a href="#inquiry" class="btn btn-dark btn-lg rounded-pill px-5">Send Inquiry</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RELATED ITEMS -->
    <section class="py-5 bg-white border-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <span class="text-warning fw-bold text-uppercase small">More Samples</span>
                    <h2 class="fw-bold mb-0">Related Collections</h2>
                </div>
                <a href="{{ route('samples.index') }}" class="btn btn-outline-dark rounded-pill px-4">View All</a>
            </div>

            <div class="row g-4">
                @foreach($relatedSamples as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="related-card border rounded p-3 shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="overflow-hidden rounded-3">
                                @php
                                // Filter the eager-loaded collection memory safely for the main profile image
                                $itemThumbRecord = $item->images->first(function ($image) {
                                return !str_contains($image->image_path, 'gallery/');
                                });

                                // Match path directly against public/upload/samples/
                                $itemThumbUrl = $itemThumbRecord 
                                ? asset('upload/samples/' . $itemThumbRecord->image_path) 
                                : asset('no-image.png') ;
                                @endphp

                                <img src="{{ $itemThumbUrl }}" 
                                     class="related-image" 
                                     alt="{{ $item->name }}"
                                     style="width:100%; height:250px; object-fit:cover;"
                                     onerror="this.src='{{ asset('no-image.png') }}'">
                            </div>

                            <div class="pt-3">
                                <small class="text-warning fw-bold d-block text-uppercase">
                                    {{ $item->buyer->name ?? 'Brand' }}
                                </small>
                                <h5 class="fw-bold mt-1 mb-0" style="font-size: 1.1rem;">{{ $item->name }}</h5>
                            </div>
                        </div>

                        <div class="pt-3 mt-auto">
                            <a href="{{ route('samples.show', $item->id) }}" class="btn btn-dark btn-sm rounded-pill px-4">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- INQUIRY FORM SECTION -->
    <section id="inquiry" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="inquiry-card bg-white p-4 p-md-5 rounded-4 shadow-sm">
                        <div class="text-center mb-4">
                            <span class="text-warning fw-bold text-uppercase small">Inquiry Form</span>
                            <h2 class="fw-bold">Interested In This Sample?</h2>
                            <p class="text-muted">Send us your inquiry and our merchandising team will contact you.</p>
                        </div>

                        <!-- ALERTS BLOCK -->
                        @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('samples.inquiry.store', $sample->id) }}">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" name="name" class="form-control modern-field" placeholder="Your Name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address *</label>
                                    <input type="email" name="email" class="form-control modern-field" placeholder="Your Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control modern-field" placeholder="Phone Number" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Company Name</label>
                                    <input type="text" name="company" class="form-control modern-field" placeholder="Company Name" value="{{ old('company') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Message *</label>
                                    <textarea name="message" rows="5" class="form-control modern-field" placeholder="Write details like sizes needed, target delivery timeline, target price parameters..." required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5">Send Inquiry</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- RIGHT SIDE STATIC DESIGN DISPLAY -->
                <div class="col-lg-5 mt-5 mt-lg-0">
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

<script>
    // Pure Javascript to let users swap thumbnail images into the main layout preview frame
    function switchPreview(src) {
        document.getElementById('expandedImg').src = src;
    }
</script>
@endsection
@extends('layouts.guest')

@section('title', 'FALGUN | Premium Garments Manufacturer')

@section('content')

<div class="page-home">

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
                <ul class="navbar-nav ms-auto gap-lg-3 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#factories">Factories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('samples.index') }}">Samples</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-warning rounded-pill px-4" href="{{ route('samples.index') }}">Explore</a>
                    </li>
                </ul>

            </div>

        </div>

    </nav>



    <!-- =========================================
    LUXURY HERO SECTION
    ========================================= -->
    <section class="luxury-hero position-relative overflow-hidden">

        <!-- BACKGROUND OVERLAY -->
        <div class="hero-overlay"></div>

        <!-- FLOATING SHAPES -->
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>

        <div class="container position-relative">

            <div class="row align-items-center min-vh-100 py-5">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6 pe-lg-5" data-aos="fade-right">

                    <!-- BADGE -->
                    <div class="hero-badge mb-4">

                        <span>
                            PREMIUM READY-MADE GARMENTS MANUFACTURER
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h1 class="hero-title">

                        WE CREATE <br>

                        <span class="text-warning">
                            GLOBAL FASHION
                        </span>

                    </h1>

                    <!-- DESCRIPTION -->
                    <p class="hero-description mt-4">

                        FALGUN is a modern apparel manufacturing group with
                        3 advanced factories producing premium-quality garments
                        for leading international fashion brands worldwide.

                    </p>

                    <!-- BUTTONS -->
                    <div class="d-flex gap-3 flex-wrap mt-5">

                        <a href="#categories"
                           class="btn hero-btn-primary">

                            Explore Collections

                        </a>

                        <a href="#factories"
                           class="btn hero-btn-outline">

                            Our Factories

                        </a>

                    </div>

                    <!-- STATS -->
                    <div class="hero-stats row mt-5 g-4">

                        <div class="col-4">

                            <div class="hero-stat-card">

                                <h2>3+</h2>

                                <span>
                                    Factories
                                </span>

                            </div>

                        </div>

                        <div class="col-4">

                            <div class="hero-stat-card">

                                <h2>20+</h2>

                                <span>
                                    Countries
                                </span>

                            </div>

                        </div>

                        <div class="col-4">

                            <div class="hero-stat-card">

                                <h2>40+</h2>

                                <span>
                                    Years
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT CONTENT -->
                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left">

                    <div class="hero-image-wrapper position-relative">

                        <!-- MAIN IMAGE -->
                        <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=1400&auto=format&fit=crop"
                             class="hero-main-image">

                        <!-- FLOAT CARD -->
                        <div class="hero-floating-card shadow-lg">

                            <div class="d-flex align-items-center gap-3">

                                <div class="hero-floating-icon">

                                    <i class="fas fa-tshirt"></i>

                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Production Capacity
                                    </small>

                                    <h5 class="fw-bold mb-0 text-dark">
                                        500K+ PCS / Month
                                    </h5>

                                </div>

                            </div>

                        </div>

                        <!-- SMALL IMAGE -->
                        <div class="hero-small-image-wrapper shadow-lg">

                            <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1200&auto=format&fit=crop"
                                 class="hero-small-image">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- ABOUT SECTION (PREMIUM REDESIGN) -->
    <section id="about" class="py-5 bg-light overflow-hidden">

        <div class="container py-5">

            <div class="row align-items-center g-5">

                <!-- LEFT CONTENT -->
                <div class="col-lg-6" data-aos="fade-right">

                    <span class="text-warning fw-bold text-uppercase small">
                        About FALGUN
                    </span>

                    <h2 class="display-5 fw-bold mt-2 mb-4">
                        Premium Garment Manufacturing Partner
                    </h2>

                    <p class="text-muted lead">
                        FALGUN is a leading Ready-Made Garments manufacturer from Bangladesh,
                        delivering world-class apparel solutions for global fashion brands.
                    </p>

                    <p class="text-muted">
                        With 3 modern factories, advanced production facilities,
                        skilled workforce, and strict compliance standards,
                        we create high-quality garments for international buyers.
                    </p>

                    <!-- FEATURE LIST -->
                    <div class="row g-4 mt-4">

                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="about-icon">
                                    <i class="fas fa-globe"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-1">Global Export</h6>
                                    <small class="text-muted">
                                        Exporting garments worldwide
                                    </small>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="about-icon">
                                    <i class="fas fa-award"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-1">Certified Quality</h6>
                                    <small class="text-muted">
                                        International compliance standards
                                    </small>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="about-icon">
                                    <i class="fas fa-industry"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-1">Modern Factories</h6>
                                    <small class="text-muted">
                                        Advanced production facilities
                                    </small>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="about-icon">
                                    <i class="fas fa-users"></i>
                                </div>

                                <div>
                                    <h6 class="fw-bold mb-1">Skilled Workforce</h6>
                                    <small class="text-muted">
                                        Experienced apparel professionals
                                    </small>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="mt-5">

                        <a href="{{ route('samples.index') }}"
                           class="btn btn-dark rounded-pill px-5 py-3">
                            Explore Samples
                        </a>

                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-lg-6 position-relative" data-aos="fade-left">

                    <!-- MAIN IMAGE -->
                    <div class="position-relative">

                        <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1400&auto=format&fit=crop"
                             class="img-fluid rounded-4 shadow-lg about-main-img">

                        <!-- FLOATING CARD -->
                        <div class="floating-card bg-white shadow-lg rounded-4 p-4">

                            <h3 class="fw-bold text-warning mb-0">
                                40+
                            </h3>

                            <p class="mb-0 small text-muted">
                                Years of Garment Manufacturing Experience
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>




    <!-- FACTORIES (PREMIUM REDESIGN) -->
    <section id="factories" class="py-5 bg-white">

        <div class="container py-5">

            <!-- HEADER -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold display-6">Our Manufacturing Excellence</h2>
                <p class="text-muted mt-2">
                    3 specialized factories delivering world-class garments with precision and scale
                </p>
            </div>

            <div class="row g-4 align-items-stretch">

                <!-- LEFT BIG FEATURE -->
                <div class="col-lg-6" data-aos="fade-right">

                    <div class="position-relative rounded-4 overflow-hidden shadow-lg h-100">

                        <img src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a"
                             class="w-100 h-100"
                             style="object-fit: cover; height: 520px;">

                        <div class="position-absolute bottom-0 start-0 w-100 p-4"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);">

                            <h3 class="text-white fw-bold">Knit Factory</h3>
                            <p class="text-white-50 mb-0">
                                High-speed knit production with advanced automation systems.
                            </p>

                            <div class="mt-3 d-flex gap-2 flex-wrap">
                                <span class="badge bg-warning text-dark px-3 py-2">High Capacity</span>
                                <span class="badge bg-light text-dark px-3 py-2">Export Quality</span>
                                <span class="badge bg-light text-dark px-3 py-2">Certified</span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE STACK -->
                <div class="col-lg-6">

                    <div class="row g-4">

                        <!-- CARD 1 -->
                        <div class="col-12" data-aos="fade-left">

                            <div class="d-flex gap-3 p-4 bg-light rounded-4 shadow-sm hover-lift">

                                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f"
                                     class="rounded-3"
                                     style="width: 120px; height: 100px; object-fit: cover;">

                                <div>
                                    <h5 class="fw-bold mb-1">Woven Factory</h5>
                                    <p class="text-muted mb-0">
                                        Precision woven garments for global fashion brands.
                                    </p>

                                    <div class="mt-2">
                                        <span class="badge bg-dark">Shirts</span>
                                        <span class="badge bg-dark">Trousers</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- CARD 2 -->
                        <div class="col-12" data-aos="fade-left" data-aos-delay="100">

                            <div class="d-flex gap-3 p-4 bg-light rounded-4 shadow-sm hover-lift">

                                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b"
                                     class="rounded-3"
                                     style="width: 120px; height: 100px; object-fit: cover;">

                                <div>
                                    <h5 class="fw-bold mb-1">Denim Factory</h5>
                                    <p class="text-muted mb-0">
                                        Premium denim production with modern finishing lines.
                                    </p>

                                    <div class="mt-2">
                                        <span class="badge bg-dark">Jeans</span>
                                        <span class="badge bg-dark">Jackets</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- STATS BOX -->
                        <div class="col-12" data-aos="fade-up">

                            <div class="row text-center mt-3">

                                <div class="col-4">
                                    <div class="p-3 bg-white shadow-sm rounded-4 hover-lift">
                                        <h4 class="fw-bold text-warning">3</h4>
                                        <small>Factories</small>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="p-3 bg-white shadow-sm rounded-4 hover-lift">
                                        <h4 class="fw-bold text-warning">5000+</h4>
                                        <small>Workers</small>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="p-3 bg-white shadow-sm rounded-4 hover-lift">
                                        <h4 class="fw-bold text-warning">24/7</h4>
                                        <small>Production</small>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CATEGORIES -->
    <section id="categories" class="py-5 bg-light">

        <div class="container py-5">

            <!-- HEADER -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold display-6">Product Categories</h2>
                <p class="text-muted mt-2">
                    Explore our wide range of high-quality apparel manufacturing categories
                </p>
            </div>

            @php
            $categories = [

            [
            'name' => 'T-Shirts',
            'img' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Polo Shirts',
            'img' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Denim Jeans',
            'img' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Jackets',
            'img' => 'https://images.unsplash.com/photo-1523398002811-999ca8dec234?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Activewear',
            'img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Kidswear',
            'img' => 'https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Sweatshirts',
            'img' => 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Sportswear',
            'img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Formal Wear',
            'img' => 'https://images.unsplash.com/photo-1593030761757-71fae45fa0e7?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Shirts',
            'img' => 'https://images.unsplash.com/photo-1603252109303-2751441dd157?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Hoodies',
            'img' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Loungewear',
            'img' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?q=80&w=1200&auto=format&fit=crop'
            ]

            ];
            @endphp

            <div class="row g-4">

                @foreach($categories as $cat)

                <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in">

                    <div class="position-relative rounded-4 overflow-hidden shadow-sm category-card">

                        <img src="{{ $cat['img'] }}"
                             class="w-100 category-img"
                             alt="{{ $cat['name'] }}">

                        <div class="position-absolute bottom-0 start-0 w-100 p-3"
                             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">

                            <h6 class="text-white fw-bold mb-0">{{ $cat['name'] }}</h6>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- FEATURED SAMPLES (PREMIUM REDESIGN) -->
    <section class="py-5 bg-white">

        <div class="container py-5">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-5">

                <div data-aos="fade-right">
                    <span class="text-warning fw-bold text-uppercase small">
                        Latest Collection
                    </span>

                    <h2 class="fw-bold display-6 mb-0">
                        Featured Samples
                    </h2>
                </div>

                <a href="{{ route('samples.index') }}"
                   class="btn btn-dark rounded-pill px-4 mt-3 mt-md-0">
                    Explore All
                </a>

            </div>

            @php

            $samples = [

            [
            'name' => 'Premium Oversized T-Shirt',
            'buyer' => 'ZARA',
            'category' => 'T-Shirts',
            'img' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Luxury Denim Jacket',
            'buyer' => 'H&M',
            'category' => 'Denim',
            'img' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Athletic Performance Wear',
            'buyer' => 'NIKE',
            'category' => 'Sportswear',
            'img' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Modern Polo Collection',
            'buyer' => 'PUMA',
            'category' => 'Polo',
            'img' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Winter Hoodie Series',
            'buyer' => 'ADIDAS',
            'category' => 'Hoodies',
            'img' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?q=80&w=1200&auto=format&fit=crop'
            ],

            [
            'name' => 'Elegant Formal Shirt',
            'buyer' => 'MANGO',
            'category' => 'Formal Wear',
            'img' => 'https://images.unsplash.com/photo-1603252109303-2751441dd157?q=80&w=1200&auto=format&fit=crop'
            ]

            ];

            @endphp

            <div class="row g-4">

                @foreach($samples as $s)

                <div class="col-lg-4 col-md-6" data-aos="fade-up">

                    <div class="sample-card position-relative overflow-hidden rounded-4 shadow-sm">

                        <!-- IMAGE -->
                        <div class="sample-image-wrapper">

                            <img src="{{ $s['img'] }}"
                                 class="w-100 sample-image">

                        </div>

                        <!-- OVERLAY -->
                        <div class="sample-overlay">

                            <div>

                                <span class="badge bg-warning text-dark mb-2 px-3 py-2">
                                    {{ $s['category'] }}
                                </span>

                                <h5 class="text-white fw-bold">
                                    {{ $s['name'] }}
                                </h5>

                                <p class="text-light mb-3">
                                    Buyer: {{ $s['buyer'] }}
                                </p>

                                <a href="#"
                                   class="btn btn-light btn-sm rounded-pill px-4">
                                    View Details
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </section>


    <!-- CTA -->
    <section id="contact" class="py-5 bg-dark text-white text-center">
        <div class="container">

            <h2 class="fw-bold" data-aos="zoom-in">Let's Build Something Great</h2>
            <p class="text-light opacity-75">Contact FALGUN for premium garment manufacturing solutions</p>

            <a href="https://wa.me/8801404405631" class="btn btn-warning btn-lg rounded-pill mt-3">
                WhatsApp Us
            </a>

        </div>
    </section>

    <!-- SMALL STYLES -->
    <style>
        .hover-lift{
            transition:.4s
        }
        .hover-lift:hover{
            transform:translateY(-8px);
            box-shadow:0 20px 40px rgba(0,0,0,.15)
        }
        .factory-img{
            transition:.6s
        }
        .card:hover .factory-img{
            transform:scale(1.08)
        }
    </style>
</div>


@endsection


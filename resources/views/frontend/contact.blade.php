@extends('layouts.guest')

@section('title', 'Contact Us | FALGUN')

@section('content')
<div class="page-contact">
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
                        <a class="nav-link"
                           href="{{ route('samples.index') }}">
                            Samples
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"
                           href="#">
                            Contact
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">

                        <a href="#contactForm"
                           class="btn btn-warning rounded-pill px-4 fw-semibold">
                            Send Inquiry
                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- =========================================
    HERO SECTION
    ========================================= -->
    <section class="contact-hero text-white position-relative overflow-hidden">

        <div class="hero-overlay"></div>

        <div class="container position-relative">

            <div class="row justify-content-center text-center">

                <div class="col-lg-8">

                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-4">
                        GLOBAL APPAREL MANUFACTURER
                    </span>

                    <h1 class="display-3 fw-bold">
                        Contact FALGUN
                    </h1>

                    <p class="lead text-light opacity-75 mt-4">
                        Let’s build premium fashion collections together.
                        Contact our merchandising and production team today.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- =========================================
    CONTACT INFO
    ========================================= -->
    <section class="py-5 bg-white">

        <div class="container">

            <div class="row g-4">

                <!-- OFFICE -->
                <div class="col-lg-4">

                    <div class="contact-info-card h-100">

                        <div class="contact-icon">
                            <i class="fas fa-building"></i>
                        </div>

                        <h4 class="fw-bold mt-4">
                            Head Office
                        </h4>

                        <p class="text-muted mt-3 mb-0">
                            FALGUN Apparel Ltd.<br>
                            House #12, Road #5<br>
                            Gulshan, Dhaka 1212<br>
                            Bangladesh
                        </p>

                    </div>

                </div>

                <!-- PHONE -->
                <div class="col-lg-4">

                    <div class="contact-info-card h-100">

                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>

                        <h4 class="fw-bold mt-4">
                            Contact Number
                        </h4>

                        <p class="text-muted mt-3 mb-1">
                            +880 1711-000000
                        </p>

                        <p class="text-muted mb-1">
                            +880 1811-000000
                        </p>

                        <p class="text-muted mb-0">
                            WhatsApp Available
                        </p>

                    </div>

                </div>

                <!-- EMAIL -->
                <div class="col-lg-4">

                    <div class="contact-info-card h-100">

                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>

                        <h4 class="fw-bold mt-4">
                            Email Address
                        </h4>

                        <p class="text-muted mt-3 mb-1">
                            info@falgun.com
                        </p>

                        <p class="text-muted mb-1">
                            merchandising@falgun.com
                        </p>

                        <p class="text-muted mb-0">
                            support@falgun.com
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- =========================================
    CONTACT FORM + MAP
    ========================================= -->
    <section id="contactForm" class="py-5 bg-light">

        <div class="container">

            <div class="row g-5 align-items-center">

                <!-- LEFT -->
                <div class="col-lg-5">

                    <span class="text-warning fw-bold text-uppercase small">
                        Get In Touch
                    </span>

                    <h2 class="fw-bold display-6 mt-2">
                        Let's Discuss Your Apparel Requirements
                    </h2>

                    <p class="text-muted mt-4">
                        We specialize in premium ready-made garments,
                        fashion manufacturing, sourcing, sampling,
                        and bulk production for international brands.
                    </p>

                    <!-- FACTORIES -->
                    <div class="mt-5">

                        <div class="factory-item">

                            <div class="factory-dot"></div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Knit Factory
                                </h6>

                                <small class="text-muted">
                                    Gazipur, Bangladesh
                                </small>

                            </div>

                        </div>

                        <div class="factory-item">

                            <div class="factory-dot"></div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Woven Factory
                                </h6>

                                <small class="text-muted">
                                    Narayanganj, Bangladesh
                                </small>

                            </div>

                        </div>

                        <div class="factory-item">

                            <div class="factory-dot"></div>

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Denim Factory
                                </h6>

                                <small class="text-muted">
                                    Chattogram, Bangladesh
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-lg-7">

                    <div class="contact-form-card">

                        <form method="POST"
                              action="#">

                            @csrf

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

                                <!-- SUBJECT -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold">
                                        Subject
                                    </label>

                                    <input type="text"
                                           class="form-control modern-field"
                                           placeholder="Subject">

                                </div>

                                <!-- MESSAGE -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold">
                                        Message
                                    </label>

                                    <textarea rows="6"
                                              class="form-control modern-field"
                                              placeholder="Write your message..."></textarea>

                                </div>

                                <!-- BUTTON -->
                                <div class="col-12">

                                    <button class="btn btn-dark btn-lg rounded-pill px-5">
                                        Send Message
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- =========================================
    MAP SECTION
    ========================================= -->
    <section class="bg-white">

        <iframe
            src="https://maps.google.com/maps?q=dhaka&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%"
            height="500"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>

    </section>

</div>

@endsection
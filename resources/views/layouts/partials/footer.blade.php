<!-- =========================================
MODERN FOOTER
========================================= -->
<footer class="footer-section position-relative overflow-hidden">

    <!-- TOP -->
    <div class="footer-top py-5">

        <div class="container">

            <div class="row g-5">

                <!-- BRAND -->
                <div class="col-lg-4">

                    <a href="{{ route('home') }}"
                       class="footer-logo text-decoration-none">
                        FALGUN
                    </a>

                    <p class="footer-text mt-4">
                        Premium Ready-Made Garments manufacturer from Bangladesh
                        delivering world-class apparel solutions for global fashion brands.
                    </p>

                    <!-- SOCIAL -->
                    <div class="d-flex gap-3 mt-4">

                        <a href="#"
                           class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#"
                           class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="#"
                           class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        <a href="#"
                           class="social-icon">
                            <i class="fab fa-youtube"></i>
                        </a>

                    </div>

                </div>

                <!-- QUICK LINKS -->
                <div class="col-lg-2 col-md-6">

                    <h5 class="footer-title">
                        Quick Links
                    </h5>

                    <ul class="footer-links">

                        <li>
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('samples.index') }}">
                                Samples
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('home') }}#factories">
                                Factories
                            </a>
                        </li>



                        <li>
                            <a href="{{ route('contact') }}">
                                Contact
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- CATEGORIES -->
                <div class="col-lg-3 col-md-6">

                    <h5 class="footer-title">
                        Product Categories
                    </h5>

                    <ul class="footer-links">

                        <li>
                            <a href="#">
                                T-Shirts
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Polo Shirts
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Denim Wear
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Sportswear
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Hoodies & Jackets
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- CONTACT -->
                <div class="col-lg-3">

                    <h5 class="footer-title">
                        Contact Info
                    </h5>

                    <div class="footer-contact-item">

                        <div class="footer-contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>

                        <div>

                            <small class="footer-small">
                                Head Office
                            </small>

                            <p class="mb-0">
                                Chattogram, Bangladesh
                            </p>

                        </div>

                    </div>

                    <div class="footer-contact-item">

                        <div class="footer-contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>

                        <div>

                            <small class="footer-small">
                                Phone
                            </small>

                            <p class="mb-0">
                                +8801404408880
                            </p>

                        </div>

                    </div>

                    <div class="footer-contact-item">

                        <div class="footer-contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>

                        <div>

                            <small class="footer-small">
                                Email
                            </small>

                            <p class="mb-0">
                                info@falgun.com
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- MIDDLE -->
    <div class="footer-middle py-4 border-top border-secondary border-opacity-25">

        <div class="container">

            <div class="row align-items-center g-4">

                <!-- NEWSLETTER -->
                <div class="col-lg-7">

                    <h4 class="fw-bold text-white mb-3">
                        Subscribe Our Newsletter
                    </h4>

                    <form class="newsletter-form">

                        <input type="email"
                               placeholder="Enter your email address">

                        <button type="submit">
                            Subscribe
                        </button>

                    </form>

                </div>

                <!-- FACTORY INFO -->
                <div class="col-lg-5">

                    <div class="row text-center">

                        <div class="col-4">

                            <h4 class="fw-bold text-warning mb-1">
                                3+
                            </h4>

                            <small class="footer-small">
                                Factories
                            </small>

                        </div>

                        <div class="col-4">

                            <h4 class="fw-bold text-warning mb-1">
                                20+
                            </h4>

                            <small class="footer-small">
                                Countries
                            </small>

                        </div>

                        <div class="col-4">

                            <h4 class="fw-bold text-warning mb-1">
                                40+
                            </h4>

                            <small class="footer-small">
                                Years
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom py-4 border-top border-secondary border-opacity-25">

        <div class="container">

            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-3">

                <p class="mb-0 footer-small">
                    © {{ date('Y') }} <a target="_blank" href="https://www.falgun.com">FALGUN</a>. All Rights Reserved.
                </p>

                <div class="d-flex gap-4">

                    <a href="#" class="footer-bottom-link">
                        Privacy Policy
                    </a>

                    <a href="#" class="footer-bottom-link">
                        Terms & Conditions
                    </a>

                    <a href="#" class="footer-bottom-link">
                        Sitemap
                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- FLOATING WHATSAPP -->
    <a href="https://wa.me/8801404408880"
       class="floating-whatsapp"
       target="_blank">

        <i class="fab fa-whatsapp"></i>

    </a>

</footer>

<!-- =========================================
FOOTER STYLE
========================================= -->
<style>

    .footer-section{
        background:#0f0f10;
        color:#fff;
    }

    .footer-logo{
        font-size:42px;
        font-weight:800;
        color:#fff;
        letter-spacing:2px;
    }

    .footer-text{
        color:rgba(255,255,255,.7);
        line-height:1.9;
    }

    .footer-title{
        font-weight:700;
        margin-bottom:28px;
        color:#fff;
    }

    .footer-links{
        list-style:none;
        padding:0;
        margin:0;
    }

    .footer-links li{
        margin-bottom:14px;
    }

    .footer-links a{
        color:rgba(255,255,255,.7);
        text-decoration:none;
        transition:.3s;
    }

    .footer-links a:hover{
        color:#ffc107;
        padding-left:5px;
    }

    .social-icon{
        width:46px;
        height:46px;
        border-radius:50%;
        background:rgba(255,255,255,.08);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        text-decoration:none;
        transition:.4s;
    }

    .social-icon:hover{
        background:#ffc107;
        color:#111;
        transform:translateY(-5px);
    }

    .footer-contact-item{
        display:flex;
        gap:15px;
        margin-bottom:22px;
    }

    .footer-contact-icon{
        width:46px;
        height:46px;
        border-radius:14px;
        background:rgba(255,255,255,.08);
        display:flex;
        align-items:center;
        justify-content:center;
        color:#ffc107;
        flex-shrink:0;
    }

    .footer-small{
        color:rgba(255,255,255,.6);
    }

    .newsletter-form{
        display:flex;
        background:#1b1b1d;
        border-radius:60px;
        overflow:hidden;
        margin-top:20px;
    }

    .newsletter-form input{
        flex:1;
        border:none;
        background:transparent;
        color:#fff;
        padding:18px 25px;
        outline:none;
    }

    .newsletter-form button{
        border:none;
        background:#ffc107;
        color:#111;
        font-weight:700;
        padding:0 32px;
        transition:.3s;
    }

    .newsletter-form button:hover{
        background:#fff;
    }

    .footer-bottom-link{
        color:rgba(255,255,255,.7);
        text-decoration:none;
        transition:.3s;
    }

    .footer-bottom-link:hover{
        color:#ffc107;
    }

    .floating-whatsapp{
        position:fixed;
        right:25px;
        bottom:25px;
        width:65px;
        height:65px;
        border-radius:50%;
        background:#25d366;
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:30px;
        text-decoration:none;
        box-shadow:0 15px 35px rgba(0,0,0,.2);
        z-index:999;
        transition:.4s;
        animation:whatsappPulse 2s infinite;
    }

    .floating-whatsapp:hover{
        transform:scale(1.1);
        color:#fff;
    }

    @keyframes whatsappPulse{

        0%{
            box-shadow:0 0 0 0 rgba(37,211,102,.5);
        }

        70%{
            box-shadow:0 0 0 18px rgba(37,211,102,0);
        }

        100%{
            box-shadow:0 0 0 0 rgba(37,211,102,0);
        }

    }

    @media(max-width:991px){

        .newsletter-form{
            flex-direction:column;
            border-radius:24px;
        }

        .newsletter-form button{
            width:100%;
            padding:18px;
        }

    }

</style>
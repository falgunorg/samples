@extends('layouts.guest')

<<<<<<< HEAD
@section('title', 'FALGUN | Premium Sample Collection')
=======
@section('title', 'FALGUN | Premium Category Collection')
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)

@section('content')
<div class="page-sample-index">

<<<<<<< HEAD
    <!-- NAVBAR -->
=======
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">FALGUN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
<<<<<<< HEAD
                    <li class="nav-item"><a class="nav-link active" href="{{ route('samples.index') }}">Samples</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#categories">Categories</a></li>
=======
                    <li class="nav-item"><a class="nav-link" href="{{ route('samples.index') }}">Samples</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('categories.index') }}">Categories</a></li>
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#factories">Factories</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="#" class="btn btn-warning rounded-pill px-4 fw-semibold">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<<<<<<< HEAD
    <!-- SAMPLES SECTION -->
=======
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
    <section class="py-5 bg-white">
        <div class="container">
            <div class="position-relative">
                <div class="row align-items-center g-4">
                    <div class="col-lg-3">
<<<<<<< HEAD
                        <span class="filter-mini-title text-muted small fw-bold">FIND YOUR STYLE</span>
                        <h3 class="fw-bold mb-2">Filter Samples</h3>
                        <p class="text-muted small mb-0">Search premium apparel collections by buyer, category, or garment type.</p>
                    </div>

                    <!-- FILTER FORM -->
                    <div class="col-lg-9">
                        <form method="GET" action="{{ route('samples.index') }}" id="filterForm">
                            <div class="row g-3">
                                <!-- SEARCH INPUT -->
                                <div class="col-lg-4">
                                    <div class="modern-input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search samples..." value="{{ request('search') }}">
                                    </div>
                                </div>

                                <!-- BUYER SELECT DROPDOWN -->
                                <div class="col-lg-3">
                                    <select name="buyer" class="form-select">
                                        <option value="All Buyers">All Buyers</option>
                                        @foreach($buyers as $buyer)
                                        <option value="{{ $buyer->name }}" {{ request('buyer') == $buyer->name ? 'selected' : '' }}>{{ $buyer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- ORIGINAL RESTORED CATEGORY SELECT DROPDOWN -->
                                <div class="col-lg-3">
                                    <select name="category" id="categorySelect" class="form-select">
                                        <option value="All Categories">All Categories</option>
                                        @foreach($allCategories as $cat)
                                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- FORM EXECUTION ACTIONS -->
                                <div class="col-lg-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-dark w-100">Apply</button>
                                    @if(request('search') || (request('buyer') && request('buyer') !== 'All Buyers') || (request('category') && request('category') !== 'All Categories'))
                                        <a href="{{ route('samples.index') }}" class="btn btn-outline-danger" title="Reset Filters">
                                            <i class="fas fa-sync-alt"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- DYNAMIC QUICK FILTERS LIST: ALL + TOP 5 CATEGORIES -->
                            <div class="mt-4 d-flex flex-wrap gap-2">
                                @php
                                    $currentSelection = request('category', 'All Categories');
                                    $isAllActive = ($currentSelection === 'All Categories' || $currentSelection === 'All');
                                @endphp

                                <!-- 1. Static 'All' Trigger Badge -->
                                <span class="badge rounded-pill p-2 px-3 quick-filter-tag fw-semibold" 
                                      onclick="filterByCategoryBadge('All')" 
                                      style="cursor: pointer; transition: all 0.2s ease-in-out; 
                                             {{ $isAllActive ? 'background-color: #212529; color: #fff; border: 1px solid #212529;' : 'background-color: #f8f9fa; color: #212529; border: 1px solid #dee2e6;' }}">
                                    All
                                </span>

                                <!-- 2. Top 5 Categories Dynamic Loop Mapping -->
                                @foreach($topCategories as $topCat)
                                    @php
                                        $isThisActive = ($currentSelection === $topCat->name);
                                    @endphp
                                    <span class="badge rounded-pill p-2 px-3 quick-filter-tag fw-semibold" 
                                          onclick="filterByCategoryBadge('{{ $topCat->name }}')" 
                                          style="cursor: pointer; transition: all 0.2s ease-in-out; 
                                                 {{ $isThisActive ? 'background-color: #212529; color: #fff; border: 1px solid #212529;' : 'background-color: #f8f9fa; color: #212529; border: 1px solid #dee2e6;' }}">
                                        {{ $topCat->name }}
                                    </span>
                                @endforeach
=======
                        <span class="filter-mini-title text-muted small fw-bold">FIND YOUR CATEGORIES</span>
                        <h3 class="fw-bold mb-2">Filter Categories</h3>
                        <p class="text-muted small mb-0">Search premium apparel collections by buyer, category, or garment type.</p>
                    </div>

                    <div class="col-lg-9">
                        <form method="GET" action="{{ route('categories.index') }}" id="filterForm">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div class="modern-input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}">
                                    </div>
                                </div>
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br/>

<<<<<<< HEAD
            <!-- CARDS GRID VIEWPORT container target wrapper -->
            <div class="row g-4" id="samplesContainer">
                @include('frontend.samples.partials.grid_items')
                
                @if($samples->isEmpty())
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No items match your selected filter options.</p>
                </div>
                @endif
            </div>
            <br/><br/>

            <!-- LOAD MORE FOOTER SECTION -->
=======
            <div class="row g-4" id="categories-wrapper">
                @forelse($categories as $cat)
                <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in">
                    <a href="{{route('categories.show', $cat->slug)}}">
                        <div class="position-relative rounded-4 overflow-hidden shadow-sm category-card">
                            <img src="{{ asset($cat->img) }}"
                                 class="w-100 category-img"
                                 alt="{{ $cat->name }}"
                                 style="height: 380px; background: #ffcd39; object-fit: contain;"> 
                            <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0.4), transparent);">
                                <h6 class="text-white fw-bold mb-0">{{ $cat->name }}</h6>
                                <small class="text-warning">{{ $cat->samples_count }} Samples</small>
                            </div>
                        </div>

                    </a>

                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No categories found matching your search.</p>
                </div>
                @endforelse
            </div>
            <br/><br/>

>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
            <div class="text-center mt-4">
                <button type="button" 
                        class="btn btn-outline-dark btn-lg rounded-pill px-4" 
                        id="loadMoreBtn"
<<<<<<< HEAD
                        data-next-page="{{ $samples->nextPageUrl() }}"
                        style="{{ $samples->hasMorePages() ? '' : 'display: none;' }}">
                    <span class="spinner-border spinner-border-sm me-2 d-none" id="btnSpinner" role="status"></span>
                    LOAD MORE
                </button>
                
                <div id="noMoreMessage" class="text-muted small text-uppercase fw-semibold {{ !$samples->hasMorePages() && $samples->total() > 0 ? '' : 'd-none' }}">
=======
                        data-next-page="{{ $categories->nextPageUrl() }}"
                        style="{{ $categories->hasMorePages() ? '' : 'display: none;' }}">
                    <span class="spinner-border spinner-border-sm me-2 d-none" id="btnSpinner" role="status"></span>
                    LOAD MORE
                </button>

                <div id="noMoreMessage" class="text-muted small text-uppercase fw-semibold {{ !$categories->hasMorePages() && $categories->total() > 0 ? '' : 'd-none' }}">
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
                    You've viewed all matching items
                </div>
            </div>

<<<<<<< HEAD
        </div>
    </section>
</div>

<!-- AJAX INFINITE SCROLL AND DROPDOWN INTEGRATION SCRIPT -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const samplesContainer = document.getElementById('samplesContainer');
        const btnSpinner = document.getElementById('btnSpinner');
        const noMoreMessage = document.getElementById('noMoreMessage');

        if(loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                let nextPageUrl = loadMoreBtn.getAttribute('data-next-page');
                if(!nextPageUrl) return;

                loadMoreBtn.disabled = true;
                btnSpinner.classList.remove('d-none');

                fetch(nextPageUrl, {
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                })
                .then(response => response.text())
                .then(htmlData => {
                    samplesContainer.insertAdjacentHTML('beforeend', htmlData);
                    
                    let urlObj = new URL(nextPageUrl);
                    let currentPage = parseInt(urlObj.searchParams.get('page'));
                    urlObj.searchParams.set('page', currentPage + 1);
                    let deeperPageUrl = urlObj.toString();

                    if(htmlData.trim() === '') {
                        loadMoreBtn.style.display = 'none';
                        noMoreMessage.classList.remove('d-none');
                    } else {
                        loadMoreBtn.setAttribute('data-next-page', deeperPageUrl);
                        loadMoreBtn.disabled = false;
                        btnSpinner.classList.add('d-none');
                    }
                })
                .catch(err => {
                    console.error("AJAX error loading subsequent chunk payloads", err);
                    loadMoreBtn.disabled = false;
                    btnSpinner.classList.add('d-none');
                });
            });
        }
    });

    // Synchronizes clicked badge list directly into the category drop select element framework
    function filterByCategoryBadge(categoryValue) {
        const selectBox = document.getElementById('categorySelect');
        
        if (categoryValue === 'All') {
            selectBox.value = 'All Categories';
        } else {
            selectBox.value = categoryValue;
        }
        
        // Execute form submission metrics natively
        document.getElementById('filterForm').submit();
    }
</script>
=======
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const loadMoreBtn = document.getElementById('loadMoreBtn');

                    if (loadMoreBtn) {
                        loadMoreBtn.addEventListener('click', function () {
                            let button = this;
                            let nextPageUrl = button.getAttribute('data-next-page');
                            let spinner = document.getElementById('btnSpinner');
                            let noMoreMsg = document.getElementById('noMoreMessage');
                            let wrapper = document.getElementById('categories-wrapper');

                            if (!nextPageUrl)
                                return;

                            // UI Loading Feedback
                            spinner.classList.remove('d-none');
                            button.disabled = true;

                            // Async Fetch Connection Handshake
                            fetch(nextPageUrl, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                                    .then(response => {
                                        if (!response.ok)
                                            throw new Error('Network error received.');
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Dynamic elements processing and placement
                                        wrapper.insertAdjacentHTML('beforeend', data.html);

                                        // Component state updates
                                        if (data.hasMorePages) {
                                            button.setAttribute('data-next-page', data.nextPageUrl);
                                            button.disabled = false;
                                        } else {
                                            button.style.display = 'none';
                                            noMoreMsg.classList.remove('d-none');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching data execution:', error);
                                        button.disabled = false;
                                    })
                                    .finally(() => {
                                        spinner.classList.add('d-none');
                                    });
                        });
                    }
                });
            </script>

        </div>
    </section>
</div>
>>>>>>> 1ff7942 (Update on 18th July Added Category in Frontend)
@endsection
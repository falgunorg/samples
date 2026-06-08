@forelse($samples as $sample)
<div class="col-lg-3 col-md-6 sample-item-card" data-aos="fade-up">
    <div class="base-sample-card bg-white rounded-4 overflow-hidden shadow-sm h-100 border">
        <!-- IMAGE -->
        <div class="sample-image-wrapper position-relative">
            <a href="{{ route('samples.show', $sample->id) }}">
                @php
                // FIXED: Filter the eager-loaded collection memory cleanly without firing extra SQL queries
                $mainThumbRecord = $sample->images->first(function ($image) {
                return !str_contains($image->image_path, 'gallery/');
                });

                // Match the target file path directly to public/upload/samples/
                $thumbUrl = $mainThumbRecord 
                ? asset('upload/samples/' . $mainThumbRecord->image_path) 
                : asset('no-image.png');
                @endphp
                <img src="{{ $thumbUrl }}" 
                     class="sample-image" 
                     alt="{{ $sample->name }}" 
                     onerror="this.src='{{ asset('no-image.png') }}'">
            </a>
            <div class="position-absolute top-0 start-0 p-3">
                <span class="badge bg-danger px-3 py-2">
                    {{ $sample->category->name ?? 'Uncategorized' }}
                </span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-4">
            <small class="text-warning fw-bold text-uppercase">
                {{ $sample->buyer->name ?? 'Generic' }}
            </small>
            <h5 class="fw-bold mt-2 sample-title">{{ $sample->name }}</h5>
            <p class="text-muted small mb-3">Style: {{ $sample->style ?? 'N/A' }} | PO: {{ $sample->po ?? 'N/A' }}</p>

            <!-- FOOTER -->
            <div class="d-flex justify-content-between align-items-center mt-auto">
                <a href="{{ route('samples.show', $sample->id) }}" class="btn btn-dark rounded-pill px-4">
                    View Details
                </a>
                <span class="text-muted small">{{ ucfirst($sample->tag ?? 'New Arrival') }}</span>
            </div>
        </div>
    </div>
</div>
@empty
{{-- Handled structural state if first fetch hits zero records --}}
@endforelse
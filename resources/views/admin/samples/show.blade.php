@extends('layouts.backend')

@section('content')
<style>
    .print-ticket {
        width: 100%;
        margin: 20px auto;
    }
    .printable-area {
        border: 1px solid #ddd;
        padding: 10px;
        background: #fff;
    }

    /* Showroom Gallery Additional Aesthetics */
    .showroom-gallery-title {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 2px solid #3c8dbc;
        padding-bottom: 5px;
    }
    .gallery-grid-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }
    .gallery-image-card {
        width: calc(25% - 12px);
        border: 1px solid #ddd;
        border-radius: 6px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .gallery-image-card:hover {
        transform: scale(1.03);
    }
    .gallery-image-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    @media (max-width: 991px) {
        .gallery-image-card {
            width: calc(50% - 8px);
        }
    }
    @media (max-width: 480px) {
        .gallery-image-card {
            width: 100%;
        }
    }

    @media print {
        @page {
            size: 45mm 35mm;
            margin: 0 !important;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 35mm !important;
            width: 45mm !important;
            overflow: hidden !important;
            background-color: white;
        }

        body * {
            visibility: hidden !important;
        }

        .printable-area, .printable-area * {
            visibility: visible !important;
        }

        .printable-area {
            position: fixed !important;
            left: 0 !important;
            top: 0 !important;
            width: 45mm !important;
            height: 35mm !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .printable-area div {
            line-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .printable-area svg {
            width: 20mm !important;
            height: 20mm !important;
            display: block !important;
            margin: 2px auto !important;
        }

        .printable-area .style_no_label {
            margin: 0 !important;
            padding: 0 !important;
            font-size: 10px !important;
            font-weight: bold !important;
            line-height: 0.8 !important;
            text-align: center !important;
            width: 100% !important;
        }

        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container-fluid print-ticket">
    <div class="box box-primary no-print">
        <div class="box-header with-border">
            <h3 class="box-title">Garment Tech Pack Specification Profile</h3>
            <a href="{{ route('admin.samples.index') }}" class="btn btn-default btn-sm pull-right">Back to Showroom</a>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @php 
                    // Fetch the primary display thumbnail entry directly from public/upload/samples/ directory tracking
                    $mainThumbRecord = $sample->images()->where('image_path', 'NOT LIKE', 'gallery/%')->first();
                    $thumbUrl = $mainThumbRecord ? asset('upload/samples/' . $mainThumbRecord->image_path) : asset('no-image.png');
                    @endphp
                    <img src="{{ $thumbUrl }}" class="img-thumbnail" style="width: 100%; max-width: 240px; border-radius: 8px;" alt="{{ $sample->name }}" onerror="this.src='{{ asset('no-image.png') }}'">
                    <div style="margin-top: 10px;">
                        @if($sample->featured)
                        <span class="label label-warning">Showroom Highlight</span>
                        @endif
                        @if($sample->status == 1)
                        <span class="label label-success">Active Track</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Sample Model</th>
                            <td>{{ $sample->name }}</td>
                        </tr>
                        <tr>
                            <th>Style Designation</th>
                            <td><strong>{{ $sample->style }}</strong></td>
                        </tr>
                        <tr>
                            <th>Target Account / Buyer</th>
                            <td>{{ $sample->buyer->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Product Division</th>
                            <td>{{ $sample->category->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Development Stage (Type)</th>
                            <td>{{ $sample->sampleType->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Fabric Blend Specs</th>
                            <td>{{ $sample->fabric ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Density (GSM)</th>
                            <td>{{ $sample->gsm ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Color Profile</th>
                            <td>{{ $sample->color ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Size Scale Matrices</th>
                            <td>{{ $sample->size_range ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Location / Rack</th>
                            <td>{{ $sample->location ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Quantity Available</th>
                            <td>{{ $sample->qty ?? 0 }} PCS</td>
                        </tr>
                        <tr>
                            <th>Construction Notes</th>
                            <td>{!! $sample->description ?: '<span class="text-muted">No configuration notes documented.</span>' !!}</td>
                        </tr>
                        <tr>
                            <th>System Entry Timestamp</th>
                            <td>{{ $sample->created_at->toDayDateTimeString() }}</td>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                    <h4 class="showroom-gallery-title"><i class="fa fa-images"></i> Production Companion Gallery</h4>
                    <div class="gallery-grid-wrapper">
                        @foreach($sample->images()->where('image_path', 'LIKE', 'gallery/%')->get() as $photo)
                        <div class="gallery-image-card">
                            <a href="{{ asset('upload/samples/' . $photo->image_path) }}" target="_blank">
                                <img src="{{ asset('upload/samples/' . $photo->image_path) }}" alt="Gallery view for {{ $sample->name }}" onerror="this.src='{{ asset('no-image.png') }}'">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="box box-solid no-print bg-gray" style="padding: 10px;">
        <div class="text-center" style="border-bottom: 1px dashed #999; padding-bottom: 5px; margin-bottom: 8px;">
            <h4 style="margin:0; font-size: 13px; font-weight:bold; color: #333;">{{ $sample->style }}</h4>
            <small class="text-muted">{{ $sample->buyer->name ?? 'Generic' }}</small>
        </div>
    </div>

    <div class="text-center">
        <div class="printable-area">
            <p class="style_no_label">{{ $sample->style }}</p>
            <div>
                {!! QrCode::size(80)->generate(route('admin.samples.show', $sample->id)); !!}
            </div>
            <p class="style_no_label">{{ substr(($sample->buyer->name ?? 'FALGUN'), 0, 15) }}</p>
        </div>
    </div>

    <div class="no-print text-center" style="margin-top: 20px;">
        <button onclick="window.print()" class="btn btn-success btn-lg btn-block">
            <i class="fa fa-print"></i> EXECUTE PRINT OUT (45mm x 35mm Tag)
        </button>
    </div>
</div>
@endsection

@section('bot')
<script>
    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('print')) {
            window.print();
        }
    }
</script>
@endsection
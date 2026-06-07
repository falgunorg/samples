@extends('layouts.backend')

@section('top')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #editor-container {
        height: 220px;
        background: white;
    }
    .image-preview-box {
        border: 2px dashed #ccc;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        background: #fafafa;
        cursor: pointer;
        transition: 0.2s;
    }
    .image-preview-box:hover {
        border-color: #00a65a;
        background: #f4faf7;
    }
    .gallery-preview-item {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .gallery-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }
    .card-premium {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 30px;
        margin-bottom: 30px;
        border-top: 4px solid #00a65a;
    }
    .select2-container--default .select2-selection--single {
        height: 34px !important;
        border: 1px solid #d2d6de !important;
        border-radius: 4px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 32px !important;
        padding-left: 12px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 32px !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <form action="{{ route('admin.samples.store') }}" method="POST" enctype="multipart/form-data" id="sampleCreateForm">
            @csrf
            <input type="file" name="thumbnail" id="thumbnail-input" accept="image/*" style="display:none;">
            <input type="file" name="gallery[]" id="gallery-input" accept="image/*" multiple style="display:none;">

            <div class="col-lg-7">
                <div class="card-premium">
                    <h3 class="fw-bold mb-4 text-dark" style="margin-top:0; font-weight:700;">Register Premium Garment Sample</h3>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Sample Name <span class="text-danger">*</span></label>
                            <input type="text" name="sample_name" class="form-control" placeholder="e.g., Slim Fit Chino" value="{{ old('sample_name') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>PO / Item Number</label>
                            <input type="text" name="po" class="form-control" placeholder="e.g., PO-8821" value="{{ old('po') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label>Season</label>
                            <input type="text" name="season" class="form-control" placeholder="e.g., SS-2024" value="{{ old('season') }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Style No <span class="text-danger">*</span></label>
                            <input type="text" name="style_no" class="form-control" placeholder="e.g., W2050" value="{{ old('style_no') }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control select2-autocomplete" required>
                                <option value=""></option>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Company <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-control select2-autocomplete" required>
                                <option value=""></option>
                                @foreach($companies as $id => $name)
                                <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Buyer <span class="text-danger">*</span></label>
                            <select name="buyer_id" class="form-control select2-autocomplete" required>
                                <option value=""></option>
                                @foreach($buyers as $id => $name)
                                <option value="{{ $id }}" {{ old('buyer_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" placeholder="e.g., Navy Blue" value="{{ old('color') }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Size Range</label>
                            <input type="text" name="size_range" class="form-control" placeholder="e.g., S-XXL" value="{{ old('size_range') }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Qty <span class="text-danger">*</span></label>
                            <input type="number" name="qty" class="form-control" placeholder="e.g., 1" value="{{ old('qty', 1) }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Sample Type <span class="text-danger">*</span></label>
                            <select name="sample_type_id" class="form-control select2-autocomplete" required>
                                <option value=""></option>
                                @foreach($sampleTypes as $id => $name)
                                <option value="{{ $id }}" {{ old('sample_type_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Location <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Rack A-1" value="{{ old('location') }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tag / ID <span class="text-danger">*</span></label>
                            <input type="text" name="tag" class="form-control" placeholder="e.g., TAG-990" value="{{ old('tag', 'New Arrival') }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Fabric</label>
                            <input type="text" name="fabric" class="form-control" placeholder="e.g., 100% Cotton" value="{{ old('fabric') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>GSM</label>
                            <input type="text" name="gsm" class="form-control" placeholder="e.g., 180" value="{{ old('gsm') }}">
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label>Description & Tech Notes</label>
                        <div id="editor-container">{!! old('description') !!}</div>
                        <input type="hidden" name="description" id="description" value="{{ old('description') }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card-premium" style="border-top-color: #3c8dbc;">
                    <h4 class="fw-bold mb-4 text-dark" style="margin-top:0; font-weight:700;">Sample Media</h4>

                    <div class="form-group">
                        <label class="fw-semibold">Main Thumbnail Image</label>
                        <div class="image-preview-box" id="thumbnail-trigger">
                            <img id="thumbnail-preview" src="{{ asset('no-image.png') }}" style="max-height: 160px; object-fit: contain; width: 100%;">
                            <p class="text-muted small mt-2 mb-0">Click area to choose main profile image</p>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="fw-semibold">Product Gallery Images</label>
                        <div class="image-preview-box" id="gallery-trigger">
                            <i class="fa fa-clone fa-2x text-muted"></i>
                            <p class="text-muted small mb-0">Click area to select multiple gallery images</p>
                        </div>
                        <div id="gallery-preview-container" class="mt-3 d-flex flex-wrap"></div>
                    </div>

                    <hr>

                    <div class="form-group mt-3">
                        <label style="margin-right: 20px; cursor:pointer;">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}> <strong>Featured</strong>
                        </label>
                        <label style="cursor:pointer;">
                            <input type="checkbox" name="status" value="1" checked> <strong>Active</strong>
                        </label>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Save Registered Sample</button>
                        <a href="{{ route('admin.samples.index') }}" class="btn btn-default btn-block">Cancel & Return</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('bot')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    $('.select2-autocomplete').select2({
        placeholder: "Select an option",
        allowClear: true
    });

    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Write production specifications...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                ['+123', {'header': [1, 2, 3, false]}],
                ['ol', {'list': 'ordered'}, {'list': 'bullet'}],
                ['clean']
            ]
        }
    });

    quill.on('text-change', function () {
        $('#description').val(quill.root.innerHTML);
    });

    $('#thumbnail-trigger').on('click', function () {
        $('#thumbnail-input').click();
    });
    $('#gallery-trigger').on('click', function () {
        $('#gallery-input').click();
    });

    $('#thumbnail-input').on('change', function () {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#gallery-input').on('change', function () {
        $('#gallery-preview-container').html('');
        $.each(this.files, function (i, file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#gallery-preview-container').append(`<div class="gallery-preview-item"><img src="${e.target.result}"></div>`);
            }
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection
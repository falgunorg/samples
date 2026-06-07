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
        border-color: #f39c12;
        background: #fffcf7;
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
        border-top: 4px solid #3c8dbc;
    }
    .delete-photo-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dd4b39;
        color: white;
        border: none;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        cursor: pointer;
        font-size: 11px;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
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
        <form action="{{ route('admin.samples.update', $sample->id) }}" method="POST" enctype="multipart/form-data" id="sampleEditForm">
            @csrf
            @method('PATCH')

            <input type="file" name="thumbnail" id="thumbnail-input" accept="image/*" style="display:none;">
            <input type="file" name="gallery[]" id="gallery-input" accept="image/*" multiple style="display:none;">

            <div class="col-lg-7">
                <div class="card-premium">
                    <h3 class="fw-bold mb-4 text-dark" style="margin-top:0; font-weight:700;">Modify Sample Profile</h3>

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
                            <input type="text" name="sample_name" class="form-control" value="{{ old('sample_name', $sample->name) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>PO / Item Number</label>
                            <input type="text" name="po" class="form-control" value="{{ old('po', $sample->po) }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label>Season</label>
                            <input type="text" name="season" class="form-control" value="{{ old('season', $sample->season) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Style No <span class="text-danger">*</span></label>
                            <input type="text" name="style_no" class="form-control" value="{{ old('style_no', $sample->style) }}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control select2-autocomplete" style="width: 100%;" required>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $sample->category_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Company <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-control select2-autocomplete" style="width: 100%;" required>
                                @foreach($companies as $id => $name)
                                <option value="{{ $id }}" {{ old('company_id', $sample->company_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Buyer <span class="text-danger">*</span></label>
                            <select name="buyer_id" class="form-control select2-autocomplete" style="width: 100%;" required>
                                @foreach($buyers as $id => $name)
                                <option value="{{ $id }}" {{ old('buyer_id', $sample->buyer_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="{{ old('color', $sample->color) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Size Range</label>
                            <input type="text" name="size_range" class="form-control" value="{{ old('size_range', $sample->size_range) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Qty <span class="text-danger">*</span></label>
                            <input type="number" name="qty" class="form-control" value="{{ old('qty', $sample->qty) }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Sample Type <span class="text-danger">*</span></label>
                            <select name="sample_type_id" class="form-control select2-autocomplete" style="width: 100%;" required>
                                @foreach($sampleTypes as $id => $name)
                                <option value="{{ $id }}" {{ old('sample_type_id', $sample->sample_type_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Location <span class="text-danger">*</span></label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $sample->location) }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tag / ID <span class="text-danger">*</span></label>
                            <input type="text" name="tag" class="form-control" value="{{ old('tag', $sample->tag) }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label>Fabric</label>
                            <input type="text" name="fabric" class="form-control" value="{{ old('fabric', $sample->fabric) }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>GSM</label>
                            <input type="text" name="gsm" class="form-control" value="{{ old('gsm', $sample->gsm) }}">
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label>Description & Tech Notes</label>
                        <div id="editor-container">{!! old('description', $sample->description) !!}</div>
                        <input type="hidden" name="description" id="description" value="{{ old('description', $sample->description) }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card-premium" style="border-top-color: #f39c12;">
                    <h4 class="fw-bold mb-4 text-dark" style="margin-top:0; font-weight:700;">Media Updates</h4>

                    <div class="form-group">
                        <label class="fw-semibold">Update Main Thumbnail Image</label>
                        <div class="image-preview-box" id="thumbnail-trigger">
                            @php 
                            // Fetch the primary display thumbnail entry directly from public/upload/samples/ directory tracking
                            $mainThumbRecord = $sample->images()->where('image_path', 'NOT LIKE', 'gallery/%')->first();
                            $thumbUrl = $mainThumbRecord ? asset('upload/samples/' . $mainThumbRecord->image_path) : asset('no-image.png');
                            @endphp
                            <img id="thumbnail-preview" src="{{ $thumbUrl }}" style="max-height: 160px; object-fit: contain; width: 100%;">
                            <p class="text-muted small mt-2 mb-0">Click area to change your current primary photo</p>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="fw-semibold">Append Images to Showroom Gallery</label>
                        <div class="image-preview-box mb-3" id="gallery-trigger">
                            <i class="fa fa-plus-circle fa-2x text-muted"></i>
                            <p class="text-muted small mb-0">Click area to select more sub-images</p>
                        </div>

                        <div id="existing-gallery-container" class="mt-2">
                            <label class="text-muted d-block small mb-2">Active Gallery Images (Click × to delete):</label>
                            <div class="d-flex flex-wrap">
                                @foreach($sample->images()->where('image_path', 'LIKE', 'gallery/%')->get() as $photo)
                                <div class="gallery-preview-item" id="gallery-item-{{ $photo->id }}">
                                    <button type="button" class="delete-photo-btn" onclick="removeGalleryImage({{ $photo->id }})">×</button>
                                    <img src="{{ asset('upload/samples/' . $photo->image_path) }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="gallery-preview-container" class="mt-2 d-flex flex-wrap"></div>
                    </div>

                    <hr>

                    <div class="form-group mt-3">
                        <label style="margin-right: 20px; cursor:pointer;">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $sample->featured) ? 'checked' : '' }}> <strong>Featured</strong>
                        </label>
                        <label style="cursor:pointer;">
                            <input type="checkbox" name="status" value="1" {{ old('status', $sample->status) === 'active' ? 'checked' : '' }}> <strong>Active</strong>
                        </label>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-warning btn-lg btn-block"><i class="fa fa-refresh"></i> Apply Modifications</button>
                        <a href="{{ route('admin.samples.index') }}" class="btn btn-default btn-block">Discard Changes</a>
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
                                        $(document).ready(function() {
                                        $('.select2-autocomplete').select2({
                                        allowClear: true,
                                                placeholder: "Select an option"
                                        });
                                        var quill = new Quill('#editor-container', {
                                        theme: 'snow',
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
                                        $('#thumbnail-trigger').on('click', function() { $('#thumbnail-input').click(); });
                                        $('#gallery-trigger').on('click', function() { $('#gallery-input').click(); });
                                        $('#thumbnail-input').on('change', function() {
                                        if (this.files && this.files[0]) {
                                        let reader = new FileReader();
                                        reader.onload = (e) => { $('#thumbnail-preview').attr('src', e.target.result); }
                                        reader.readAsDataURL(this.files[0]);
                                        }
                                        });
                                        $('#gallery-input').on('change', function() {
                                        $('#gallery-preview-container').html('');
                                        $.each(this.files, function(i, file) {
                                        let reader = new FileReader();
                                        reader.onload = function (e) {
                                        $('#gallery-preview-container').append(`<div class="gallery-preview-item"><img src="${e.target.result}"></div>`);
                                        }
                                        reader.readAsDataURL(file);
                                        });
                                        });
                                        });
                                        function removeGalleryImage(photoId) {
                                        if (confirm('Permanently remove this image from gallery?')) {
                                        $.ajax({
                                        // Route configuration matching web.php definitions perfectly
                                        url: "{{ url('admin/samples/gallery-image') }}/" + photoId,
                                                type: "DELETE",
                                                data: { "_token": "{{ csrf_token() }}" },
                                                success: function(response) {
                                                if (response.success) {
                                                $(`#gallery-item-${photoId}`).fadeOut(300, function() { $(this).remove(); });
                                                }
                                                },
                                                error: function(xhr) {
                                                console.error("AJAX validation runtime structural link breakdown.", xhr);
                                                }
                                        });
                                        }
                                        }
</script>
@endsection
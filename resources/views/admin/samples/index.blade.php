@extends('layouts.backend')

@section('top')
<style>
    .table-hover tbody tr:hover {
        background-color: #e7f3ff !important;
        color: #0056b3;
    }
    .modal-header.bg-primary {
        background-color: #3c8dbc !important;
        color: white;
    }
    .th-sortable {
        cursor: pointer;
        color: #337ab7;
        text-decoration: none;
    }
    .th-sortable:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Garment Tech Pack & Sample Showroom</h3>

        <span class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal" style="margin-top: -8px; margin-right: 5px;">
                <i class="fa fa-file-excel-o"></i> Import Excel
            </button>

            <a href="{{ route('admin.samples.create') }}" class="btn btn-success" style="margin-top: -8px;">
                <i class="fa fa-plus"></i> Add New Sample
            </a>
        </span>
        <hr/>

        <form method="GET" action="{{ url()->current() }}" id="filter-form">
            <div class="filtering_area">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Global Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Search PO, style, name..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Filter By Buyer</label>
                            <select class="form-control filter-control" name="buyer_id" id="buyer_id">
                                <option value="">All Buyers</option>
                                @foreach($buyers as $id => $name)
                                <option value="{{ $id }}" {{ request('buyer_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Filter By Category</label>
                            <select class="form-control filter-control" name="category_id" id="category_id">
                                <option value="">All Categories</option>
                                @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Rack, Room..." value="{{ request('location') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                        <a href="{{ url()->current() }}?clear_filters=1" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Reset</a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="sort_by" value="{{ request('sort_by', 'id') }}">
            <input type="hidden" name="sort_order" value="{{ request('sort_order', 'desc') }}">
        </form>
    </div>

    <div class="box-body table-responsive">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('error') }}
        </div>
        @endif

        <table id="samples-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th width="6%">
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            ID {!! request('sort_by', 'id') == 'id' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>Image</th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'po', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            PO/Item {!! request('sort_by') == 'po' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'season', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            Season {!! request('sort_by') == 'season' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>Category</th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'style', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            Style {!! request('sort_by') == 'style' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            Item Name {!! request('sort_by') == 'name' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>Buyer</th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'color', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            Color {!! request('sort_by') == 'color' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>
                        <a class="th-sortable" href="{{ request()->fullUrlWithQuery(['sort_by' => 'qty', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                            Qty {!! request('sort_by') == 'qty' ? (request('sort_order') == 'asc' ? '▲' : '▼') : '' !!}
                        </a>
                    </th>
                    <th>Tag</th>
                    <th>Location</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($samples as $sample)
                <tr>
                    <td><b>{{ $sample->id }}</b></td>
                    <td>
                        @if($sample->images && $sample->images->first())
                        <img src="{{ asset('upload/samples/' . $sample->images->last()->image_path) }}" alt="Sample Image" style="width: 50px; height: auto;">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $sample->po }}</td>
                    <td>{{ $sample->season }}</td>
                    <td>{{ $sample->category->name ?? 'N/A' }}</td>
                    <td>{{ $sample->style }}</td>
                    <td>{{ $sample->name }}</td>
                    <td>{{ $sample->buyer->name ?? 'N/A' }}</td>
                    <td>{{ $sample->color }}</td>
                    <td>{{ $sample->qty }}</td>
                    <td>{{ $sample->tag }}</td>
                    <td>{{ $sample->location }}</td>
                    <td>
                        <a href="{{ route('admin.samples.show', $sample->id) }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.samples.edit', $sample->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                        <button type="button" onclick="deleteData({{ $sample->id }})" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center">No samples found matching criteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pull-right">
            {{ $samples->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.samples.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="importModalLabel">Import Samples from Excel</h4>
                </div>
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h4>Note:</h4>
                        <p>Please ensure your Excel column headers match the required format: Company ID, Buyer ID, PO/ITEM, SEASON, STYLE, CATEGORY ID, ITEM NAME, COLOR, SIZE, Sample Type ID, QTY, TAG, LOCATION.</p>
                    </div>
                    <div class="form-group">
                        <label>Select Excel File</label>
                        <input type="file" name="excel_file" class="form-control" accept=".xlsx, .xls, .csv" required>
                        <p class="help-block">Max file size: 2MB</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Start Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<form id="delete-form" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('bot')
<script type="text/javascript">
    $(document).ready(function () {
    $('.filter-control').on('change', function() {
    $('#filter-form').submit();
    });
    });
    function deleteData(id) {
    if (confirm('Are you sure you want to delete this sample registration?')) {
    var form = $('#delete-form');
    form.attr('action', "{{ url('admin/samples') }}/" + id);
    $.ajax({
    url: form.attr('action'),
            type: "POST",
            data: form.serialize(),
            success: function (data) {
            alert(data.message || 'Sample profile removed successfully.');
            location.reload();
            },
            error: function (xhr) {
            console.error(xhr);
            alert('Something went wrong during deletion.');
            }
    });
    }
    }
</script>
@endsection
@extends('layouts.backend')

@section('top')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap.min.css">

<style>
    .hidden-excel-btn {
        display: none !important;
    }
    .table-hover tbody tr:hover {
        background-color: #e7f3ff !important;
        color: #0056b3;
    }
    .modal-header.bg-primary {
        background-color: #3c8dbc !important;
        color: white;
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
            
            @if(Auth::user()->role == 'admin')
            <a class="btn btn-warning" href="{{ route('tokens') }}" style="margin-top: -8px;"> Tokens</a>
            @endif
        </span>
        <hr/>

        <div class="filtering_area">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter By Buyer</label>
                        <select class="form-control filter-control" id="buyer_filter">
                            <option value="all">All Buyers</option>
                            @foreach($buyers as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter By Category</label>
                        <select class="form-control filter-control" id="category_filter">
                            <option value="all">All Categories</option>
                            @foreach($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 text-right" style="margin-top: 25px;">
                    <button id="bulk-print" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Print Marked</button>
                    <button id="bulk-excel" class="btn btn-info btn-sm"><i class="fa fa-file-excel-o"></i> Export Selection</button>
                </div>
            </div>
        </div>
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
                    <th width="3%"><input type="checkbox" id="select-all"></th>
                    <th>Image</th>
                    <th>PO/Item</th>
                    <th>Season</th>
                    <th>Style</th>
                    <th>Item Name</th>
                    <th>Buyer</th>
                    <th>Color</th>
                    <th>Qty</th>
                    <th>Tag</th>
                    <th>Location</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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

<iframe id="printf" style="display:none"></iframe>
@endsection

@section('bot')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    var table = $('#samples-table').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            url: "{{ route('admin.api.samples') }}",
            data: function (d) {
                d.buyer_filter = $('#buyer_filter').val();
                d.category_filter = $('#category_filter').val();
            }
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>t<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            extend: 'excelHtml5',
            title: 'Sample_Showroom_Export',
            className: 'hidden-excel-btn',
            exportOptions: {
                columns: [2, 3, 4, 5, 6, 7, 8, 9, 10]
            }
        }],
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'show_photo', name: 'show_photo', orderable: false, searchable: false},
            {data: 'po', name: 'po'},
            {data: 'season', name: 'season'},
            {data: 'style', name: 'style'},
            {data: 'name', name: 'name'},
            {data: 'buyer_name', name: 'buyer.name'},
            {data: 'color', name: 'color'},
            {data: 'qty', name: 'qty'},
            {data: 'tag', name: 'tag'},
            {data: 'location', name: 'location'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[2, 'desc']] // Default order by PO
    });

    // Custom Filters
    $('.filter-control').on('change', function () {
        table.draw();
    });

    // Select All Checkbox
    $('#select-all').on('click', function () {
        $('.sample-checkbox').prop('checked', this.checked);
    });

    // Trigger Hidden Export Button
    $('#bulk-excel').on('click', function () {
        table.button('.buttons-excel').trigger();
    });

    // Bulk Print Logic (Placeholder for your specific print logic)
    $('#bulk-print').on('click', function() {
        var selected = [];
        $('.sample-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length > 0) {
            window.open("{{ url('admin/samples/print/bulk') }}?ids=" + selected.join(','), '_blank');
        } else {
            alert('Please select at least one item to print.');
        }
    });
});

function deleteData(id) {
    if (confirm('Are you sure you want to delete this sample registration?')) {
        $.ajax({
            url: "{{ url('admin/samples') }}/" + id,
            type: "POST",
            data: {
                '_method': 'DELETE',
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#samples-table').DataTable().ajax.reload();
                alert(data.message);
            },
            error: function() {
                alert('Something went wrong during deletion.');
            }
        });
    }
}
</script>
@endsection
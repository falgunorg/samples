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
</style>
@endsection

@section('content')
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Garment Tech Pack & Sample Showroom</h3>

        <span class="pull-right">
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
        <table id="samples-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th width="3%"><input type="checkbox" id="select-all"></th>
                    <th>Image</th>
                    <th>Style No</th>
                    <th>Sample Name</th>
                    <th>Buyer</th>
                    <th>Category</th>
                    <th>Sample Type</th>
                    <th>Color</th>
                    <th>GSM</th>
                    <th>Status</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

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
        dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>t<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
                extend: 'excelHtml5',
                className: 'hidden-excel-btn',
                exportOptions: {
                    columns: [2, 3, 4, 5, 6, 7, 8]
                }
            }],
        columns: [
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'show_photo', name: 'show_photo', orderable: false, searchable: false},
            {data: 'style_no', name: 'style_no'},
            {data: 'sample_name', name: 'sample_name'},
            {data: 'buyer_name', name: 'buyer.name'},
            {data: 'category_name', name: 'category.name'},
            {data: 'sample_type', name: 'sampleType.name'},
            {data: 'color', name: 'color'},
            {data: 'gsm', name: 'gsm'},
            {data: 'status_label', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('.filter-control').on('change', function () {
        table.draw();
    });

    $('#select-all').on('click', function () {
        $('.sample-checkbox').prop('checked', this.checked);
    });

    $('#bulk-excel').on('click', function () {
        table.button('.buttons-excel').trigger();
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
            }
        });
    }
}
</script>
@endsection
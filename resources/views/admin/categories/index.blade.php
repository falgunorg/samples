@extends('layouts.backend')

@section('top')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Product Division Classifications</h3>
        <button onclick="addForm()" class="btn btn-warning pull-right btn-sm"><i class="fa fa-plus"></i> Add Category Node</button>
    </div>
    <div class="box-body table-responsive">
        <table id="master-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th width="10%">Illustration</th>
                    <th>Category Name</th>
                    <th>Slug URL String</th>
                    <th width="12%">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>Category Group Label *</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label>Category Artwork / Graphic Image File *</label>
                        <input type="file" id="img" name="img" class="form-control">
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('bot')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/validator/validator.min.js') }}"></script>

<script>
    var table = $('#master-table').DataTable({
        processing: true, 
        serverSide: true,
        ajax: "{{ route('admin.categories.api') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image_render', name: 'image_render', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    var save_method;
    function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#img').attr('required', true);
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Establish New Product Division Category');
        // Clear any lingering errors from validator library execution
        $('#modal-form form').validator('destroy').validator();
    }

    function editForm(id) {
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#img').attr('required', false);
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "{{ url('admin/categories') }}/" + id + "/edit",
            type: "GET", 
            dataType: "JSON",
            success: function(data) {
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit Division Node Characteristics');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#modal-form form').validator('destroy').validator();
            }
        });
    }

    function deleteData(id) {
        if (confirm('Completely drop this structural category branch?')) {
            $.ajax({
                url: "{{ url('admin/categories') }}/" + id,
                type: "POST", 
                data: {
                    '_method': 'DELETE', 
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() { 
                    table.ajax.reload(); 
                }
            });
        }
    }

    $(function() {
        $('#modal-form form').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                var url = (save_method == 'add') ? "{{ route('admin.categories.store') }}" : "{{ url('admin/categories') }}/" + id;
                $.ajax({
                    url: url, 
                    type: "POST", 
                    data: new FormData($(this)[0]),
                    contentType: false, 
                    processData: false,
                    success: function() { 
                        $('#modal-form').modal('hide'); 
                        table.ajax.reload(); 
                    }
                });
                return false;
            }
        });
    });
</script>
@endsection
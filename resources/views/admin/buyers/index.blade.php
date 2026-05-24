@extends('layouts.backend')

@section('top')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Buyer Accounts Matrix</h3>
        <button onclick="addForm()" class="btn btn-primary pull-right btn-sm"><i class="fa fa-plus"></i> Add Buyer Account</button>
    </div>
    <div class="box-body table-responsive">
        <table id="master-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="8%">ID</th>
                    <th>Buyer Identity Name</th>
                    <th>Slug Reference String</th>
                    <th width="12%">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal Construction Layout -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" data-toggle="validator">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>Corporate Account / Buyer Name *</label>
                        <input type="text" id="name" name="name" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Properties</button>
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
                processing: true, serverSide: true,
                ajax: "{{ route('admin.buyers.api') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            var save_method;
            function addForm() {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#modal-form').modal('show');
                $('#modal-form form')[0].reset();
                $('.modal-title').text('Register Corporate Client Buyer Account');
            }

            function editForm(id) {
                save_method = "edit";
                $('input[name=_method]').val('PATCH');
                $('#modal-form form')[0].reset();
                $.ajax({
                    url: "{{ url('admin/buyers') }}/" + id + "/edit",
                    type: "GET", dataType: "JSON",
                    success: function (data) {
                        $('#modal-form').modal('show');
                        $('.modal-title').text('Update Buyer Specifications');
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                    }
                });
            }

            function deleteData(id) {
                if (confirm('Drop this buyer registration entity?')) {
                    $.ajax({
                        url: "{{ url('admin/buyers') }}/" + id,
                        type: "POST", data: {'_method': 'DELETE', '_token': $('meta[name="csrf-token"]').attr('content')},
                        success: function () {
                            table.ajax.reload();
                        }
                    });
                }
            }

            $(function () {
                $('#modal-form form').validator().on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {
                        var id = $('#id').val();
                        var url = (save_method == 'add') ? "{{ route('admin.buyers.store') }}" : "{{ url('admin/buyers') }}/" + id;
                        $.ajax({
                            url: url, type: "POST", data: new FormData($(this)[0]),
                            contentType: false, processData: false,
                            success: function () {
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
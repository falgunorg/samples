@extends('layouts.backend')

@section('top')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>
    /* Custom styling to clearly distinguish unread rows */
    .unread-row {
        background-color: #fff8e1 !important; /* Light amber/yellow background */
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Customer Inquiries</h3>
    </div>
    <div class="box-body table-responsive">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @endif

        <table id="master-table" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Customer Details</th>
                    <th width="20%">Sample Requested</th>
                    <th>Message Snippet</th>
                    <th width="10%">Status</th>
                    <th width="18%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                    <tr class="{{ $inquiry->is_read ? 'read-row' : 'unread-row' }}">
                        <td>{{ $inquiry->id }}</td>
                        <td>
                            <strong>{{ $inquiry->name }}</strong><br>
                            <small class="text-muted">{{ $inquiry->email }}</small><br>
                            <small class="text-muted">{{ $inquiry->phone }}</small>
                        </td>
                        <td>
                            @if($inquiry->sample)
                                <a href="{{ route('admin.samples.show', $inquiry->sample_id) }}" target="_blank">{{ $inquiry->sample->name ?? 'View Sample' }}</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($inquiry->message, 80, '...') }}</td>
                        <td>
                            @if($inquiry->is_read)
                                <span class="label label-success">Read</span>
                            @else
                                <span class="label label-warning">Unread</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" class="btn btn-xs btn-info" title="View Detail">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="{{ route('admin.inquiries.toggle-read', $inquiry->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-xs btn-default" title="{{ $inquiry->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                    <i class="fa {{ $inquiry->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No inquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pull-right">
            {{ $inquiries->links() }}
        </div>
    </div>
</div>
@endsection
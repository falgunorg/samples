@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="margin-bottom: 15px;">
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-default">
                <i class="fa fa-arrow-left"></i> Back to Inquiries
            </a>

            <div class="pull-right">
                <form action="{{ route('admin.inquiries.toggle-read', $inquiry->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn {{ $inquiry->is_read ? 'btn-warning' : 'btn-success' }}">
                        <i class="fa {{ $inquiry->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i> 
                        Mark as {{ $inquiry->is_read ? 'Unread' : 'Read' }}
                    </button>
                </form>

                <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this inquiry permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Sender Information</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th width="35%">Name</th>
                        <td>{{ $inquiry->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $inquiry->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Company</th>
                        <td>{{ $inquiry->company ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Received At</th>
                        <td>{{ $inquiry->created_at->format('M d, Y h:i A') }} <br><small class="text-muted">({{ $inquiry->created_at->diffForHumans() }})</small></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($inquiry->is_read)
                            <span class="label label-success">Read</span>
                            @else
                            <span class="label label-warning">Unread</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @if($inquiry->sample)
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Requested Sample Item</h3>
            </div>
            <div class="box-body text-center">
                @if($inquiry->sample->images && $inquiry->sample->images->first())
                <img src="{{ asset('storage/' . $inquiry->sample->images->first()->path) }}" alt="Sample Image" class="img-thumbnail img-responsive" style="max-height: 150px; margin-bottom: 10px;">
                @endif
                <h4><strong>{{ $inquiry->sample->name }}</strong></h4>
                <p class="text-muted">Location: <code>{{ $inquiry->sample->location ?? 'N/A' }}</code></p>
                <p class="text-muted">Tag: <code>{{ $inquiry->sample->tag ?? 'N/A' }}</code></p>
                <a href="{{ route('admin.samples.show', $inquiry->sample_id) }}" class="btn btn-sm btn-block btn-primary" target="_blank">
                    <i class="fa fa-external-link"></i> View Sample Page
                </a>
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-8">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Inquiry Message</h3>
            </div>
            <div class="box-body" style="background: #fafafa; min-height: 280px; padding: 20px;">
                <p style="font-size: 15px; line-height: 1.6; white-space: pre-line;">{!! e($inquiry->message) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.backend')

@section('content')

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ \App\Models\Category::count() }}<sup style="font-size: 20px"></sup></h3>

                <p>Category</p>
            </div>
            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
            <a href="{{ route('admin.categories.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ \App\Models\Buyer::count()}}</h3>
                <p>Buyer</p>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="{{ route('admin.buyers.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ \App\Models\Sample::count()  }}</h3>
                <p>Sample</p>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="{{ route('admin.samples.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ \App\Models\Inquiry::count() }}</h3>
                <p>Inquiry</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>

@endsection

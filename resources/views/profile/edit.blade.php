@extends('layouts.backend')

@section('title', 'Edit Profile - FALGUN')

@section('content')
    <!-- Load Tailwind temporarily for Breeze partial forms to style correctly -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding: 15px 25px 0 25px;">
        <h1>
            {{ __('Profile') }}
            <small>Manage your account settings</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <!-- Profile Information Box -->
                <div class="box box-success" style="margin-bottom: 25px;">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="font-weight: 700;">Update Profile Details</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Update Password Box -->
                <div class="box box-success" style="margin-bottom: 25px;">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="font-weight: 700;">Change Password</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Delete Account Box -->
                <div class="box box-danger" style="margin-bottom: 25px;">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="font-weight: 700; color: #dd4b39;">Delete Account</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
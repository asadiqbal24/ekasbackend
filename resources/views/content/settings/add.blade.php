@extends('layouts/layoutMaster')

@section('title', ' Add Courses')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
  'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/flatpickr/flatpickr.js',
  'resources/assets/vendor/libs/select2/select2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/form-layouts.js'])
@endsection

@section('content')

@if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success : </strong> {{ session('message') }}
        </div>
    @endif

    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add logo</h4>
            <p class="card-title-desc">You can add your logo here</p>
            <form enctype="multipart/form-data" action="{{ route('settings.store') }}" method="post">
@csrf
<div class="mb-3">
    <label class="form-label">Admin Logo</label>
    @if($dashboard_logo = App\Services\SettingService::getSetting('dashboard_logo'))
        <div>
            <img src="{{ asset('storage/' . $dashboard_logo) }}" alt="Admin Logo" style="width: 122px;height: auto;margin-bottom: 20px;">
        </div>
    @endif
    <input type="file" class="form-control" name="image" accept="image/*">
</div>
<div class="mb-3">
    <label class="form-label">Site Logo</label>
    @if($site_logo = App\Services\SettingService::getSetting('site_logo'))
        <div>
            <img src="{{ asset('storage/' . $site_logo) }}" alt="Site Logo" style="width: 122px;height: auto;margin-bottom: 20px;">
        </div>
    @endif
    <input type="file" class="form-control" name="mainimage" accept="image/*">
</div>
<div class="mb-3">
    <label class="form-label">User Login & Sign</label>
    @if($user_dashbord_logo = App\Services\SettingService::getSetting('user_dashbord_logo'))
        <div>
            <img src="{{ asset('storage/' . $user_dashbord_logo) }}" alt="User Dashboard Logo" style="width: 122px;height: auto;margin-bottom: 20px;">
        </div>
    @endif
    <input type="file" class="form-control" name="user_dashbord_logo" accept="image/*">
</div>
<div class="mb-3">
    <label class="form-label">User Dashbaord Logo</label>
    @if($user_normal_logo = App\Services\SettingService::getSetting('user_normal_logo'))
        <div>
            <img src="{{ asset('storage/' . $user_normal_logo) }}" alt="User Not Logged In Logo" style="width: 122px;height: auto;margin-bottom: 20px;">
        </div>
    @endif
    <input type="file" class="form-control" name="user_normal_logo" accept="image/*">
</div>
<div class="mb-3">
    <label class="form-label">User Edit Profile Logo</label>
    @if($user_logged_in_logo = App\Services\SettingService::getSetting('user_logged_in_logo'))
        <div>
            <img src="{{ asset('storage/' . $user_logged_in_logo) }}" alt="User Logged In Logo" style="width: 122px;height: auto;margin-bottom: 20px;">
        </div>
    @endif
    <input type="file" class="form-control" name="user_logged_in_logo" accept="image/*">
</div>
<div class="mb-3">
<label class="form-label">Favicon</label>
@if($favicon = App\Services\SettingService::getSetting('favicon'))
    <div>
        <img src="{{ asset('storage/' . $favicon) }}" alt="Favicon" style="width: 122px;height: auto;margin-bottom: 10px;">
    </div>
@endif
<input type="file" class="form-control" name="favicon" accept="image/*">
</div>

<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Site Title</label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="site_title" placeholder="Site Title...." value="{{ App\Services\SettingService::getSetting('site_title') }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Tag Line</label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="tagline" placeholder="Tag Line...." value="{{ App\Services\SettingService::getSetting('tagline') }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Meta Title</label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="meta_title" placeholder="Meta Title...." value="{{ App\Services\SettingService::getSetting('meta_title') }}">
    </div>
</div>
<div class="mb-3 row">
    <label for="example-text-input" class="col-md-2 col-form-label">Meta Description</label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="meta_description" placeholder="Meta Description ...." value="{{ App\Services\SettingService::getSetting('meta_description') }}">
    </div>
</div>
<div class="mt-4">
    <button class="btn btn-primary w-md">Submit</button>
</div>
</form>

        </div>
    </div>
@endsection

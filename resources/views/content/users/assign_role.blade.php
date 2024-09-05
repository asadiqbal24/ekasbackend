@extends('layouts/layoutMaster')

@section('title', ' Add Role To User')

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

@section('page-scripts')
<script>
    $('.admin-pass-eye').on('click', function() {
        if ($(this).hasClass('fa fa-eye')) {
            $('#password').attr('type', 'text');
            $(this).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        } else {
            $('#password').attr('type', 'password');
            $(this).removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
    })
</script>
@endsection

@section('content')
<div class="card">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Success : </strong> {{ session('message') }}
    </div>
    @endif
    <div class="card-body">
        <h4 class="card-title">{{ $heading }}</h4>

        <form action="{{url('update/user')}}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Enter Email</label>
                <div class="col-md-10">
                    <input class="form-control" type="email" value="{{$user->email}}" name="email" placeholder="Enter Email....">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Enter Username</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{$user->username}}" name="username" placeholder="Enter username...."
                        value="">
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                <div class="col-md-10">
                    <select class="form-control"
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
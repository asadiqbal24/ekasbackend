@extends('layouts/layoutMaster')

@section('title', ' Add Feedback')

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
    <form method="post" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$heading}} </h4>
                <p class="card-title-desc">{{$subheading}}</p>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="name" placeholder="Enter Name...." required="">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Title</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="title" placeholder="Enter Title Name...."
                            required="">
                        @error('title')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Image</label>
                    <div class="col-md-10">
                        <input class="form-control" type="file" name="image" placeholder="Enter Image Name...."
                            required="" >
                        @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Write Review</label>
                    <div class="col-md-10">
                        <textarea name="review" id="" cols="30" rows="10" class="form-control" placeholder="Enter Review"></textarea>
                        @error('review')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </div>
        </div>
        
        
    </form>

@endsection


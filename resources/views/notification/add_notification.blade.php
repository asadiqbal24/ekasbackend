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

    
<!-- Basic Layout & Basic with Icons -->
<form method="post" action="{{ route('notification.store') }}">
    @csrf

<div class="row">
  <!-- Basic Layout -->
  <div class="">
    <div class="card mb-6">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title">Add Notification</h4>
      </div>
      <div class="card-body">
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Enter Title</label>
                <div class="col-md-10">
                    <input class="form-control" required type="text" name="title" placeholder="Enter Tittle...."
                       >
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
            </div>
    
    
            <div class="mb-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">
                   Description:</label>
                <div class="col-md-10">
                    
                        <textarea  required class="form-control"  name="description" id="description" col="5" row="5"></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
            </div>
    
    
    
    
    
            <div class="mb-3 ">
             <button type="submit" style="    float: right;
    margin-top: 10px;" class="btn btn-primary">Save</button>
            </div>
       
      </div>
    </div>
  </div>


 
  

</form>



</div>







@endsection

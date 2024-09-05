@extends('layouts/layoutMaster')

@section('title', 'Excel Upload')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/js/courses.js'])
@endsection

@section('content')

<!-- Users List Table -->
{{-- <div class="card">
  <div class="card-header pb-0">
    <h5 class="card-title mb-0">Courses</h5>
  </div>
</div> --}}

@if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success : </strong> {{ session('success') }}
            </div>
        @endif

<form method="POST" enctype="multipart/form-data" action="{{ route('import.excel.data') }}">
    @csrf
<div class="card">
    <h5 class="card-header">Import Data</h5>
    <div class="card-body">
      <div class="mb-4">
        <input type="file" class="form-control" name="file" accept=".xlsx , .csv">

      </div>
      <div>
        <button class="btn btn-sm btn-success">Submit</button>
        <a href="{{asset('courses.xlsx')}}" class="btn btn-sm btn-primary" download="sample file">Sample File</a>
    </div>
      
    </div>
  </div>
</form>
@endsection

@extends('layouts/layoutMaster')

@section('title', 'Payments List')

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
@vite(['resources/js/payments.js'])
@endsection

@section('content')

<!-- Users List Table -->
<div class="card">
  <div class="card-header pb-0">
    <h5 class="card-title mb-0">Booking Payments</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead>
        <tr>
          
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Amount</th>
          <th scope="col">Currency</th>
          <th scope="col">Status</th>
          <th scope="col">Phone No</th>
          <th scope="col">Service Type</th>
          <th scope="col">Date</th>
          <th scope="col">Package</th>
          {{-- <th scope="col">Actions</th> --}}


          
        </tr>
      </thead>
    </table>
  </div>
 
</div>
@endsection

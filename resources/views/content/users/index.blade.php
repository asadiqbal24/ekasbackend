@extends('layouts/layoutMaster')

@section('title', 'Users List')

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
@vite(['resources/js/users.js'])
@endsection

@section('content')


<div class="card">
  <div class="card-header pb-0">
    <h5 class="card-title mb-0 mb-3">Users</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead>
        <tr>
            <th>#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Date & Time</th>
            <th scope="col">Roles</th>
            <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$user->fname}} {{$user->lname}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->datetime}}</td>
          <td>User</td>
          <td><a href="{{url('delete/user',$user->id)}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect"  onclick="return confirm('Are you sure you want to delete this?')" ><i class="ri-delete-bin-7-line ri-20px"></i></a> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 
</div>
@endsection

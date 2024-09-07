@extends('layouts/layoutMaster')

@section('title', 'Courses List')

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

{{-- <div class="row g-6 mb-6">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-2">{{$totalUser}}</h4>
              <p class="text-success mb-1">(100%)</p>
            </div>
            <small class="mb-0">Total Users</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-primary rounded-3">
              <div class="ri-user-line ri-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Verified Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-1">{{$verified}}</h4>
              <p class="text-success mb-1">(+95%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-success rounded-3">
              <div class="ri-user-follow-line ri-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Duplicate Users</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-1">{{$userDuplicates}}</h4>
              <p class="text-danger mb-1">(0%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-danger rounded-3">
              <div class="ri-group-line ri-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="me-1">
            <p class="text-heading mb-1">Verification Pending</p>
            <div class="d-flex align-items-center">
              <h4 class="mb-1 me-1">{{$notVerified}}</h4>
              <p class="text-success mb-1">(+6%)</p>
            </div>
            <small class="mb-0">Recent analytics</small>
          </div>
          <div class="avatar">
            <div class="avatar-initial bg-label-warning rounded-3">
              <div class="ri-user-unfollow-line ri-26px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div> --}}
<!-- Users List Table -->
<div class="card">
  <div class="card-header pb-0 d-flex"  style="justify-content: space-between;">
      
    <h5 class="card-title mb-5">Courses</h5>
      <a href="{{route('addCourse')}}" class="btn btn-primary" style="    padding: 5px 14px;
    height: 40px;">Add Courses</a>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead>
        <tr>
          
          <th scope="col">#</th>
          <th scope="col">University Name</th>
          <th scope="col">Program Name</th>
          <th scope="col">Subject Field</th>
          <th scope="col">Location</th>
          <th scope="col">Actions</th>
          
        </tr>
      </thead>


      <tbody>
        @foreach($courses as $cou)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$cou->universityname}}</td>
          <td>{{$cou->programmename}}</td>
          <td>{{$cou->fieldofstudy}}</td>
          <td>{{$cou->location}}</td>
          <td>
              <a href="{{url('delete/admin/course',$cou->id)}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect" data-id="{{$cou->id}}" onclick="return confirm('Are you sure you want to delete this?')"><i class="ri-delete-bin-7-line ri-20px"></i></a>
                <a href="{{url('edit/admin/course',$cou->id)}}" class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect"><i class="ri-edit-line ri-20px"></i></a>
             
              </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
 
</div>
@endsection

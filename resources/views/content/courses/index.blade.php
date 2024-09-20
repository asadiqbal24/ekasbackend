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

<div class="card mb-3">
  <form method="GET" action="{{ route('courses') }}">
    <div class="card-header pb-0 d-flex" style="justify-content: space-between;">
      <div style="display: flex; align-items: baseline;">
        <h5 class="card-title mb-5" style="margin-right: 10px;">Filter</h5>
      </div>
      <div>
        <button class="btn btn-primary" style="padding: 5px 14px; height: 40px;" type="submit">Search</button>
        <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 5px 14px; height: 40px;">Reset</a>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <label for="uni_name">University Name</label>
          <input type="text" name="uni_name" class="form-control" style="height: 40px;"
                 value="{{ old('uni_name', request('uni_name')) }}">
        </div>
        <div class="col-md-3">
          <label for="prog_name">Program Name</label>
          <input type="text" name="prog_name" class="form-control" style="height: 40px;"
                 value="{{ old('prog_name', request('prog_name')) }}">
        </div>
        <div class="col-md-3">
          <label for="field_of_study">Field Of Study</label>
          <input type="text" name="field_of_study" class="form-control" style="height: 40px;"
                 value="{{ old('field_of_study', request('field_of_study')) }}">
        </div>
        <div class="col-md-3">
          <label for="location">Location</label>
          <input type="text" name="location" class="form-control" style="height: 40px;"
                 value="{{ old('location', request('location')) }}">
        </div>
      </div>
    </div>
  </form>
</div>


<form id="bulk-delete-form" action="{{ url('delete/admin/courses') }}" method="POST">
  @csrf
  <div class="card">
    <div class="card-header pb-0 d-flex" style="justify-content: space-between;">
      <div style="display: flex; align-items: baseline;">
        <h5 class="card-title mb-5" style="    margin-right: 10px;">Courses</h5>
        <!-- Initially hidden delete button -->
        <button type="submit" class="btn btn-danger d-none" id="bulk-delete-btn">Delete</button>
      </div>
      <div>
        <a href="{{ route('addCourse') }}" class="btn btn-primary" style="padding: 5px 14px; height: 40px;">Add Courses</a>
        <a href="{{ url('/excel/upload') }}" class="btn btn-primary" style="padding: 5px 14px; height: 40px;">Import</a>
        <a href="{{ url('/trash/courses') }}" class="btn btn-primary" style="padding: 5px 14px; height: 40px;">Trash</a>
      </div>
    </div>
    <div class="card-datatable table-responsive">
      <table class="datatables-users table">
        <thead>
          <tr>
            <th scope="col"><input type="checkbox" id="select-all"></th>
            <th scope="col">#</th>
            <th scope="col">University Name</th>
            <th scope="col">Program Name</th>
            <th scope="col">Field Of Study</th>
            <th scope="col">Location</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courses as $cou)
          <tr>
            <td><input type="checkbox" name="course_ids[]" value="{{ $cou->id }}" class="select-item"></td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cou->universityname }}</td>
            <td>{{ $cou->programmename }}</td>
            <td>{{ $cou->fieldofstudy }}</td>
            <td>{{ $cou->location }}</td>

            
            <td >
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Actions
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ url('courses-view', $cou->id) }}">View</a></li>
                  <li><a class="dropdown-item" href="{{ url('edit/admin/course', $cou->id) }}">Edit</a></li>
                  <li><a class="dropdown-item" href="{{ url('delete/admin/course', $cou->id) }}" onclick="return confirm('Are you sure you want to delete this?')">Delete</a></li>
                  
                </ul>
              </div>
            </td>
            
        
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-5" style="display: flex; justify-content: center;">
        {{ $courses->links() }}
      </div>
    </div>
</form>



</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<!-- <script>
  $(document).ready(function() {
    // Select/Deselect all checkboxes
    $('#select-all').on('click', function() {
      $('.select-item').prop('checked', this.checked);
      toggleBulkDeleteButton();
    });

    // Enable or disable the bulk delete button based on selections
    $('.select-item').on('change', function() {
      toggleBulkDeleteButton();
    });

    // Function to enable/disable the bulk delete button
    function toggleBulkDeleteButton() {
      $('#bulk-delete-btn').prop('disabled', $('.select-item:checked').length === 0);
    }

    // Disable the bulk delete button initially
    toggleBulkDeleteButton();
  });
</script> -->

<script>
  $(document).ready(function() {
    // Show or hide the delete button based on checkbox selection
    function toggleDeleteButton() {
      if ($('.select-item:checked').length > 0) {
        $('#bulk-delete-btn').removeClass('d-none');
      } else {
        $('#bulk-delete-btn').addClass('d-none');
      }
    }

    // Select/Deselect all checkboxes
    $('#select-all').on('click', function() {
      $('.select-item').prop('checked', this.checked);
      toggleDeleteButton();
    });

    // Enable or disable the delete button based on individual checkbox change
    $('.select-item').on('change', function() {
      toggleDeleteButton();
    });

    // Initialize the delete button state
    toggleDeleteButton();


    $('#bulk-delete-form').on('submit', function(e) {
      // Show a confirmation dialog
      var confirmed = confirm('Are you sure you want to delete the selected courses?');

      // If the user cancels, prevent the form submission
      if (!confirmed) {
        e.preventDefault();
      }
    });
  });
</script>
@endsection
@extends('layouts/layoutMaster')

@section('title', 'Permission List')

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

@endsection

@section('content')


<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

<!-- Users List Table -->
<div class="card">
<div class="card-header mb-3 pb-0 d-flex "style="    justify-content: space-between;">
    <h5 class="card-title mb-0">Role List</h5>

    <a href="{{route('roles-create')}}" class="btn btn-primary">Create Role</a>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-permission table">
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">Name</th>
          <th scope="col">Guard</th>

          <th scope="col">Actions</th>

        </tr>
      </thead>

      <tbody>
      @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles-show',$role->id) }}">Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles-edit',$role->id) }}">Edit</a>
                </td>
             
            </tr>
            @endforeach
      </tbody>


    </table>
    
  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
  $(document).ready(function() {
    $('.datatables-permission').DataTable({
      // DataTables options here
      "paging": true,
      "searching": true,
      "info": true,
      "ordering": true
    });
  });
</script>


@endsection
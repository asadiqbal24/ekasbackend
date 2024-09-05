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
  <div class="card-header pb-0">
    <h5 class="card-title mb-0">Assigned permissions</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-permission table">
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">Name</th>
          <th scope="col">Guard</th>

        </tr>
      </thead>

      <tbody>
      @foreach($rolePermissions as $permission)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
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
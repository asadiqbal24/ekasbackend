@extends('layouts/layoutMaster')

@section('title', 'Ekas Guidance List')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
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




<!-- Users List Table -->
<div class="card">
  <div class="card-header pb-0">
    <h5 class="card-title mb-3">Ekas Guidance List</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-notification table">
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Country</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>

          <th scope="col">Actions</th>

        </tr>
      </thead>

      <tbody>
        @foreach($ekas_guidance_document as $guidance)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$guidance->name}}</td>
            <td>{{$guidance->email}}</td>
            <td>{{ucwords($guidance->guidance_country)}}</td>
            <td>{{$guidance->payment_status}}</td>
            <td>{{$guidance->type}}</td>
            <td>{{$guidance->status}}</td>
            <td>
            
            <a class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-btn" data-id="{{$guidance->id}}" href="javascript:void(0);" onclick="return confirmDelete(this)">
              <i class="ri-delete-bin-7-line ri-20px"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>


    
    </table>
  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>




<script>
  function confirmDelete(element) {
    var id = $(element).data('id');


    if (confirm('Are you sure you want to delete this?')) {
      $.ajax({
        url: '/ekas-guidance-delete/' + id,
        type: 'DELETE',
        data: {
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {

          alert('Record deleted successfully.');
          $(element).closest('tr').remove();
        },
        error: function(xhr) {

          alert('An error occurred while deleting the record.');
        }
      });
    }

    return false; // Prevent default link behavior
  }
</script>



@endsection
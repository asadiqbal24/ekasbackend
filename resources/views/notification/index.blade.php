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

@endsection

@section('content')


<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

<!-- Users List Table -->
<div class="card">
  <div class="card-header pb-0">
    <h5 class="card-title mb-0">Notification</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-notification table">
      <thead>
        <tr>
          <th>#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>

          <th scope="col">Actions</th>

        </tr>
      </thead>

      <tbody>
        @foreach($notificationData as $data)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$data->title}}</td>
          <td>{{$data->description}}</td>
          <td>
            <a class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect send-notification-btn">
              <i class="ri-send-plane-line ri-20px"></i>
            </a>
            <a class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect delete-btn" data-id="{{$data->id}}" href="javascript:void(0);" onclick="return confirmDelete(this)">
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
  $(document).ready(function() {
    $('.datatables-notification').DataTable({
      // DataTables options here
      "paging": true,
      "searching": true,
      "info": true,
      "ordering": true
    });
  });
</script>
<script>
  function confirmDelete(element) {
    var id = $(element).data('id');


    if (confirm('Are you sure you want to delete this?')) {
      $.ajax({
        url: '/notification-delete/' + id,
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


<script>
  $('.send-notification-btn').on('click', function() {

    var notificationTitle = '{{ $data["title"] ?? "" }}';
    var notificationDescription = '{{ $data["description"] ?? "" }}';

    $.ajax({
      url: '/send-notification',
      method: 'POST',
      data: {
        title: notificationTitle,
        description: notificationDescription,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        console.log(response.status);
      },
      error: function(error) {
        console.error('Error sending notification:', error);
      }
    });
  });
</script>



@endsection
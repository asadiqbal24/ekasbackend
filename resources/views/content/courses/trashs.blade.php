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



<!-- Users List Table -->

<form id="bulk-delete-form" action="{{ url('remove/admin/courses') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header pb-0 d-flex" style="justify-content: space-between;">
            <div style="display: flex; align-items: baseline;">
                <h5 class="card-title mb-5" style="    margin-right: 10px;">Courses</h5>
                <!-- Initially hidden delete button -->
                <button type="submit" class="btn btn-danger d-none" id="bulk-delete-btn">Restore</button>
            </div>
            <div>
                <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 5px 14px; height: 40px;">Back</a>
              
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
                        <th scope="col">Subject Field</th>
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


                        <td>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">View</a></li>
                                   

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
            var confirmed = confirm('Are you sure you want to remove the selected courses?');

            // If the user cancels, prevent the form submission
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
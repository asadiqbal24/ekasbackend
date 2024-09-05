@extends('admin.layouts.app')
@push('title')
    <title>EKAS | All Courses </title>
@endpush
@section('head-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css">

    <style>
        .dt-buttons,
        .dt-search {
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Success : </strong> {{ session('message') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Courses</h4>
                        <div class="card-title-desc" style="display:inline;">
                            <form>
                                <div class="col-md-10" style="width:20%; display:flex; gap:5px; float:right;">
                                    <select class="form-control" name="location" id="location_filter">
                                        <option value="All" selected>All Locations</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Finland">Finland</option>
                                        <option value="Belgium">Belgium</option>
                                    </select>
                                </div>
                            </form>
                            <form id="bulk-delete-form" method="post" action="{{ route('delete.courses.force') }}">
                                @csrf
                                <div class="col-md-10" style="width:20%; display:flex; gap:5px;">
                                    <select class="form-control" name="bulk_action" id="bulk_action">
                                        <option value="" selected disabled> slect option </option>
                                        <option value="all">Select Bulk</option>
                                        <option value="delete_selected">Move to Trash</option>
                                    </select>
                                    <input type="hidden" name="selected_course_ids" id="selected_course_ids"
                                        value="">
                                    {{-- <button type="button" id="submit-button" class="btn btn-primary">Submit</button> --}}
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table" id="course_details">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">University Name</th>
                                            <th scope="col">Program Name</th>
                                            <th scope="col">Ranking</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Actions</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr data-courseid="{{ $course->id }}">
                                                <td>

                                                </td>
                                                <td>{{ $course->universityname }}</td>
                                                <td>{{ $course->programmename }}</td>
                                                <td>{{ $course->ranking }}</td>
                                                <td>{{ $course->location }}</td>
                                                <td>
                                                    <a href="delete/admin/course/{{ $course->id }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                                                    <a href="edit/admin/course/{{ $course->id }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="course-checkbox"
                                                        value="{{ $course->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" />
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedCourseIds = [];
            $('#bulk_action').change(function() {
                if ($(this).val() === 'all') {
                    $('.course-checkbox').prop('checked', true);
                } else {
                    $('#bulk-delete-form').submit();
                }
                updateSelectedCourseIds();
            });

            $('.course-checkbox').change(function() {
                updateSelectedCourseIds();
            });

            function updateSelectedCourseIds() {

                $('.course-checkbox:checked').each(function() {
                    selectedCourseIds.push($(this).val());
                });
                $('#selected_course_ids').val(selectedCourseIds.join(','));
            }

            $('#bulk_action').on('change', function() {
                if ($(this).val() == 'delete_selected') {

                }
            })
        });
    </script>
@endsection

@extends('layouts/layoutMaster')

@section('title', 'Feedback List')

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
{{-- @vite(['resources/js/users.js']) --}}

@endsection

@section('content')

<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

<div class="container-fluid">
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Success : </strong> {{ session('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex" style="justify-content: space-between;">
                        <h4 class="card-title">Session listing</h4>
                    
                    </div>

                    <div class="card-title-desc" style="display:inline;">
                        <div class="table-responsive">
                            <table class="datatables-sessions table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $key => $appoint)
                                    @foreach ($appoint->appointments_date as $index => $dates)
                                    <tr>
                                        @if ($index === 0)
                                        <td rowspan="{{ count($appoint->appointments_date) }}">{{ $key + 1 }}</td>
                                        <td rowspan="{{ count($appoint->appointments_date) }}">{{ $appoint->user->fname ?? 'No User' }} {{ $appoint->user->lname ?? '' }}</td>
                                        <td rowspan="{{ count($appoint->appointments_date) }}">{{ $appoint->service_type }}</td>
                                        <td rowspan="{{ count($appoint->appointments_date) }}">{{ $appoint->package }}</td>
                                        <td rowspan="{{ count($appoint->appointments_date) }}">{{ $appoint->user->email ?? 'No Email' }}</td>
                                        @endif
                                        <td>{{ $dates->date }}</td>
                                        <td>{{ $dates->time }}</td>
                                        @if ($index === 0)
                                        <td rowspan="{{ count($appoint->appointments_date) }}">
                                            <div class="dropdown">
                                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{route('user-session-report',$appoint->id)}}">Upload Pdf</a></li>
                                                    <li><a class="dropdown-item" href="{{route('zoom-link',$appoint->id)}}">Send Zoom Link</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<script>
    $(document).ready(function() {
        $('.datatables-sessions').DataTable({
            // DataTables options here
            "paging": true,
            "searching": true,
            "info": true,
            "ordering": true
        });
    });
</script>
@endsection
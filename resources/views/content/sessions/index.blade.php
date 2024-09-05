@extends('layouts/layoutMaster')

@section('title', 'Sessions List')

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
                    <div class="card-body">
                        <h4 class="card-title">All Sessions</h4>
                        <div class="card-title-desc" style="display:inline;">
                            <div class="table-responsive">
                                <table data-searchable="true" class="table" id="blogs_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Minutes</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">1st</th>
                                            <th scope="col">2nd</th>
                                            <th scope="col">3rd</th>
                                            <th scope="col">4th</th>
                                            <th scope="col">5th</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sessions as $key => $session)
                                            <tr>
                                                <td>{{ $key += 1 }}</td>
                                                <td>{{ $session['price'] }}</td>
                                                <td>{{ $session['minutes'] }}</td>
                                                <td>{{ $session["session"] }}</td>
                                                <td>{{ $session["ist"] }}</td>
                                                <td>{{ $session['second'] }}</td>
                                                <td>{{ $session['third'] }}</td>
                                                <td>{{ $session['fourth'] }}</td>
                                                <td>{{ $session['five'] }}</td>
                                                <td>
                                                    

                                                        <a href="{{url('/')}}/delete/session/{{ $session['id'] }}/{{ $session['source']}}" class="btn btn-sm btn-icon delete-record btn-text-secondary rounded-pill waves-effect" data-id="4301" onclick="return confirm('Are you sure you want to delete this?')"><i class="ri-delete-bin-7-line ri-20px"></i></a>

                                                        <a href="{{url('/')}}/edit/session/{{ $session['id'] }}/{{ $session['source']}}" class="btn btn-sm btn-icon delete-record btn-text-secondary rounded-pill waves-effect" data-id="4301" ><i class="ri-edit-line ri-20px"></i></a>

                                                    
                                                      
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

    <script>

$('#blogs_table').DataTable({
    searchable: false,
});

    
</script>
@endsection

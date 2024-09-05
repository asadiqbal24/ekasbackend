@extends('layouts/layoutMaster')

@section('title', ' Add Courses')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
'resources/assets/vendor/libs/cleavejs/cleave.js',
'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/select2/select2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/form-layouts.js'])
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Success : </strong> {{ session('message') }}
</div>
@endif


<!-- Basic Layout & Basic with Icons -->
<form method="post" action="{{ route('roles-store') }}">
    @csrf

    <div class="row">
        <!-- Basic Layout -->
        <div class="">
            <div class="card mb-6">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Add New Role</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name </label>
                        <div class="col-md-10">

                        <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="permissions" class="form-label">Assign Permissions</label>
                    <table class="table table-striped">
                    <thead>
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="20%">Name</th>
                        <th scope="col" width="1%">Guard</th> 
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}"
                                class='permission'>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>

                    </div>






                    <div class="mb-3 ">
                        <button type="submit" style="    float: right;
    margin-top: 10px;" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </div>
        </div>





</form>



</div>


<script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
                
            });
        });
    </script>




@endsection
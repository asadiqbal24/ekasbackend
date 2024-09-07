@extends('layouts/layoutMaster')

@section('title', ' Add Zoom')

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
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/js/form-layouts.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')

<script src="https://cdn.tiny.cloud/1/eoe3hgk632pcd6ls7hm49drdlf9gqie86gkagu39c3tetoo1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




@endsection


@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Success : </strong> {{ session('message') }}
</div>
@endif
<form method="post" action="{{ route('zoom-link-store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" value="{{$appointments->id}}" name="appointment_id">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $heading }}</h4>


            <div class="mb-3 mt-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Session Bundle</label>


                <div class="col-md-10">

                    <input type="text" name="package" value="{{ucwords($appointments->package)}}" readonly class="form-control">
                </div>
            </div>


            @if($appointments->package == "single")
            @foreach($appointments->appointments_date as $key => $dateTime)
            <div class="mb-3 mt-3 row">
                <label for="zoom-link-{{ $key + 1 }}" class="col-md-2 col-form-label">Zoom Link for Session {{ $key + 1 }}</label>
                <div class="col-md-6">
                    <input type="text" name="zoom_link[]" id="zoom-link-{{ $key + 1 }}" class="form-control" placeholder="Enter Zoom Link">
                </div>
                <div class="col-md-2">
                    <input type="date" readonly name="date[]" value="{{ $dateTime->date }}" class="form-control" placeholder="Select Date">
                </div>
                <div class="col-md-2">
                    <input type="time" readonly  name="time[]" value="{{ $dateTime->time }}" class="form-control" placeholder="Select Time">
                </div>
            </div>
            @endforeach

            @elseif($appointments->package == "bundle1")
            @foreach($appointments->appointments_date->take(2) as $key => $dateTime) {{-- Assuming bundle1 requires 2 sessions --}}
            <div class="mb-3 mt-3 row">
                <label for="zoom-link-{{ $key + 1 }}" class="col-md-2 col-form-label">Zoom Link for Session {{ $key + 1 }}</label>
                <div class="col-md-6">
                    <input type="text" name="zoom_link[]" id="zoom-link-{{ $key + 1 }}" class="form-control" placeholder="Enter Zoom Link">
                </div>
                <div class="col-md-2">
                    <input type="date" readonly name="date[]" value="{{ $dateTime->date }}" class="form-control" placeholder="Select Date">
                </div>
                <div class="col-md-2">
                    <input type="time" readonly name="time[]" value="{{ $dateTime->time }}" class="form-control" placeholder="Select Time">
                </div>
            </div>
            @endforeach

            @elseif($appointments->package == "bundle2")
            @foreach($appointments->appointments_date->take(4) as $key => $dateTime) {{-- Assuming bundle2 requires 4 sessions --}}
            <div class="mb-3 mt-3 row">
                <label for="zoom-link-{{ $key + 1 }}" class="col-md-2 col-form-label">Zoom Link for Session {{ $key + 1 }}</label>
                <div class="col-md-6">
                    <input type="text" name="zoom_link[]" id="zoom-link-{{ $key + 1 }}" class="form-control" placeholder="Enter Zoom Link">
                </div>
                <div class="col-md-2">
                    <input type="date" readonly name="date[]" value="{{ $dateTime->date }}" class="form-control" placeholder="Select Date">
                </div>
                <div class="col-md-2">
                    <input type="time" readonly name="time[]" value="{{ $dateTime->time }}" class="form-control" placeholder="Select Time">
                </div>
            </div>
            @endforeach
            @endif






            <!-- <div class="mb-3 mt-3 row">
                <label for="example-text-input" class="col-md-2 col-form-label">Select User</label>


                <div class="col-md-10">

                    <select id="select2Primary" class="select2 form-select select2-hidden-accessible" multiple="" data-select2-id="select2Primary" tabindex="-1" aria-hidden="true" name="user_id[]">

                        @foreach($users as $user)
                        <option value="{{$user->id}}" data-select2-id="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
                        @endforeach

                    </select>
                </div>
            </div> -->
            <!-- <div class="mb-3 row">
                <label for="example-datetime-local-input" class="col-md-2 col-form-label">Upload File</label>
                <div class="col-md-10">
                    <input class="form-control" id="pdfInput" name="user_pdf" type="file" accept="application/pdf">

                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                  
                    <small id="error-message" class="text-danger"></small>
                </div>
            </div> -->


            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-md">Submit</button>
                <button type="button" onclick="window.location.href='{{ url('appointment-list') }}'" class="btn btn-primary w-md">Go Back</button>

            </div>
        </div>
    </div>





</form>

<!-- CKEditor CDN -->


<!-- Include jQuery first -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Then include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#username').select2();
    });
</script>


<script>
    document.getElementById('pdfInput').addEventListener('change', function() {
        var fileInput = this;
        var filePath = fileInput.value;
        var allowedExtension = /(\.pdf)$/i;

        if (!allowedExtension.exec(filePath)) {
            document.getElementById('error-message').textContent = "Only PDF files are allowed!";
            fileInput.value = ''; // Clear the input
        } else {
            document.getElementById('error-message').textContent = ''; // Clear any error messages
        }
    });
</script>



@endsection
@extends('layouts/layoutMaster')

@section('title', 'View Course')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Course Details Card -->
        <div class="card mb-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title">{{ $heading }}</h5>
                <a href="{{url('courses')}}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body">
                <!-- Display Course Title -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Title:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->title ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display University Name -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">University Name:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->namelocation ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display Application Open -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Application Open:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->Applicationopen ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Course Information Card -->
        <div class="card mb-6">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title">Key Information</h5>
            </div>
            <div class="card-body">
                <!-- Display Programme Name -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Programme Name:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->programmename ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Course Level:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->level ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Field of Study:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->fieldofstudy ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display University Ranking -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">University Ranking:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->ranking ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display Tuition Fee -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Tuition Fee (€):</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->tuitionfee ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Location (City, Country):</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->country ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display Study Mode -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Study Mode:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->studymode ?? 'N/A' }}</p>
                    </div>
                </div>


                   <!-- Display Study Mode -->
                   <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Entry Requirement:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->EntryRequirement ?? 'N/A' }}</p>
                    </div>
                </div>

                      <!-- Display Study Mode -->
                      <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">IELTS/TOFEL Requirement:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->IELTSTOFELRequirement ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">GRE/GMAT/SAT Requirement:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->GREGMATSATRequirement ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display Application Deadline -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Application Deadline:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->ApplicationDeadline ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Display URL -->
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">URL:</label>
                    <div class="col-md-10">
                        <p class="form-control-plaintext">{{ $course->URL ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

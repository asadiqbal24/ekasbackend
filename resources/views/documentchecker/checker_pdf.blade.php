@extends('layouts/layoutMaster')

@section('title', 'Document Checker')

<!-- Vendor Styles -->




<!-- Page Scripts -->
@section('page-script')

@endsection

@section('content')




<!-- Users List Table -->
<div class="card">
    <div class="card-header pb-0">
        <h5 class="card-title mb-3">Document Checker</h5>
    </div>
    <div class="card-datatable table-responsive">
        <table class="datatables-notification table">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Document</th>
                    <th scope="col">File name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>

            <tbody>

              


                @foreach ($documentFields as $field => $label)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $label }}</td>
                    <td>
                        @if (!empty($documents->$field))
                        <!-- Link to download the uploaded document -->
                        <a href="{{ url('https://localhost/ekasfrontend/storage/app/public/Customer/DocumentChecker/' . $documents->$field) }}" class="btn btn-sm btn-primary" target="_blank">Download</a>
                        @else
                        <button class="btn btn-sm btn-secondary" disabled>No Action</button>
                        @endif
                    </td>
                    <td>
                        @if (!empty($documents->$field))
                        @php
                        $status = isset($documentStatuses[$field]) ? $documentStatuses[$field]->status : null; // Use $field instead of $documents->$field
                        @endphp

                        @if ($status == 'approved')
                        <span class="badge bg-success">Approved</span>
                        @elseif ($status == 'disapproved')
                        <span class="badge bg-danger">Disapproved</span>
                        @else
                        <span class="badge bg-secondary">Not Reviewed</span>
                        @endif
                        @else
                        <span class="badge bg-secondary">No Document</span>
                        @endif
                    </td>
                    <td>
                        @if (!empty($documents->$field))
                        <!-- Approve or Disapprove actions -->
                        <form action="{{ route('document.approve') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="user_doc_id" value="{{ $documents->id }}">
                            <input type="hidden" name="file_name" value="{{ $field }}">
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>

                        <form action="{{ route('document.disapprove') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="user_doc_id" value="{{ $documents->id }}">
                            <input type="hidden" name="file_name" value="{{ $field }}">
                            <input type="hidden" name="status" value="disapproved">
                            <button type="submit" class="btn btn-sm btn-danger">Disapprove</button>
                        </form>
                        @else
                        <button class="btn btn-sm btn-secondary" disabled>No Action</button>
                        @endif
                    </td>
                </tr>
                @endforeach






            </tbody>




        </table>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>




@endsection
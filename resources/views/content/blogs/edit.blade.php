@extends('layouts/layoutMaster')

@section('title', 'Edit Blog')

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
    <form method="post" action="{{ route('blog.update' , $blog->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $heading }}</h4>
                <p class="card-title-desc">{{ $sub_heading }}</p>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Enter Title</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="title" placeholder="Enter Tittle...."
                            value="{{ $blog->title ?? '' }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Description</label>
                    <div class="col-md-10">
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description here">{{ $blog->description ?? '' }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="example-datetime-local-input" class="col-md-2 col-form-label">Image</label>
                    <div class="col-md-10">
                        <input class="form-control" name="image" type="file" accept="image/*">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">Select Blog Category</label>
                    <div class="col-md-10">
                        <select class="form-control" name="category">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" 
                                    @if(isset($blog) && $category->id == $blog->category) selected @endif 
                                    >{{$category->blogcategory}}</option>
                            @endforeach
                        </select>                
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                @if(!empty($blog->image))
                <div>
                    <label class="col-md-2 col-form-label">Current Image</label>
                    <div >
                        <img src="{{Illuminate\Support\Facades\Storage::url($blog->image)}} " alt="" height="200px" style="border: 1px solid black">
                    </div>
                </div>
                @endif
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                </div>
            </div>
        </div>
        
    
        
    </form>


        <!-- CKEditor CDN -->
        <script src="https://cdn.ckeditor.com/4.22.0/standard/ckeditor.js"></script>

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('description');
</script>

@endsection


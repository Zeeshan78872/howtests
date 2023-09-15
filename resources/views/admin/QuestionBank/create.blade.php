@extends('admin.layouts.app')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Question Bank</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Question Bank</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('questionBank.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="">Category</label>
                                <select class="form-select form-select-md " name="category_id" id="searchableSelect"
                                    placeholder="">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="">Choose File (xlsx)</label>
                                <input type="file" class="form-control " name="file" id="exampleFirstName"
                                    placeholder=".xlsx">
                                @error('file')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Submit
                            </button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script>
        $('#searchableSelect').select2({});
    </script>
@endsection

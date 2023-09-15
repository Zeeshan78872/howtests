@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="name" class="">Category Name</label>
                                <input type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ old('name') }}" placeholder="Category Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="name_auth" class="">Name Author</label>
                                <input type="text"
                                    class="form-control form-control-user @error('name_auth') is-invalid @enderror"
                                    name="name_auth" id="name_auth" value="{{ old('name_auth') }}"
                                    placeholder="Category Name Author">
                                @error('name_auth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The name author field is required.</strong>
                                    </span>
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

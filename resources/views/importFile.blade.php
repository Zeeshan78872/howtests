@extends('layouts.app')
@section('content')
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Laravel 10 Import Excel File - <a href="https://crexed.com" target="_blank">Crexed</a>
        </h2>
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (session()->has('success'))
                {{ session()->has('success') }}
            @endif
            @if (session()->has('error'))
                {{ session()->has('error') }}
            @endif
            <div class="form-group mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                name="title"value="{{ old('title') }}" id="title" placeholder="">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control  @error('desc') is-invalid @enderror" name="desc"
                                value="{{ old('desc') }}" id="desc" placeholder="">
                            @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Question Per Chapter</label>
                            <input type="number" class="form-control  @error('QperCh') is-invalid @enderror" name="QperCh"
                                value="{{ old('QperCh') }}" id="" placeholder="">
                            @error('QperCh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Choose Image</label>
                            <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image"
                                id="" placeholder="" value="{{ old('image') }}" aria-describedby="fileHelpId">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Choose file</label>
                            <input type="file" class="form-control  @error('file') is-invalid @enderror" name="file"
                                id="" placeholder="" aria-describedby="fileHelpId">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>


            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            {{-- <a class="btn btn-success" href="{{ route('export-users') }}">Export Users</a> --}}
        </form>
    </div>
@endsection

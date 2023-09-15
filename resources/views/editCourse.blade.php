@extends('layouts.app')
@section('content')
    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Laravel 10 Edit Course - <a href="https://crexed.com" target="_blank">Crexed</a>
        </h2>
        <form action="{{ route('updateCourse', $files->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{old('title',$files->title)  }}"
                                id="title" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" name="desc" value="{{ old('desc',$files->desc) }}"
                                id="desc" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Question Per Chapter</label>
                            <input type="number" class="form-control" value="{{ old('QperCh',$files->QperCh) }}" name="QperCh"
                                id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Choose Image</label>
                            <input type="file" class="form-control  @error('image') is-invalid @enderror" name="image"
                                id="" placeholder="" aria-describedby="fileHelpId">
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
                            <label for="" class="form-label">Choose Excel file</label>
                            <input type="file" class="form-control" name="file" id="" placeholder=""
                                aria-describedby="fileHelpId">
                        </div>
                    </div>
                </div>


            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            {{-- <a class="btn btn-success" href="{{ route('export-users') }}">Export Users</a> --}}
        </form>
    </div>
@endsection

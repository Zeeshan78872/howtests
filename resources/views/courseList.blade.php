@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($files as $file)
                <div class="col-md-4">
                    <div class="card bg-white" style="height:200px;">
                        {{-- <a href="#">  --}}
                            <div class="row no-gutters">
                                <!-- Left column for the image -->
                                <div class="col-md-4">
                                    <img src="{{ asset('images/' . $file->image) }}" class="card-img py-2 ps-2"
                                        style="height: 190px;" alt="...">
                                </div>

                                <!-- Right column for other content -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $file->title }}</h5>
                                        {{-- <p class="card-text">{{ $file->desc }}</p> --}}
                                        <a href="{{route('CourseDetail',$file->id)}}" class="btn btn-primary">View Detail</a>
                                    </div>
                                </div>

                            </div>
                        {{-- </a> --}}
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection

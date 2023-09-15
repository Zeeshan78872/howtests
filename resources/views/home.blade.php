@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div><a href="{{ route('import-view') }}" class="btn btn-primary" style="float: right">Upload Course</a></div>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table ">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Question per Chapter</th>
                        <th scope="col">Image</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($files as $file)
                        <tr class="">
                            <td>{{ $file->title }}</td>
                            <td>{{ $file->desc }}</td>
                            <td>{{ $file->QperCh }}</td>
                            <td><img src="{{ asset('images/' . $file->image) }}" style="width: 100px; height: 100px; "
                                    alt=""></td>
                            <td>{{ $file->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Download
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('generatePDF',['id'=>$file->id,'db'=>'QWA'])}}">Download (Question with Answer)</a></li>
                                        <li><a class="dropdown-item" href="{{route('generatePDF',['id'=>$file->id,'db'=>'Q'])}}">Downlload (Question only)</a></li>
                                        <li><a class="dropdown-item" href="{{route('generatePDF',['id'=>$file->id,'db'=>'AWE'])}}">Download ( Answer with Explanation)</a></li>

                                    </ul>
                                </div>
                                {{-- delete --}}
                                <a href="{{route('deleteCourse',$file->id)}}" class="text-danger"><i class="fa-solid fa-trash"></i></a>
                                {{-- edit --}}
                                <a href="{{route('editCourse',$file->id)}}" class="text-success"><i class="fa-solid fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>



    </div>
@endsection

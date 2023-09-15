@extends('admin.layouts.app')
@section('head')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        @component('components.successfull-model', ['title' => 'Mock'])
        @endcomponent
        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-2">
            <h1 class="h3 mb-2 text-gray-800">Mocks</h1> <a href="{{ route('Mock.create') }}" target="_blank"
                class="btn btn-primary">Add
                Mock</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Mock</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>DESC</th>
                                <th>T/P</th>
                                <th>Image</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($mocks as $mock)
                                <tr class="">
                                    <td>{{ $mock->title }}</td>
                                    <td>{{ $mock->author }}</td>
                                    <td>{{ !empty($mock->desc) ? 'Yes' : 'No' }}</td>
                                    <td>{{ $mock->question_per_ch }} - {{ $mock->page_count }}</td>
                                    <td><img src="{{ asset('images/mock/' . $mock->title_image) }}"
                                            style="width: 100px; height: 100px; " alt=""></td>
                                    <td>{{ $mock->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle mt-2"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Download
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a download class="dropdown-item"
                                                        href="{{ asset('pdfMock/QuestionWA/' . $mock->title . '_answer_' . $mock->id . '.pdf') }}">Download
                                                        (Question with Answer)
                                                    </a></li>
                                                <li><a download class="dropdown-item"
                                                        href="{{ asset('pdfMock/Question/' . $mock->title . $mock->id . '.pdf') }}">Downlload
                                                        (Question only)</a></li>
                                                <li><a download class="dropdown-item"
                                                        href="{{ asset('pdfMock/explanation/' . $mock->title . '_explanation_' . $mock->id . '.pdf') }}">Download
                                                        ( Answer with Explanation)</a></li>

                                            </ul>
                                        </div>
                                        <a href="{{ route('Mock.edit', $mock->id) }}"
                                            class="btn btn-sm btn-success mt-2"><i class="fa-solid fa-pencil"></i></a>

                                        {{-- delete --}}


                                        @component('components.delete-record-model', [
                                            'model_id' => $mock->id,
                                            'action' => route('Mock.softdelete', $mock->id),
                                        ])
                                        @endcomponent

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endsection

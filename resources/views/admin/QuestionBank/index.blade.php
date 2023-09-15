@extends('admin.layouts.app')
@section('head')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        @component('components.successfull-model', ['title' => 'Question'])
        @endcomponent
        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-2">
            <h1 class="h3 mb-2 text-gray-800">Question Bank</h1> <a href="{{ route('questionBank.create') }}"
                class="btn btn-primary">Add
                Question Bank</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Question</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Question</th>

                                <th>Answer</th>
                                <th>Explanation</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Questions as $question)
                                <tr class="">
                                    <td>{{ $question->categories->name }}</td>
                                    <td>{{ $question->question }}</td>

                                    <td>{{ $question->answer }}</td>
                                    <td>{{ isset($question->explanation) && !empty($question->explanation) ? 'Yes' : 'No' }}
                                    </td>
                                    <td>
                                        {{-- edit --}}
                                        <a href="{{ route('questionBank.edit', $question->id) }}"
                                            class="btn btn-success btn-sm mt-2"><i class="fa-solid fa-pencil"></i></a>
                                        <!-- delete -->
                                        @component('components.delete-record-model', [
                                            'model_id' => $question->id,
                                            'action' => route('questionBank.softdelete', $question->id),
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

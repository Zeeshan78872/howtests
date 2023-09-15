@extends('admin.layouts.app')
@section('head')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        @component('components.successfull-model', ['title' => 'Category'])
        @endcomponent
        <!-- Page Heading -->
        <div class="d-flex justify-content-between mb-2">
            <h1 class="h3 mb-2 text-gray-800">Category</h1> <a href="{{ route('category.create') }}"
                class="btn btn-primary">Add
                Category</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Name Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="">
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->name_auth }}</td>
                                    <td>
                                        {{-- delete --}}

                                        @component('components.delete-record-model', [
                                            'model_id' => $category->id,
                                            'action' => route('category.softdelete', $category->id),
                                        ])
                                        @endcomponent

                                        {{-- edit --}}
                                        <button type="button" class="btn btn-success btn-sm mt-2" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $category->id }}">
                                            <i class="fas  fa-pencil"></i>
                                        </button>

                                        <!-- Modal Body -->
                                        <div class="modal fade" id="modalEdit{{ $category->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Update</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('category.update', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                                    <label for="" class="">Category
                                                                        Name</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-user"
                                                                        name="name" id="exampleFirstName"
                                                                        value="{{ $category->name }}"
                                                                        placeholder="Category Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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

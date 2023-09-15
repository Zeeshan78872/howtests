@extends('admin.layouts.app')
@section('head')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Contact Us Users</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone NO</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($contacts as $client)
                                <tr class="">
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phoneNo }}</td>
                                    <td>{{ $client->message }}</td>
                                    <td>{{ $client->created_at->format('Y-m-d') }}</td>
                                    <td><button type="button" class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal"
                                            data-bs-target="#ModelDelete{{ $client->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- Modal (Question with Answer) -->
                                        <div class="modal fade" id="ModelDelete{{ $client->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                role="document">
                                                <div class="modal-content" id="downloadModal">
                                                    <div class="text-right py-2  px-3 w-100">
                                                        <button type="button" class="closebtn" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row text-center">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                                <div class="mb-3 text-center ">
                                                                    <i style="font-size: 100px;"
                                                                        class="fa-regular fa-circle-xmark text-danger"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                                <div class="mb-3">
                                                                    <div class="text-center p-4">
                                                                        <h5 class="modal-title" id="modalTitleId">Are you
                                                                            sure you want to delete ?
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                                <div class="mb-3">
                                                                    <div class="text-center p-4">
                                                                        <form
                                                                            action="{{ route('contactus.delete', $client->id) }}"
                                                                            method="POST">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>

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

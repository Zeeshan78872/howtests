@extends('layouts.app')

@section('content')
    <div class="container bg-white">
        @if (session('success'))
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
                var id = {{ $files->id ?? 'null' }};
                $.ajax({
                    url: "{{ route('generatePDF', ['id' => $files->id, 'db' => session('db')]) }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Process the response data here
                        console.log(data);
                    },
                    error: function(error) {
                        // Handle errors here
                        console.log('Error:', error);
                    }
                });
            </script>
        @endif

        <div class="row no-gutters">
            <!-- Left column for the image -->
            <div class="col-md-4">
                <img src="{{ asset('images/' . $files->image) }}" class="card-img py-2 ps-2" style="height: 190px;"
                    alt="...">
            </div>

            <!-- Right column for other content -->
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $files->title }}</h1>
                    <h4 class="card-text">{{ $files->desc }}</h4>

                    <!-- Modal (Question with Answer) -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#modalAddDetail1">
                        Download (Question with Answer)
                    </button>
                    <br>
                    <!-- Modal (Question) -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#modalAddDetail2">
                        Download (Question)
                    </button>
                    <br>
                    <!-- Modal (Answer with Explanation) -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target="#modalAddDetail3">
                        Download (Answer with Explanation)
                    </button>


                    <!-- Modal (Question with Answer) -->
                    <div class="modal fade" id="modalAddDetail1" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">Add Personal Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="clientForm" action="{{ route('addClient', $files->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="downloadBy" value="QWA">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" id=""
                                                        aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" id=""
                                                        aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Phone no.</label>
                                                    <input type="text" class="form-control" name="phoneNo" id=""
                                                        aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Download (Question) -->
                    <div class="modal fade" id="modalAddDetail2" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">Add Personal Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="clientForm" action="{{ route('addClient', $files->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="downloadBy" value="Q">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Phone no.</label>
                                                    <input type="text" class="form-control" name="phoneNo"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal (Answer with Explanation) -->
                    <div class="modal fade" id="modalAddDetail3" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">Add Personal Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="clientForm" action="{{ route('addClient', $files->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="downloadBy" value="AWE">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="co-md-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Phone no.</label>
                                                    <input type="text" class="form-control" name="phoneNo"
                                                        id="" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Optional: Place to the bottom of scripts -->
                    <script>
                        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                    </script>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
@endsection

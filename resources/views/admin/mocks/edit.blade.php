@extends('admin.layouts.app')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-image {
            border-radius: 10rem;
            line-height: 33px;
            height: 47px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Mocks</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Mock</h1>
                    </div>
                    <form class="user" action="{{ route('Mock.update', $mock->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="">Title</label>
                                <input type="text"
                                    class="form-control form-control-user @error('title') is-invalid @enderror"
                                    value="{{ $mock->title }}" name="title" id="exampleFirstName" placeholder="Title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="">Tagline</label>
                                <input type="text"
                                    class="form-control form-control-user @error('tagline') is-invalid @enderror"
                                    value="{{ $mock->tagline }}" name="tagline" id="exampleFirstName" placeholder="Tagline">
                                @error('tagline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <label for="" class="">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""
                                    cols="30" rows="4" maxlength="1000" placeholder="Description Here">{{ $mock->desc }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="author" class="">Author</label>
                                <input type="text"
                                    class="form-control form-control-user @error('author') is-invalid @enderror"
                                    value="{{ $mock->author }}" name="author" id="author" placeholder="Author">
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="file" class="">Book Title Image</label>
                                <input type="file" class="form-control  book-image  @error('file') is-invalid @enderror"
                                    name="file" id="file" placeholder="Tagline">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The book image field must be image.</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Update
                            </button>
                        </div>


                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script>
        const Tcategory = {};
        const TCalNumber = {};

        function CkeckQuestion(count) {
            let id = document.getElementById('searchableSelect' + count).value;
            Tcategory[count] = id;
            let url = '/checkQuestion/' + id;
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(response) {
                    $('#totalCount' + count).val(response.total_question);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        const previousNoOfQ = {};

        function CheckValid(count) {
            // let CurtotalCount = parseInt($('#CurrentTQues').val());
            let Category_id = document.getElementById('searchableSelect' + count).value;

            if (Tcategory[count] == Category_id) {

                let totalCount = parseInt($('#totalCount' + count).val());
                let noOfQ = parseInt($('#noOfQ' + count).val());

                if (TCalNumber[Category_id] == undefined) {
                    TCalNumber[Category_id] = 0;
                }
                previousNoOfQ[count] = noOfQ;
                let i = TCalNumber[Category_id] + noOfQ;
                if (noOfQ > totalCount && TCalNumber[Category_id] == 0) {
                    $("#error" + count).text("Total Question must be less or equal :" + totalCount);
                } else if (i > totalCount) {
                    $("#error" + count).text("Total Question must be less or equal :" + (totalCount - TCalNumber[
                        Category_id]));
                } else {
                    TCalNumber[Category_id] += noOfQ;
                    $('#CurrentTQues').val(TCalNumber[Category_id]);
                    $("#error" + count).text("");
                }
            }

        }

        $('#searchableSelect-1').select2({});
        $('.searchableSelect').select2({});
        categortCountElement = document.getElementById('categortCount');


        function removeField(fieldId) {
            console.log(fieldId);
            const CategoryFiled = document.getElementById('CategoryFiled');

            let fieldToRemove = document.getElementById('field_' + fieldId);

            CategoryFiled.removeChild(fieldToRemove);
            // CheckValid(fieldId);
        }
    </script>
@endsection

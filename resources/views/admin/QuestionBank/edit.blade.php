@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Question Bank</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Question Bank</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('questionBank.update', $questions->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="name" class="">Question</label>
                                <input type="text"
                                    class="form-control form-control-user @error('question') is-invalid @enderror"
                                    name="question" id="question" value="{{ $questions->question }}"
                                    placeholder="Category Name">
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="name_auth" class="">Option A</label>
                                <input type="text" class="form-control form-control-user " name="opt_a" id="opt_a"
                                    value="{{ $questions->opt_a }}" placeholder="">

                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="opt_b" class="">Option B</label>
                                <input type="text" class="form-control form-control-user " name="opt_b" id="opt_b"
                                    value="{{ $questions->opt_b }}" placeholder="">

                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="opt_b" class="">Option C</label>
                                <input type="text" class="form-control form-control-user " name="opt_c" id="opt_c"
                                    value="{{ $questions->opt_c }}" placeholder="">

                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="opt_b" class="">Option D</label>
                                <input type="text" class="form-control form-control-user " name="opt_d" id="opt_d"
                                    value="{{ $questions->opt_d }}" placeholder="">

                            </div>
                            <div class="col-sm-3 mb-3 mb-sm-0">
                                <label for="answer" class="">Answer</label>
                                <input type="text" class="form-control form-control-user " name="answer" id="answer"
                                    value="{{ $questions->answer }}" placeholder="">

                            </div>
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="answer">Explanation</label>
                                <textarea name="explanation" class="form-control" id="" cols="30" rows="5">{{ $questions->explanation }}</textarea>

                            </div>
                        </div>
                        <div class="">
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

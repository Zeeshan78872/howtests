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
            <h1 class="h3 mb-0 text-gray-800">Mock</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Mock</h1>
                    </div>
                    <form class="user" action="{{ route('Mock.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="" class="">Title</label>
                                <input type="text"
                                    class="form-control form-control-user @error('title') is-invalid @enderror"
                                    name="title" id="exampleFirstName" value="{{ old('title') }}" placeholder="Title">
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
                                    name="tagline" id="exampleFirstName" value="{{ old('tagline') }}" placeholder="Tagline">
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
                                    cols="30" rows="4" maxlength="1000" placeholder="Description Here">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class="">Meta Title</label>
                                <input type="text" class="form-control form-control-user" name="meta_title"
                                    id="exampleLastName" value="{{ old('meta_title') }}" placeholder="Meta Title">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="">Meta Keywords</label>
                                <input type="text"
                                    class="form-control form-control-user @error('meta_keywords') is-invalid @enderror"
                                    name="meta_keywords" id="exampleLastName" value="{{ old('meta_keywords') }}"
                                    placeholder="Meta Keywords">
                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="" class="">Meta Description</label>
                                <textarea name="meta_desc" class="form-control " id="" cols="30" rows="3"
                                    placeholder="Meta Description Here">{{ old('meta_desc') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-6">
                                <label for="" class="">Author</label>
                                <input type="text"
                                    class="form-control form-control-user @error('author') is-invalid @enderror"
                                    name="author" id="exampleLastName" value="{{ old('author') }}" placeholder="Author">
                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="t_no_question" class="">Total No. of Question</label>
                                <input type="number"
                                    class="form-control number-input form-control-user @error('question_per_ch') is-invalid @enderror"
                                    name="question_per_ch" id="t_no_question" value="{{ old('question_per_ch') }}"
                                    placeholder="Total Question in mock">
                                @error('question_per_ch')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The book title image is required.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="file" class="">Book Title Image</label>
                                <input type="file"
                                    class="form-control  book-image  @error('file') is-invalid @enderror" name="file"
                                    id="file" placeholder="Tagline">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The book title image is required.</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-sm-6">
                                <label for="extra_image" class="">Disclaimer Image </label>
                                <input type="file"
                                    class="form-control  book-image  @error('extra_image') is-invalid @enderror"
                                    name="extra_image" id="extra_image" placeholder="Tagline">
                                @error('extra_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The disclaimer image must be type image.</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-sm-6">
                                <label for="extra_image" class="">Privacy policy Image </label>
                                <input type="file"
                                    class="form-control  book-image  @error('extra_image_2') is-invalid @enderror"
                                    name="extra_image_2" id="extra_image_2" placeholder="Tagline">
                                @error('extra_image_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The privacy policy Image must be type image.</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="searchableSelect-1" class="">Category (2nd name)</label>
                                <select class="form-select form-select-md @error('category_id.0') is-invalid @enderror"
                                    name="category_id[]" onchange="CkeckQuestion(-1)" id="searchableSelect-1"
                                    placeholder="">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option {{ old('category_id.0') == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                            {{ $category->name_auth }}</option>
                                    @endforeach
                                </select>
                                @error('category_id.0')
                                    <span class="invalid-feedback mt-3" role="alert">
                                        <strong>The category field is required.</strong>
                                    </span>
                                @enderror
                                <input type="hidden" id="totalCount-1" value="">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="">No of Question</label>
                                <input type="number" class="form-control number-input" name="Cquestion[]"
                                    onchange="CheckValid(-1),Calculate(-1)" id="noOfQ-1" {{-- onkeyup="" --}}
                                    placeholder="Choose question from category @error('Cquestion.0') is-invalid @enderror"
                                    value="{{ old('Cquestion.0') }}">
                                @error('Cquestion.0')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The no of question field is required.</strong>
                                    </span>
                                @enderror
                                <span class="text-danger" id="error-1"></span>
                            </div>
                        </div>
                        <input type="hidden" name="remaning" id="remaning" value="{{ old('remaning', 0) }}">
                        <input type="hidden" name="CurrentTQues" id="CurrentTQues"
                            value="{{ old('CurrentTQues', 0) }}">

                        <input type="hidden" name="categortCount" value="{{ old('categortCount', 0) }}"
                            id="categortCount">
                        <div id="CategoryFiled">
                            @if (old('categortCount'))
                                @php
                                    $count = old('categortCount');
                                @endphp
                                @for ($i = 1; $i <= $count; $i++)
                                    @php
                                        $old = $i - 1;
                                    @endphp

                                    <div class="row form-group" id="field_{{ $old }}">
                                        <div class="col-sm-5 mb-3 mb-sm-0">
                                            <label for="totalCount{{ $old }}" class="">Category (2nd
                                                name)</label>
                                            <select
                                                class="form-select  form-select-md searchableSelect @error('category_id.' . $i) is-invalid @enderror"
                                                name="category_id[]" onchange="CkeckQuestion({{ $old }})"
                                                id="searchableSelect{{ $old }}" placeholder="">
                                                <option value="">Choose category</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        {{ old('category_id.' . $i) == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name_auth }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id.' . $i)
                                                <span class="invalid-feedback mt-3" role="alert">
                                                    <strong>The category field is required.</strong>
                                                </span>
                                            @enderror
                                            <input type="hidden" id="totalCount{{ $old }}" value="">

                                        </div>
                                        <div class="col-sm-5">
                                            <label for="" class="">No of Question</label>
                                            <input type="number"
                                                class="form-control number-input @error('Cquestion.' . $i) is-invalid @enderror"
                                                name="Cquestion[]"
                                                onchange="CheckValid({{ $old }}),Calculate({{ $old }})"
                                                {{-- onkeyup=""  --}} id="noOfQ{{ $old }}"
                                                value="{{ old('Cquestion.' . $i) }}"
                                                placeholder="Choose question from category">
                                            @error('Cquestion.' . $i)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>The no of question field is required.</strong>
                                                </span>
                                            @enderror
                                            <span class="text-danger" id="error{{ $old }}"></span>

                                        </div>
                                        <div class="col-sm-2 d-flex align-items-end justify-content-center">
                                            <button class="btn btn-danger" type="button"
                                                onclick="removeField({{ $old }})"><i
                                                    class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary btn-user" onclick="AddField()">Add More
                            </button>
                        </div>
                        <div class="mt-3">
                            <button type="submit" id="submitbtn" class="btn btn-primary btn-user btn-block">
                                Submit
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
            let CurtotalCount = parseInt($('#CurrentTQues').val());
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

        let remaning = document.getElementById('remaning');

        function Calculate(count) {
            let t_no_question = parseInt(document.getElementById('t_no_question').value);
            let question_error = document.getElementById('error' + count);
            console.log(t_no_question);

            if (remaning.value == 0) {
                remaning.value = t_no_question;
                console.log('remaining ' + remaning.value);

            }
            console.log(remaning.value);
            let select_question = parseInt(document.getElementById('noOfQ' + count).value);
            let remaningCont = parseInt(remaning.value)

            if (select_question > remaningCont) { // Change this condition
                console.log('Please put less than ' + remaningCont);
                question_error.textContent = 'Please put less than or equal to total no. of question ' + remaningCont;
                document.getElementById("submitbtn").disabled = true;

            } else {
                remaningCont = remaningCont - select_question;
                // let remaning = document.getElementById('remaning');
                remaning.value = remaningCont;
                question_error.textContent = '';
                document.getElementById("submitbtn").disabled = false;

            }
        }

        $('#searchableSelect-1').select2({});
        $('.searchableSelect').select2({});
        categortCountElement = document.getElementById('categortCount');

        function AddField() {
            CategoryFiled = document.getElementById('CategoryFiled');
            categortCount = categortCountElement.value;
            // Create a new product row
            const newProductRow = document.createElement('div');
            newProductRow.classList.add('row', 'form-group', );
            newProductRow.setAttribute("id", `field_${categortCount}`);
            $(`#searchableSelect${categortCount}`).select2({});
            // Your original structure (without the button)
            newProductRow.innerHTML = `
            <div class="col-sm-5 mb-3 mb-sm-0">
                                <label for="searchableSelect${categortCount}" class="">Category (2nd name)</label>
                                <select class="form-select form-select-md" name="category_id[]" onchange="CkeckQuestion(${categortCount})" id="searchableSelect${categortCount}"
                                    placeholder="">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name_auth }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="totalCount${categortCount}" value="">

                            </div>
                            <div class="col-sm-5">
                                <label for="" class="">No of Question</label>
                                <input type="number" class="form-control number-input" name="Cquestion[]"  onchange="CheckValid(${categortCount}),Calculate(${categortCount})" id="noOfQ${categortCount}"
                                    placeholder="Choose question from category">
                                    <span class="text-danger" id="error${categortCount}"></span>

                            </div>
                            <div class="col-sm-2 d-flex align-items-end justify-content-center">
                                <button class="btn btn-danger" type="button" onclick="removeField(${categortCount})"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            `;

            categortCount++;
            categortCountElement.value = categortCount;
            CategoryFiled.appendChild(newProductRow);
            $(`#searchableSelect${categortCount - 1}`).select2();
            var inputElements = document.querySelectorAll(".number-input");
            inputElements.forEach(function(inputElement) {
                applyInputBehavior(inputElement);
            });
        }

        function removeField(fieldId) {
            const CategoryFiled = document.getElementById('CategoryFiled');

            let fieldToRemove = document.getElementById('field_' + fieldId);
            CategoryFiled.removeChild(fieldToRemove);
            categortCount = parseInt(categortCountElement.value);
            categortCountElement.value = categortCount - 1;

        }
    </script>
@endsection

@extends('layouts.app')
@section('title', 'HowTest')
@section('meta')

@endsection
@section('content')
    <div class="row justify-content-center page-header py-5 m-0" style="width: 100%; background-color: #2878EB1A;">
        <div class="col-12">
            <h2 class="page-title text-center">Search Result&nbsp;: &nbsp;{{ $search['title'] ?? '' }} @if (isset($search['author']))
                    <span class="book-auther">({{ $search['author'] ?? '' }})</span>
                @endif

            </h2>
        </div>

    </div>
    {{-- all books --}}
    <div class="container my-4">
        @if ($not_Result == 1)

            @if ($books->count() > 0)
                <p class="page-desc text-center">Books</p>
                <div id="dataBook">
                    <input type="hidden" name="" id="title" value="{{ $search['title'] ?? '' }}">
                    <input type="hidden" name="" id="Keyword" value="{{ $search['Keyword'] ?? '' }}">
                    <input type="hidden" name="" id="author" value="{{ $search['author'] ?? '' }}">
                    <div class="row justify-content-between my-4">
                        <div class="col-md-4 text-center">
                            <span>Showing 1 - {{ $books->count() }} of {{ $BookCount }} result</span>
                            <input type="hidden" name="currentCount" id="currentCountBook" value="{{ $books->count() }}">
                        </div>
                    </div>
                    <div class="row ">
                        @foreach ($books as $book)
                            <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                                <a href="{{ route('books.detail', $book->slug) }}">
                                    <img class="book-img" src="{{ asset('images/' . $book->title_image) }}" alt="">

                                    <div>
                                        <h3 class="book-title truncatedTitle" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="{{ $book->title }}">{{ $book->title }}
                                        </h3>
                                        <h3 class="book-auther">{{ $book->author }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @if ($books->count() >= 12)
                        <div class="row my-4 justify-content-center" id="view_more_book">
                            <div class="col-12  text-center d-flex justify-content-center">
                                <button type="button" id=load_moreBooks class="view-more">View More <span class=""><i
                                            class="fa-solid fa-arrow-right-long fa-sm"></i></span></button>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            @if ($mocks->count() > 0)

                {{-- all mocks --}}
                <p class="page-desc text-center">Mocks</p>
                <div id="dataMock">
                    <input type="hidden" name="" id="titlem" value="{{ $search['title'] ?? '' }}">
                    <input type="hidden" name="" id="Keywordm" value="{{ $search['Keyword'] ?? '' }}">
                    <input type="hidden" name="" id="authorm" value="{{ $search['author'] ?? '' }}">
                    <div class="row justify-content-between my-4">
                        <div class="col-md-4 text-center">
                            <span>Showing 1 - {{ $mocks->count() }} of {{ $MockCount }} result</span>
                            <input type="hidden" name="currentCount" id="currentCountMock" value="{{ $mocks->count() }}">
                        </div>
                    </div>
                    <div class="row ">
                        @foreach ($mocks as $mock)
                            <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                                <a href="{{ route('mocks.detail', $mock->slug) }}">
                                    <img class="book-img" src="{{ asset('images/mock/' . $mock->title_image) }}"
                                        alt="">

                                    <div>
                                        <h3 class="book-title truncatedTitle" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="{{ $mock->title }}">{{ $mock->title }}
                                        </h3>
                                        <h3 class="book-auther">{{ $mock->author }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    @if ($mocks->count() >= 12)
                        <div class="row my-4 justify-content-center" id="view_more_mock">
                            <div class="col-12  text-center">
                                <button type="button" id=load_moreMocks class="view-more">View More <span class=""><i
                                            class="fa-solid fa-arrow-right-long fa-sm"></i></span></button>
                            </div>
                        </div>
                    @endif

                </div>
            @endif
            @if ($books->count() == 0 && $mocks->count() == 0)
                <h4 class="page-title text-center d-flex justify-content-center">Result Not Found</h4>
            @endif
        @else
            <h4 class="page-title text-center d-flex justify-content-center">Result Not Found</h4>
        @endif


    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.truncatedTitle').each(function() {
                var text = $(this).text().trim();
                if (text.length < 25) {
                    var firstWord = text.substring(0, text.indexOf(' '));
                    var remainingWords = text.substring(text.indexOf(' ') + 1);
                    var newText = firstWord + '<br>' + remainingWords;
                    console.log("MY DATA", text);
                    $(this).html(newText);
                } else {
                    var truncatedText = text.substring(0, 35) + '.....';
                    $(this).text(truncatedText);
                }
            });


            $('#load_moreBooks').click(function() {
                let currentCountBook = parseInt($('#currentCountBook').val());
                let title = $('#title').val();
                let Keyword = $('#Keyword').val();
                let author = $('#author').val();
                currentCountBook += 8; // Increase the count by 8
                console.log(currentCountBook);
                let postUrl = '{!! route('search') !!}';
                var dataToSend = {
                    title: title,
                    author: author,
                    Keyword: Keyword,
                    currentCountBook: currentCountBook,
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: postUrl,
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        if (response.books.length < 12) {
                            console.log(response);
                            let view_more_book = document.getElementById('view_more_book');
                            view_more_book.style.display = 'none';
                        }
                        console.log(response);
                        let = pdf = `
                        <input type="hidden" name="" id="title" value="">
                        <input type="hidden" name="" id="Keyword" value="">
                        <input type="hidden" name="" id="author" value="">`;
                        $("#title").val(response.search.title || "");
                        $("#Keyword").val(response.search.Keyword || "");
                        $("#author").val(response.search.author || "");

                        pdf += `<div class="row justify-content-between my-4">

                        <div class="col-md-4 text-center">
                            <span>Showing 1 - ${response.books.length} of ${response.BookCount} result</span>
                            <input type="hidden" name="currentCount" id="currentCount" value="${response.books.length}">
                        </div>
                        </div>
                        <div class="row justify-content-center">`;
                        response.books.forEach(card => {
                            pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center">
                            <a href="/BookDetail/${card.slug}">
                                <img class="book-img" src="/images/${card.title_image}" alt="">

                            <div>
                                <h3 class="book-title">${card.title}</h3>
                                <h3 class="book-auther">${card.author}</h3>
                            </div>
                        </a>
                        </div>`;
                        });
                        pdf += `</div> `;
                        $('#dataBook').empty().append(pdf);

                        // Handle the response here
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });
            $('#load_moreMocks').click(function() {
                let load_moreMocks = parseInt($('#load_moreMocks').val());
                let title = $('#titlem').val();
                let Keyword = $('#Keywordm').val();
                let author = $('#authorm').val();
                currentCountBook += 8; // Increase the count by 8
                console.log(currentCountBook);
                let postUrl = '{!! route('search') !!}';
                var dataToSend = {
                    title: title,
                    author: author,
                    Keyword: Keyword,
                    load_moreMocks: load_moreMocks,
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: postUrl,
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {

                        let = pdf = `
                        <input type="hidden" name="" id="titlem" value="">
                        <input type="hidden" name="" id="Keywordm" value="">
                        <input type="hidden" name="" id="authorm" value="">`;
                        $("#titlem").val(response.search.title || "");
                        $("#Keywordm").val(response.search.Keyword || "");
                        $("#authorm").val(response.search.author || "");

                        pdf += `<div class="row justify-content-between my-4">

                        <div class="col-md-4 text-center">
                            <span>Showing 1 - ${response.mocks.length} of ${response.MockCount} result</span>
                            <input type="hidden" name="currentCount" id="currentCount" value="${response.books.length}">
                        </div>
                        </div>
                        <div class="row justify-content-center">`;
                        response.mocks.forEach(card => {
                            pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center">
                            <a href="MockDetail/${card.slug}">
                                <img class="book-img" src="/images/mock/${card.title_image}" alt="">

                                <div>
                                    <h3 class="book-title">${card.title}</h3>
                                    <h3 class="book-auther">${card.author}</h3>
                                </div>
                            </a>
                        </div>`;
                        });
                        pdf += `</div> `;
                        $('#dataMock').empty().append(pdf);
                        if (response.mocks.length < 12) {
                            console.log(response.mocks.length);
                            let view_more_mock = document.getElementById('view_more_mock');

                            console.log(view_more_mock);
                            view_more_mock.style.display = 'none';
                        }
                        // Handle the response here
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });






        });
        const form = document.getElementById("myForm");

        function submitFoem() {
            form.submit();
        }
    </script>
@endsection

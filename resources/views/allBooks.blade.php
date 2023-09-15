@extends('layouts.app')
@section('title', 'All Books')

@section('content')
    <div class="row justify-content-center page-header py-5 m-0" style="width: 100%; background-color: #2878EB1A
">
        <div class="col-12">
            <h2 class="page-title text-center">All Books</h2>
        </div>
        <div class="col-12">
            <p class="page-desc text-center">1000+ books are published by different authors everyday. </p>
        </div>
    </div>
    <div class="row justify-content-center search-bar mx-auto" id="desktop-search-form">
        <div class="col-9 rounded text-center" style="background-color: #2878EB;">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="row justify-content-around my-3 mx-auto">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <input type="text" class="form-control  bookInfo" name="author" placeholder="Author">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 "><input type="text" class="form-control  bookInfo"
                            name="title" placeholder="Title">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 "><input type="text" class="form-control  bookInfo"
                            name="Keyword" placeholder="Keywords"></div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <button type="submit" id="searcs_button" class="searchBtn ">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center search-bar mx-auto py-2 book-search-form mobileSearchForm" id="mobile-search">
        <div class="col-sm-12">
            <form id="search_formM" action="{{ route('search') }}" method="POST">
                @csrf<input id="search-inputM" name="title" class="form-control shadow-none" type="text"
                    placeholder="Search...">
                <button type="button" id="search-iconn" class="rounded-circle me-1">
                    <i class="fa-solid fa-magnifying-glass" style="color: #fff"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="container my-4">

        <div id="data">

        </div>

        <div class="row my-4" id="view_more" style="display: block;">
            <div class="col-12 justify-content-center text-center">
                <button type="button" id=load_more class="btnAllBook btn-height">View More <span class=""><i
                            class="fa-solid fa-arrow-right-long fa-sm"></i></span></button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // get books
            let urlGet = "/ajexBooks";
            $.ajax({
                type: 'GET',
                url: urlGet,
                dataType: 'json',
                success: function(response) {
                    // window.onload = function() {
                    // console.log(response.books.length);
                    if (response.books.length < 12) {
                        const view_more = document.getElementById('view_more');
                        view_more.style.display = 'none';
                    } else {
                        const view_more = document.getElementById('view_more');
                        view_more.style.display = 'block';
                    }
                    // }
                    let = pdf = ` <div class="row justify-content-between my-4">
                <div class="col-md-6 text-center">
                    <select name="sort_by" class="form-select" style="width:200px" id="sort_by" >
                        <option value="">Sort by</option>
                        <option  value="A-Z">Alphabetically,
                            A-Z</option>
                        <option   value="Z-A">Alphabetically,
                            Z-A</option>
                    </select>
                </div>
                <div class="col-md-4 text-center">
                    <span>Showing 1 - ${response.books.length} of ${response.count} result</span>
                    <input type="hidden" name="currentCount" id="currentCount" value="${response.books.length}">
                </div>
            </div>
            <div class="row justify-content-center gx-5">`;
                    response.books.forEach(card => {
                        let truncatedTitle = card.title.length < 25 ?
                            card.title.substring(0, card.title.indexOf(' ')) + '<br>' + card
                            .title
                            .substring(card.title.indexOf(' ') + 1) :
                            card.title.substring(0, 30) + '...';


                        pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center p-4">
                <a href="/BookDetail/${card.slug}">
                    <img class="book-img mb-3" src="/images/${card.title_image}" alt="${card.title}">

                    <div>
                        <h3 class="book-title" data-bs-toggle="tooltip" data-bs-placement="bottom" title="${card.title}">${truncatedTitle}</h3>
                        <h3 class="book-auther">${card.author}</h3>
                    </div>
                </a>
            </div>`;
                    });
                    pdf += `</div> `;

                    $('#data').append(pdf);

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });



            $(document).on('change', '#sort_by', function() {
                let currentCount = parseInt($('#currentCount').val());
                showData(currentCount, $(this).val()); // Pass selectedValue as an argument
            });

            $('#load_more').click(function() {
                let currentCount = parseInt($('#currentCount').val());
                currentCount += 8; // Increase the count by 8

                showData(currentCount, $('#sort_by').val()); // Pass selectedValue as an argument
            });

            function showData(currentCount, selectedValue) { // Accept selectedValue as an argument

                let postUrl = "/ajexBooks";
                var dataToSend = {
                    sort_by: selectedValue,
                    currentCount: currentCount,
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: postUrl,
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        if (response.books.length == response.count) {
                            const view_more = document.getElementById('view_more');
                            view_more.style.display = 'none';
                        }
                        let = pdf = ` <div class="row gx-1 justify-content-between my-4">
                        <div class="col-md-4 text-center">
                            <select name="sort_by" class="form-select" style="width:200px" id="sort_by" >
                                <option value="">Sort by</option>
                                <option  value="A-Z">Alphabetically,
                                    A-Z</option>
                                <option   value="Z-A">Alphabetically,
                                    Z-A</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-center">
                            <span>Showing 1 - ${response.books.length} of ${response.count} result</span>
                            <input type="hidden" name="currentCount" id="currentCount" value="${response.books.length}">
                        </div>
                    </div>
                    <div class="row justify-content-center">`;
                        response.books.forEach(card => {
                            let truncatedTitle = card.title.length < 25 ?
                                card.title.substring(0, card.title.indexOf(' ')) + '<br>' + card
                                .title
                                .substring(card.title.indexOf(' ') + 1) :
                                card.title.substring(0, 30) + '...';
                            pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <a href="/BookDetail/${card.slug}">
                            <img class="book-img mb-3" src="/images/${card.title_image}" alt="">

                            <div>
                                <h3 class="book-title">${truncatedTitle}</h3>
                                <h3 class="book-auther">${card.author}</h3>
                            </div>
                        </a>
                    </div>`;
                        });
                        pdf += `</div> `;
                        $('#data').empty().append(pdf);

                        // Handle the response here
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            $(window).resize(function() {
                if (window.innerWidth < 1340) {
                    $('.').addClass('backup-btn-group').removeClass('btn-group');
                } else {
                    $('.backup-btn-group').addClass('btn-group').removeClass('backup-btn-group');
                }
            });
        });
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
        const form = document.getElementById("myForm");

        function submitFoem() {
            form.submit();
        }
    </script>
@endsection

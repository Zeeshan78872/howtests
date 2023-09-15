@extends('layouts.app')
@section('title', 'HowTest')
@section('meta')

@endsection
@section('content')
    <style>
        .row {
            width: 100%;
        }

        a.btn.btn-outline-detail.bordered {
            border-color: #212529;
        }
    </style>
    <img src="{{ asset('images/site/finalhero.png') }}" class="img-fluid d-block w-100" alt="Slide 1">

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
    <div class="row justify-content-center search-bar mx-auto py-2 mobileSearchForm mt-0" id="mobile-search-form">
        <div class="col-sm-12">
            <form id="search_formM" action="{{ route('search') }}" method="POST">
                @csrf<input id="search-inputM" name="title" class="form-control shadow-none" type="text"
                    placeholder="Search...">
                <button type="button" id="search-iconn" class="rounded-circle me-1">
                    <i class="fa-solid fa-magnifying-glass" s: #fff;"></i>
                </button>
            </form>
        </div>
    </div>
    <div>
        <div class="row justify-content-center py-md-5 mx-auto mt-3">
            <div class="col-12">
                <h2 class="page-title text-center mt-md-5">Top Downloads Books</h2>
            </div>
            <div class="col-12">
                <p class="page-desc text-center mb-2">1000+ books are published by different authors everyday. </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center ">
                <a href="{{ route('books.all') }}" class="top-download_view text-center mb-0">View All Books </a>
            </div>
        </div>

        {{-- top downloaders --}}
        <div class="mb-1">
            <div id="carouselExample1" class="carousel slide pb-5" data-bs-ride="carousel">
                <div id="carousel-indicators" class="carousel-indicators d-flex justify-content-center mb-0">

                </div>
                <div class="carousel-inner" id="carousel-inner">


                </div>
                <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>

    <div>
        <div class="row justify-content-center py-5 mx-auto">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center ">
                <h2 class="page-title text-center">Top Downloads Mocks</h2>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center ">
                <p class="page-desc text-center">1000+ mocks are published by different authors everyday. </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 text-center ">
                <a href="{{ route('mocks.all') }}" class="top-download_view text-center">View All Mocks </a>
            </div>
        </div>

        {{-- top downloaders --}}
        <div class="mb-4">
            <div id="carouselExamplemock" class="carousel slide" data-bs-ride="carousel">
                <div id="carousel-indicators_mock" class="carousel-indicators d-flex justify-content-center mb-0">

                </div>
                <div class="carousel-inner" id="carousel-inner_mock">


                </div>
                <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon d-none" aria-hidden="true"></span>
                    <span class="visually-hidden">hello Previous</span>
                </button>
                <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon d-none" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>




    {{-- featured --}}
    <div class="mb-5 py-5 mt-5 featuredBooks"
        style="background: linear-gradient(78.43deg, #FBEEEE -27.34%, #F7FFFE 89.92%);">
        <div id="carouselExampleFeatured" class="carousel slide featureBtnHandling" data-bs-ride="carousel">
            <div id="carousel-indicators"
                class="carousel-indicators d-md-flex justify-content-center mb-0 featureSliders">
                @foreach ($books as $index => $book)
                    <button type="button" data-bs-target="#carouselExampleFeatured"
                        data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                        aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach

            </div>
            <div class="carousel-inner">
                @foreach ($books as $index => $book)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="container">
                            <div class="row py-md-5 gx-5 justify-content-center mx-auto featureBookSection">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-bookDetail ">
                                        <img class="card-img-top featureBookImage img-fluid"
                                            src="{{ asset('images/' . $book->title_image) }}" alt="Title">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 px-5 pt-3">
                                    <div class="row">
                                        <div class="col-sm-12 featureCenter text-sm-end">
                                            <h2 class="Book_titkeD mb-5">Featured Book</h2>
                                            <h2 class="bookBorder mb-4"></h2>
                                            <h2 class="detailAuthor mb-4">By {{ $book->author }}</h2>
                                            <h2 class="Book_titkeD ">{{ $book->title }}</h2>

                                        </div>
                                    </div>
                                    {{-- <h3 class="subtag">Birds gonna be happy</h3> --}}
                                    <p class="bookParagraph">{{ $book->desc }}</p>
                                    <div class="row  featureViewParent">
                                        <div class="col-12 justify-content-cente featureViewMore">
                                            <a href="{{ route('books.detail', $book->slug) }}"><button
                                                    class="view-more mb-5">View
                                                    More
                                                    <span class=""><i
                                                            class="fa-solid fa-arrow-right-long fa-sm mx-2"></i></span></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev featureBookControls" type="button"
                data-bs-target="#carouselExampleFeatured" data-bs-slide="prev">
                <span class="carousel-icon" aria-hidden="true"><i class="fa-solid fa-arrow-left"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next featureBookControls" type="button"
                data-bs-target="#carouselExampleFeatured" data-bs-slide="next">
                <span class="carousel-icon" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
    {{-- populer books --}}
    <div>
        <div class="row justify-content-center py-5 mt-4 mx-auto">
            <div class="col-12">
                <h2 class="page-title text-center">Most Popular Books</h2>
            </div>
            <div class="col-12">
                <p class="page-desc text-center">1000+ books are published by different authors everyday. </p>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mx-auto gx-5">
                @foreach ($Populers as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 text-center mb-3 ">
                        <a href="{{ route('books.detail', $book->slug) }}">
                            <img style="width: 210px;" class="book-img"
                                src="{{ asset('images/' . $book->title_image) }}" alt="">

                            <div>
                                <h3 class="book-title mt-3 truncatedTitle px-2" id="book-title" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="{{ $book->title }}">{{ $book->title }}</h3>
                                <h3 class="book-auther">{{ $book->author }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row my-4 py-5 mx-auto">
            <div class="col-12 justify-content-center text-center">
                <a href="{{ route('books.all') }}"><button class="view-more-book mx-auto btn-height ">View More <span
                            class=""><i class="fa-solid fa-arrow-right-long fa-sm mx-2"></i></span></button></a>
            </div>
        </div>
    </div>
    {{-- populer mocks --}}
    <div>
        <div class="row justify-content-center py-5 mt-4 mx-auto">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="page-title text-center">Most Popular Mocks</h2>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p class="page-desc text-center">1000+ mocks are published by different authors everyday. </p>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center mx-auto gx-5">
                @foreach ($PopulersMocks as $mock)
                    <div class="col-lg-3 col-md-4 col-sm-6 text-center mb-3 "><a
                            href="{{ route('mocks.detail', $mock->slug) }}"><img style="width: 210px;" class="book-img"
                                src="{{ asset('images/mock/' . $mock->title_image) }}" alt="">

                            <div>
                                <h3 class="book-title mt-3 truncatedTitle" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="{{ $mock->title }}">{{ $mock->title }}</h3>
                                <h3 class="book-auther">{{ $mock->author }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row my-4 py-5 mx-auto">
            <div class="col-12 justify-content-center text-center">
                <a href="{{ route('mocks.all') }}"><button class="view-more-book mx-auto btn-height">View More <span
                            class=""><i class="fa-solid fa-arrow-right-long fa-sm mx-2"></i></span></button> </a>
            </div>
        </div>
    </div>

    {{-- stay with us --}}
    <div class="subscribe-container">
        <div class="background-image">
            <img src="{{ asset('images/site/staywithus.png') }}" alt="Subscribe" class="img-fluid"
                id="hide-mobile-device" />
            <div>
                <img src="{{ asset('images/site/staywithus1.jpeg') }}" alt="Subscribe" class="img-fluid"
                    style="height: 200px" />
                <img src="{{ asset('images/site/staywithus2.jpeg') }}" alt="Subscribe" class="img-fluid"
                    style="height: 200px" />
            </div>
        </div>
        <div class="content-container text-center">
            <div class="content">
                <h2>Stay With Us</h2>
                <p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and
                    exclusive
                    offers.</p>
            </div>
            <div class="subscribeForm">
                <input type="email" name="subscribe" id="subscribe" class="subscribe-email" />
                <button type="button" onclick="AddSubscribe()" id="subscribeButon"
                    class="subscribe-button">Subscribe</button>
            </div>
            <div id="errorSubscribe" class="text-danger text-start">

            </div>
        </div>
    </div>
    {{-- subscribe successful --}}
    <div class="modal fade" id="modalSubdmodel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content" id="downloadModal">
                <div class="text-end py-2">
                    <button type="button" class="modalCloseBtn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>

                @csrf
                <div class="modal-body">
                    <div class="text-center py-4 mt-3">
                        <h2 class="" id="modalTitleId">Successfully Subscribed
                        </h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // Handle the response here

        const inputField = document.getElementById("subscribe");
        const button = document.getElementById("subscribeButon");

        // Add a focus event listener to make the font bold when in focus
        inputField.addEventListener("focus", function() {
            button.style.fontWeight = "bold";
        });

        // Add a blur event listener to reset the font weight when not in focus
        inputField.addEventListener("blur", function() {
            button.style.fontWeight = "normal";
        });


        jQuery(document).ready(function($) {
            var maxLength = 300;
            $('.bookParagraph').each(function() {
                var text = $(this).text();
                if (text.length > maxLength) {
                    var truncatedText = text.substring(0, maxLength) + '.....';
                    $(this).text(truncatedText);
                }
            })



            let url = '{{ route('topDownloaders') }}';
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    const carouselInner = document.getElementById('carousel-inner');
                    const carouselIndicators = document.getElementById('carousel-indicators');
                    const handleResponsiveCarousel = () => {
                        const screenWidth = window.innerWidth;
                        const itemsPerSlide = screenWidth < 768 ? 1 :
                            screenWidth < 992 ? 2 :
                            4; // 1 card on mobile, 4 cards on larger screens
                        const totalSlides = Math.ceil(response.length / itemsPerSlide);

                        carouselInner.innerHTML = '';
                        carouselIndicators.innerHTML = '';

                        for (let slide = 0; slide < totalSlides; slide++) {
                            //
                            const indicatorButton = document.createElement('button');
                            indicatorButton.type = 'button';
                            indicatorButton.setAttribute('data-bs-target', '#carouselExample1');
                            indicatorButton.setAttribute('data-bs-slide-to', slide.toString());
                            indicatorButton.className = slide === 0 ? 'active' : '';
                            indicatorButton.setAttribute('aria-current', slide === 0 ? 'true' :
                                'false');
                            indicatorButton.setAttribute('aria-label', `Slide ${slide + 1}`);
                            //
                            const slideStartIndex = slide * itemsPerSlide;
                            const slideEndIndex = slideStartIndex + itemsPerSlide;
                            const slideCards = response.slice(slideStartIndex, slideEndIndex);
                            const carouselItem = document.createElement('div');
                            carouselItem.className = `carousel-item ${slide === 0 ? 'active' : ''}`;
                            const container = document.createElement('div');
                            container.className = 'container my-4';
                            const row = document.createElement('div');
                            row.className = 'row justify-content-center m-0';


                            slideCards.forEach(card => {
                                const lineBreak = document.createElement("br");
                                let truncatedTitle = card.title.length < 25 ?
                                    card.title.substring(0, card.title.indexOf(' ')) + card
                                    .title.substring(card.title.indexOf(' ') + 1) :
                                    card.title.substring(0, 30) + '.....';

                                const col = document.createElement('div');
                                col.className = 'col-lg-3 col-md-6 col-sm-12 text-center';

                                const cardLink = document.createElement('a');
                                cardLink.href = '/BookDetail/' + card.slug;

                                const cardImage = document.createElement('img');
                                cardImage.className = 'book-img';
                                cardImage.src =
                                    `{{ asset('images/${card.title_image}') }}`;
                                cardImage.alt = card.title;

                                cardLink.appendChild(cardImage);
                                col.appendChild(cardLink);

                                const cardInfo = document.createElement('div');
                                const cardTitleLink = document.createElement('a');
                                cardTitleLink.href = '/BookDetail/' + card.slug;
                                const cardTitle = document.createElement('h3');
                                cardTitle.classList.add('book-title', 'title-text', 'mt-3',
                                    'truncatedTitle');

                                // Create the title text nodes and append the line break element
                                if (card.title.length < 25) {
                                    const firstPart = card.title.substring(0, card.title
                                        .indexOf(' '));
                                    const secondPart = card.title.substring(card.title
                                        .indexOf(
                                            ' ') + 1);


                                    cardTitle.appendChild(document.createTextNode(
                                        firstPart));
                                    cardTitle.appendChild(lineBreak.cloneNode());
                                    cardTitle.appendChild(document.createTextNode(
                                        secondPart));
                                } else {
                                    cardTitle.textContent = truncatedTitle;
                                }

                                cardTitle.setAttribute('data-bs-toggle', 'tooltip');
                                cardTitle.setAttribute('data-placement', 'top');
                                cardTitle.setAttribute('title', card.title);

                                const cardAuthor = document.createElement('h3');
                                cardAuthor.className = 'book-author';
                                cardAuthor.textContent = card.author;
                                cardTitleLink.appendChild(cardTitle);
                                cardInfo.appendChild(cardTitleLink);
                                cardInfo.appendChild(cardAuthor);

                                col.appendChild(cardInfo);
                                row.appendChild(col);
                            });
                            // Append the populated row to your container
                            container.appendChild(row);
                            carouselItem.appendChild(container);
                            carouselInner.appendChild(carouselItem);
                            carouselIndicators.appendChild(indicatorButton);
                        }
                    };

                    // Call the function initially and on window resize
                    handleResponsiveCarousel();
                    window.addEventListener('resize', handleResponsiveCarousel);
                },
                error: function(xhr, status, error) {
                    // console.error(error);
                }
            });
            let urlmock = '{{ route('topDownloaders.mock') }}';
            $.ajax({
                type: 'GET',
                url: urlmock,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    const carouselInner = document.getElementById('carousel-inner_mock');
                    const carouselIndicators = document.getElementById('carousel-indicators_mock');
                    const handleResponsiveCarousel = () => {
                        const screenWidth = window.innerWidth;
                        const itemsPerSlide = screenWidth < 768 ? 1 :
                            screenWidth < 992 ? 2 :
                            4; // 1 card on mobile, 4 cards on larger screens
                        const totalSlides = Math.ceil(response.length / itemsPerSlide);

                        carouselInner.innerHTML = '';
                        carouselIndicators.innerHTML = '';

                        for (let slide = 0; slide < totalSlides; slide++) {
                            //
                            const indicatorButton = document.createElement('button');
                            indicatorButton.type = 'button';
                            indicatorButton.setAttribute('data-bs-target', '#carouselExamplemock');
                            indicatorButton.setAttribute('data-bs-slide-to', slide.toString());
                            indicatorButton.className = slide === 0 ? 'active' : '';
                            indicatorButton.setAttribute('aria-current', slide === 0 ? 'true' :
                                'false');
                            indicatorButton.setAttribute('aria-label', `Slide ${slide + 1}`);
                            //
                            const slideStartIndex = slide * itemsPerSlide;
                            const slideEndIndex = slideStartIndex + itemsPerSlide;
                            const slideCards = response.slice(slideStartIndex, slideEndIndex);
                            const carouselItem = document.createElement('div');
                            carouselItem.className = `carousel-item ${slide === 0 ? 'active' : ''}`;
                            const container = document.createElement('div');
                            container.className = 'container my-4';
                            const row = document.createElement('div');
                            row.className = 'row justify-content-center m-0';

                            slideCards.forEach(card => {
                                const lineBreak = document.createElement("br");
                                let truncatedTitle = card.title.length < 25 ?
                                    card.title.substring(0, card.title.indexOf(' ')) + card
                                    .title.substring(card.title.indexOf(' ') + 1) :
                                    card.title.substring(0, 35) + '.....';

                                const col = document.createElement('div');
                                col.className = 'col-lg-3 col-md-6 col-sm-12 text-center ';

                                const cardLink = document.createElement('a');
                                cardLink.href = '/MockDetail/' + card.slug;

                                const cardImage = document.createElement('img');
                                cardImage.className = 'book-img';
                                cardImage.src =
                                    `{{ asset('images/mock/${card.title_image}') }}`;
                                cardImage.alt = '';

                                cardLink.appendChild(cardImage);
                                col.appendChild(cardLink);

                                const cardInfo = document.createElement('div');
                                const cardTitleLink = document.createElement('a');
                                cardTitleLink.href = '/BookDetail/' + card.slug;
                                const cardTitle = document.createElement('h3');
                                cardTitle.classList.add('book-title', 'mt-3');

                                // Create the title text nodes and append the line break element
                                if (card.title.length < 25) {
                                    const firstPart = card.title.substring(0, card.title
                                        .indexOf(' '));
                                    const secondPart = card.title.substring(card.title
                                        .indexOf(
                                            ' ') + 1);

                                    cardTitle.appendChild(document.createTextNode(
                                        firstPart));
                                    cardTitle.appendChild(lineBreak.cloneNode());
                                    cardTitle.appendChild(document.createTextNode(
                                        secondPart));
                                } else {
                                    cardTitle.textContent = truncatedTitle;
                                }

                                cardTitle.setAttribute('data-bs-toggle', 'tooltip');
                                cardTitle.setAttribute('data-placement', 'bottom');
                                cardTitle.setAttribute('title', card.title);

                                const cardAuthor = document.createElement('h3');
                                cardAuthor.className = 'book-author';
                                cardAuthor.textContent = card.author;
                                cardTitleLink.appendChild(cardTitle)
                                cardInfo.appendChild(cardTitleLink);
                                cardInfo.appendChild(cardAuthor);

                                col.appendChild(cardInfo);
                                row.appendChild(col);
                                container.appendChild(row);
                            });

                            carouselItem.appendChild(container);
                            carouselInner.appendChild(carouselItem);
                            carouselIndicators.appendChild(indicatorButton);

                        }
                    };

                    // Call the function initially and on window resize
                    handleResponsiveCarousel();
                    window.addEventListener('resize', handleResponsiveCarousel);
                },
                error: function(xhr, status, error) {
                    // console.error(error);
                }
            });
            $('.truncatedTitle').each(function() {
                var text = $(this).text().trim();
                if (text.length < 25) {
                    var firstWord = text.substring(0, text.indexOf(' '));
                    var remainingWords = text.substring(text.indexOf(' ') + 1);
                    var newText = firstWord + '<br>' + remainingWords;
                    // console.log("MY DATA", text);
                    $(this).html(newText);
                } else {
                    var truncatedText = text.substring(0, 25) + '.....';
                    $(this).text(truncatedText);
                }
            });
        });

        function AddSubscribe() {
            let postUrl = '{!! route('AddSubscribe') !!}';
            let email = document.getElementById('subscribe').value;
            if (email.trim() == '') {
                document.getElementById('errorSubscribe').innerHTML = 'email ie required';
            } else if (isValidEmail(email)) {
                var dataToSend = {
                    email: email,
                    _token: '{{ csrf_token() }}'
                };
                $.ajax({
                    url: postUrl,
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        document.getElementById('subscribe').value = '';
                        // document.getElementById("modalSubdmodel").style.display = "block"; // For Bootstrap 4.x
                        // or
                        $("#modalSubdmodel").modal("show");
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });
            } else {
                // console.log("Invalid email format");
                document.getElementById('errorSubscribe').innerHTML = 'Invalid email format';

            }

        }

        function isValidEmail(email) {
            // Regular expression for email validation
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            return emailRegex.test(email);
        }
    </script>



    <!-- Include Bootstrap JavaScript and CSS dependencies -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
@endsection

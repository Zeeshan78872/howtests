@extends('layouts.app')
@section('meta_title', $books->meta_title)
@section('title', $books->title)
@section('meta_desc', $books->meta_description)
@section('meta_keyword', $books->meta_Keywords)

@section('content')
    <div class="page-header" style="background-color: #2878EB1A">
        <div class="container">
            <div class="row py-5 px-3">
                <div class="col-12">
                    <h2 class="page-title">{{ $books->title }}</h2>
                </div>
                <div class="col-12">
                    <p class="page-desc" style="text-align: start;">{{ $books->tagline }} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">


        @if (session('success'))
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
                var id = {{ $books->id ?? 'null' }};
                $.ajax({
                    url: "{{ route('generatePDF', ['id' => $books->id, 'db' => session('db')]) }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Process the response data here
                        // console.log(data);
                    },
                    error: function(error) {
                        // Handle errors here
                        console.log('Error:', error);
                    }
                });
            </script>
        @endif
        <div class="row py-4 mx-auto">
            <div class="col-md-5">
                <div class="card card-bookDetail ">
                    <img class="card-img-top" src="{{ asset('images/' . $books->title_image) }}" alt="{{ $books->title }}">
                </div>
            </div>
            <div class="col-md-7">
                <div class="row" id="bookShare">
                    <div class="col-7">
                        <h2 class="Book_titkeD">Book Title</h2>
                        <h2 class="bookBorder"></h2>
                        <h2 class="detailAuthor">By {{ $books->author }}</h2>

                    </div>
                    <div class="col-4 d-flex justify-content-end">
                        <div class="row" style="margin-right: 10px;">
                            <div class="col-6">

                                {{-- {!! $shareComponent !!} --}}
                                <!-- Button trigger modal -->
                                <a type="button" class="text-black" id="sendRequestBtn">
                                    <span><i class="fa-solid fa-share-nodes"></i><br>Share<br>
                                        {{ $books->shares }} </span>
                                </a>


                                <!-- Modal (Question with Answer) -->
                                <div class="modal fade" id="modalShare" tabindex="-1" data-bs-backdrop="static"
                                    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document">
                                        <div class="modal-content" style="height: 350px !important;">
                                            <!-- <div class="modal-header"> -->
                                            <div class="text-end py-2">
                                                <button type="button" class="modalCloseBtn" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>

                                            <!-- </div> -->

                                            <div class="modal-body mt-5">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-center">Share to social media </h5>
                                                    </div>
                                                    <div class="col-12 mt-5">{!! $shareComponent !!}</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-6"><span><i class="fa-solid fa-signal"></i><br>Downloads<br>
                                    {{ $books->downloads }}</span></div>
                        </div>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12">
                        <h3 class="singleTitle">{{ $books->title }}</h3>
                    </div>
                </div>
                {{-- <h3 class="subtag">Birds gonna be happy</h3> --}}
                <p class="bookParagraph">{{ $books->desc }}</p>
                <div class="row my-4">
                    <div class="detailAuthor col-lg-5 col-md-5 ">Published At: {{ $books->created_at->format('Y-m-d') }}
                    </div>
                    <div class="detailAuthor col-lg-4 col-md-4 ">Author : {{ $books->author }}</div>
                    <div class="detailAuthor col-lg-3 col-md-3 ">Page Count: {{ $books->page_count }} </div>

                </div>
                <div class="dropdown">
                    <button class="btnDropdown dropdown-toggle btn-height"type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Download <span class="ms-2"><i class="fa-solid fa-arrow-down"></i></span>
                    </button>
                    <ul class="dropdown-menu shadow" id="downloadDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalAddDetail1">Download Questions without Answers
                            </a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalAddDetail2">Download Questions with Answers</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#modalSecondmodel"> Download with Explanation</a></li>
                    </ul>
                </div>
                @component('components.download-model-for-explanation')
                @endcomponent
                @component('components.user-detail-model', [
                    'ModelID' => 'modalAddDetail1',
                    'DownloadBy' => 'Q',
                    'id' => $books->id,
                ])
                @endcomponent
                @component('components.user-detail-model', [
                    'ModelID' => 'modalAddDetail2',
                    'DownloadBy' => 'QWA',
                    'id' => $books->id,
                ])
                @endcomponent
                @component('components.user-detail-model', [
                    'ModelID' => 'modalAddDetail3',
                    'DownloadBy' => 'AWE',
                    'id' => $books->id,
                ])
                @endcomponent
            </div>
        </div>


    </div>
    <div class="" style=" background-color: #2878EB1A;">
        <div class="row pt-5 pb-3 mt-4 w-100 mx-auto">
            <div class="col-12">
                <h2 class="page-title text-center">Top Downloads</h2>
            </div>
            <div class="col-12">
                <p class="page-desc text-center mb-3">1000+ books are published by different authors everyday. </p>
            </div>
            <div class="col-12">
                <a href="{{ route('books.all') }}">
                    <p class="top-download_view text-center">View All Books </p>
                </a>
            </div>
        </div>

        {{-- top downloaders --}}
        <div class="pt-3 pb-5">
            <div id="carouselExample1" class="carousel slide" data-bs-ride="carousel">
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
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sendRequestBtn").click(function() {
                var url = "{{ route('books.countShare', $books->id) }}";
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $("#modalShare").modal('show');
                    },
                    error: function(error) {
                        // Handle errors if needed
                        console.error(error);
                    }
                });
            });

            $('#popover-trigger').popover({
                content: function() {
                    return $('#popover-content').html();
                }
            });

            var db = "{{ session('download_db') }}";
            if (db) {
                var filePath = '';
                const title = '{{ $books->title }}';
                if (db === 'Q') {
                    filePath = "/pdf/Question/{{ $books->title }}{{ $books->id }}.pdf";
                    let title = '{{ $books->title }}{{ $books->id }}.pdf';
                } else if (db === 'QWA') {
                    filePath = "/pdf/QuestionWA/{{ $books->title }}_answer_{{ $books->id }}.pdf";
                    let title = '{{ $books->title }}_answer_{{ $books->id }}.pdf';
                }
                var downloadLink = document.createElement('a');
                downloadLink.href = filePath;
                downloadLink.download = title;
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
                window.history.replaceState({}, document.title, window.location.pathname);
            }

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
                        const itemsPerSlide = screenWidth < 768 ? 1 : 4;
                        const totalSlides = Math.ceil(response.length / itemsPerSlide);
                        carouselInner.innerHTML = '';
                        carouselIndicators.innerHTML = '';
                        for (let slide = 0; slide < totalSlides; slide++) {
                            const indicatorButton = document.createElement('button');
                            indicatorButton.type = 'button';
                            indicatorButton.setAttribute('data-bs-target', '#carouselExample1');
                            indicatorButton.setAttribute('data-bs-slide-to', slide.toString());
                            indicatorButton.className = slide === 0 ? 'active' : '';
                            indicatorButton.setAttribute('aria-current', slide === 0 ? 'true' :
                                'false');
                            indicatorButton.setAttribute('aria-label', `Slide ${slide + 1}`);
                            const slideStartIndex = slide * itemsPerSlide;
                            const slideEndIndex = slideStartIndex + itemsPerSlide;
                            const slideCards = response.slice(slideStartIndex, slideEndIndex);
                            const carouselItem = document.createElement('div');
                            carouselItem.className = `carousel-item ${slide === 0 ? 'active' : ''}`;
                            const container = document.createElement('div');
                            container.className = 'container my-4';
                            const row = document.createElement('div');
                            row.className = 'row justify-content-center';
                            slideCards.forEach(card => {
                                const lineBreak = document.createElement("br");
                                let truncatedTitle = card.title.length < 25 ? card.title
                                    .substring(0,
                                        card.title.indexOf(' ')) + card
                                    .title.substring(card.title.indexOf(' ') + 1) :
                                    card.title.substring(0, 35) + '...';
                                const col = document.createElement('div');
                                col.className = 'col-lg-3 col-md-4 col-sm-6 text-center';
                                const cardLink = document.createElement('a');
                                cardLink.href = '/BookDetail/' + card.slug;
                                const cardImage = document.createElement('img');
                                cardImage.className = 'book-img';
                                cardImage.src =
                                    `{{ asset('images/${card.title_image}') }}`;
                                cardImage.alt = '';
                                cardLink.appendChild(cardImage);
                                col.appendChild(cardLink);
                                const cardInfo = document.createElement('div');
                                const cardTitleLink = document.createElement('a');
                                cardTitleLink.href = '/BookDetail/' + card.slug;
                                const cardTitle = document.createElement('h3');
                                cardTitle.classList.add('book-title', 'truncated-title');
                                if (card.title.length < 25) {
                                    const firstPart = card.title.substring(0, card.title
                                        .indexOf(' '));
                                    const secondPart = card.title.substring(card.title
                                        .indexOf(' ') + 1);
                                    cardTitle.appendChild(document.createTextNode(
                                        firstPart));
                                    cardTitle.appendChild(lineBreak.cloneNode());
                                    cardTitle.appendChild(document.createTextNode(
                                        secondPart));
                                } else {
                                    cardTitle.textContent = truncatedTitle;
                                }
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
                    handleResponsiveCarousel();
                    window.addEventListener('resize', handleResponsiveCarousel);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

@endsection

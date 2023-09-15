@extends('layouts.app')
@section('meta_title', $mocks->meta_title)
@section('title', $mocks->title)
@section('meta_desc', $mocks->meta_description)
@section('meta_keyword', $mocks->meta_Keywords)
@section('content')
    <div class="page-header" style="background-color: #2878EB1A;">
        <div class="container">
            <div class="row justify-content-center  py-5 px-3">
                <div class="col-12">
                    <h2 class="page-title">{{ $mocks->title }}</h2>
                </div>
                <div class="col-12">
                    <p class="page-desc" style="text-align: start;">{{ $mocks->tagline }} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if (session('success'))
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
                var id = {{ $mocks->id ?? 'null' }};
                $.ajax({
                    url: "{{ route('generatePDF', ['id' => $mocks->id, 'db' => session('db')]) }}",
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
                    <img class="card-img-top" src="{{ asset('images/mock/' . $mocks->title_image) }}"
                        alt="{{ $mocks->title }}">
                </div>
            </div>
            <div class="col-md-7">
                <div class="row gx-1">
                    <div class="col-6">
                        <h2 class="Book_titkeD">Mock Title</h2>
                        <h2 class="bookBorder"></h2>
                        <h2 class="detailAuthor">By {{ $mocks->author }}</h2>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <div class="row gx-1 mx-auto">
                            <div class="col-6">

                                <a type="button" class="text-black" id="sendRequestBtn">
                                    <span><i class="fa-solid fa-share-nodes"></i><br>Share<br>
                                        {{ $mocks->shares }} </span>
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
                                    {{ $mocks->downloads }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="singleTitle">{{ $mocks->title }}</h2>
                    </div>
                </div>
                {{-- <h3 class="subtag">Birds gonna be happy</h3> --}}
                <p class="bookParagraph">{{ $mocks->desc }}</p>
                <div class="row my-4">
                    <div class="detailAuthor col-lg-5 col-md-5 ">Published At: {{ $mocks->created_at->format('Y-m-d') }}
                    </div>
                    <div class="detailAuthor col-lg-4 col-md-4 ">Author : {{ $mocks->author }}</div>
                    <div class="detailAuthor col-lg-3 col-md-3 ">Page Count:{{ $mocks->page_count }} </div>

                </div>
                <div class="dropdown">
                    <button class="btnDropdown dropdown-toggle btn-height" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Download <span class="ms-2"><i class="fa-solid fa-arrow-down"></i></span>
                    </button>
                    <ul class="dropdown-menu shadow">
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

                @component('components.user-detail-model-mock', [
                    'ModelID' => 'modalAddDetail1',
                    'DownloadBy' => 'Q',
                    'id' => $mocks->id,
                ])
                @endcomponent
                @component('components.user-detail-model-mock', [
                    'ModelID' => 'modalAddDetail2',
                    'DownloadBy' => 'QWA',
                    'id' => $mocks->id,
                ])
                @endcomponent
                @component('components.user-detail-model-mock', [
                    'ModelID' => 'modalAddDetail3',
                    'DownloadBy' => 'AWE',
                    'id' => $mocks->id,
                ])
                @endcomponent
            </div>
        </div>
    </div>
    <div style="background-color: #2878EB1A" class="py-5">
        <div class="row justify-content-center pt-3 mt-4 w-100 mx-auto">
            <div class="col-12">
                <h2 class="page-title text-center">Top Downloads</h2>
            </div>
            <div class="col-12">
                <p class="page-desc text-center mb-3">1000+ mocks are published by different authors everyday. </p>
            </div>
            <div class="col-12">
                <a href="{{ route('mocks.all') }}">
                    <p class="top-download_view text-center">View All Mocks </p>
                </a>
            </div>
        </div>

        {{-- top downloaders --}}
        <div>
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
                var url = "{{ route('mocks.countShare', $mocks->id) }}";
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

            var db = "{{ session('download_db') }}";

            if (db) {
                var filePath = '';

                // Define the file path based on the download type
                if (db === 'Q') {
                    filePath = "/pdfMock/Question/{{ $mocks->title }}{{ $mocks->id }}.pdf";
                    let title = '{{ $mocks->title }}{{ $mocks->id }}.pdf';
                } else if (db === 'QWA') {
                    filePath = "/pdfMock/QuestionWA/{{ $mocks->title }}_answer_{{ $mocks->id }}.pdf";
                    let title = '{{ $mocks->title }}_answer_{{ $mocks->id }}.pdf';
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

        });
        let url = '{{ route('topDownloaders.mock') }}';
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
                        indicatorButton.setAttribute('aria-current', slide === 0 ? 'true' : 'false');
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
                        row.className = 'row justify-content-center';

                        slideCards.forEach(card => {
                            const lineBreak = document.createElement("br");
                            let truncatedTitle = card.title.length < 25 ?
                                card.title.substring(0, card.title.indexOf(' ')) + card
                                .title.substring(card.title.indexOf(' ') + 1) :
                                card.title.substring(0, 30) + '.....';
                            const col = document.createElement('div');
                            col.className = 'col-lg-3 col-md-4 col-sm-6 text-center';

                            const cardLink = document.createElement('a');
                            cardLink.href = '/MockDetail/' + card.slug;

                            const cardImage = document.createElement('img');
                            cardImage.className = 'book-img';
                            cardImage.src = `{{ asset('images/mock/${card.title_image}') }}`;
                            cardImage.alt = '';

                            cardLink.appendChild(cardImage);
                            col.appendChild(cardLink);

                            const cardInfo = document.createElement('div');
                            const cardTitleLink = document.createElement('a');
                            cardTitleLink.href = '/BookDetail/' + card.slug;
                            const cardTitle = document.createElement('h3');
                            cardTitle.className = 'book-title';

                            // Create the title text nodes and append the line break element
                            if (card.title.length < 25) {
                                const firstPart = card.title.substring(0, card.title
                                    .indexOf(' '));
                                const secondPart = card.title.substring(card.title.indexOf(
                                    ' ') + 1);

                                cardTitle.appendChild(document.createTextNode(firstPart));
                                cardTitle.appendChild(lineBreak.cloneNode());
                                cardTitle.appendChild(document.createTextNode(secondPart));
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
                console.error(error);
            }
        });
    </script>
@endsection

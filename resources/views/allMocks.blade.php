@extends('layouts.app')
@section('title', 'All Mocks')

@section('content')
    <div class="row justify-content-center page-header py-5 m-0" style="width: 100%; background-color: #2878EB1A">
        <div class="col-12">
            <h2 class="page-title text-center">All Mocks</h2>
        </div>
        <div class="col-12">
            <p class="page-desc text-center">1000+ mocks are published by different authors everyday. </p>
        </div>
    </div>
    <div class="container my-4">
        <div id="data">

        </div>


        <div class="row my-4" id="view_more">
            <div class="col-12 justify-content-center text-center">
                <button type="button" id=load_more class=" btnAllMocks btn-height">View More <span class=""><i
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
            let urlGet = '{!! route('mocks.ajex') !!}';
            $.ajax({
                type: 'GET',
                url: urlGet,
                dataType: 'json',
                success: function(response) {
                    if (response.mocks.length < 12) {
                        const view_more = document.getElementById('view_more');
                        view_more.style.display = 'none';
                    }
                    let = pdf = ` <div class="row justify-content-between my-4">
                <div class="col-md-6 text-center">
                    <select name="sort_by" class="form-select" style="width:200px" id="sort_by" >
                        <option style="width:100px" value="">Sort by</option>
                        <option style="width:100px"  value="A-Z">Alphabetically,
                            A-Z</option>
                        <option style="width:100px"   value="Z-A">Alphabetically,
                            Z-A</option>
                    </select>
                </div>
                <div class="col-md-4 text-center">
                    <span>Showing 1 - ${response.mocks.length} of ${response.count} result</span>
                    <input type="hidden" name="currentCount" id="currentCount" value="${response.mocks.length}">
                </div>
            </div>
            <div class="row justify-content-center">`;
                    response.mocks.forEach(card => {
                        let truncatedTitle = card.title.length < 25 ?
                            card.title.substring(0, card.title.indexOf(' ')) + '<br>' + card
                            .title.substring(card.title.indexOf(' ') + 1) :
                            card.title.substring(0, 28) + '....';
                        // console.log("mock titile length ", truncatedTitle.length);
                        pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center">
                <a href="MockDetail/${card . slug}">
                    <img class="book-img mb-3" src="/images/mock/${card.title_image}" alt="">

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
                // console.log(currentCount);
                showData(currentCount, $('#sort_by').val()); // Pass selectedValue as an argument
            });

            function showData(currentCount, selectedValue) { // Accept selectedValue as an argument
                // console.log(selectedValue);
                let postUrl = '{!! route('mocks.ajex') !!}';
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
                        if (response.mocks.length == response.count) {
                            const view_more = document.getElementById('view_more');
                            view_more.style.display = 'none';
                        }
                        let = pdf = ` <div class="row justify-content-between my-4 gx-5">
                        <div class="col-md-6 text-center p-4">
                            <select name="sort_by" class="form-select" style="width:200px" id="sort_by" >
                                <option style="width:100px" value="">Sort by</option>
                                <option style="width:100px"  value="A-Z">Alphabetically,
                                    A-Z</option>
                                <option style="width:100px"   value="Z-A">Alphabetically,
                                    Z-A</option>
                            </select>
                        </div>
                        <div class="col-md-4 text-center">
                            <span>Showing 1 - ${response.mocks.length} of ${response.count} result</span>
                            <input type="hidden" name="currentCount" id="currentCount" value="${response.mocks.length}">
                        </div>
                    </div>
                    <div class="row justify-content-center">`;
                        response.mocks.forEach(card => {
                            let truncatedTitle = card.title.length < 25 ?
                                card.title.substring(0, card.title.indexOf(' ')) + '<br>' + card
                                .title.substring(card.title.indexOf(' ') + 1) :
                                card.title.substring(0, 28) + '....';
                            pdf += `<div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <a href="MockDetail/${card . slug}">
                            <img class="book-img mb-3" src="images/mock/${card.title_image}" alt="">

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



        });
        const form = document.getElementById("myForm");

        function submitFoem() {
            form.submit();
        }
    </script>
@endsection

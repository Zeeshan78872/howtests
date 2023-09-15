<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="title" content="@yield('meta_title')">
    <meta name="description" content="@yield('meta_desc')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Include Bootstrap JavaScript and CSS dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            padding: 20px;
            /* border: 1px solid #ccc; */
            margin: 1px;
            font-size: 30px;
            color: #222;
            /* background-color: #ccc; */
        }

        .search-container {
            position: relative;
        }

        #search-input,
        #search-button {
            display: none;
        }

        a.nav-link {
            font-family: Poppins;
            font-size: 16px;
            font-weight: 400;
            line-height: 15px;
            letter-spacing: 0em;
            text-align: left;
            color: rgba(49, 49, 49, 1);

        }



        .navbar-list .nav-item {
            margin-right: 7px;
        }

        footer {}

        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Set the minimum height of the viewport */
        }

        #app {
            flex: 1;
            /* Allow the content to expand and fill available space */
        }

        .footer {
            background-color: rgba(51, 51, 51, 1);

            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            flex-shrink: 0;
            /* Prevent footer from shrinking */
        }

        /* Your existing styles */

        /* Hide search elements on screens larger than 768px (adjust as needed) */


        /* Show search elements on screens smaller than 769px */
        @media (max-width: 767px) {
            .search-container {
                display: none !important;
            }
        }

        @media (max-width: 567px) {

            #search-iconn {
                display: block !important;
            }
        }
    </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-N3TWM232GL"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-N3TWM232GL');
</script>

<body>
    <div id="app">
        @include('layouts.header')

        <main class="bg-white">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    @yield('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show input when the button is clicked
            // var inputElement = document.getElementById("search-inputM");
            // // inputElement.style.display = "none";
            // document.getElementById("search-iconn").addEventListener("click", function() {

            //     if (inputElement.style.display === "none") {
            //         inputElement.style.display = "block";
            //     } else {
            //         // inputElement.style.display = "none";
            //     }
            // });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const searchIcon = document.getElementById("search-icon");
            const searchInput = document.getElementById("search-input");
            const searchButton = document.getElementById("search-button");
            const itemList = document.getElementById("item-list");

            searchIcon.addEventListener("click", function() {
                searchIcon.style.display = "none";
                searchInput.style.display = "inline-block";
                itemList.style.display = "none";
                searchInput.focus();
            });

            searchInput.addEventListener("focusout", function() {
                searchInput.style.display = "none";
                itemList.style.display = "";
                searchIcon.style.display = "inline-block";
            });

            searchInput.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById('search_form').submit();
                }
            });




        });

        document.addEventListener("DOMContentLoaded", function() {
            const searchButtonn = document.getElementById("search-iconn");
            const searchInputt = document.getElementById("search-inputt");
            const searchContainerr = document.querySelector(".search-containerr");



            // Show search input when the button is clicked
            // searchButtonn.addEventListener("click", function() {
            //     searchInputt.style.display = "block";
            //     searchInputt.focus();
            // });

            // Hide search input when focus is lost
            searchInputt.addEventListener("blur", function() {
                searchInputt.style.display = "none";
            });

            // Prevent hiding input when clicking inside the input
            searchInputt.addEventListener("click", function(event) {
                event.stopPropagation();
            });

            // Hide input when clicking outside of the input and the button
            document.addEventListener("click", function(event) {
                if (!searchContainerr.contains(event.target) && event.target !== searchButtonn) {
                    searchInputt.style.display = "none";
                }
            });
            const navbarToggler = document.getElementById('navbar-toggler');
            const carousalIndicator = document.getElementById('carousel-indicators');
            // const mobileSearchForm = document.getElementById('mobile-search-form');
            const body = document.body;
            const booksearchForm = document.getElementsByClassName("book-search-form")
            const navbarSupportedContent = document.getElementById('navbarSupportedContent');
            const crossIcons = document.getElementById('crossIcons');
            const hamburger = document.getElementById('hamburger');

            crossIcons.style.display = 'none';
            navbarToggler.addEventListener('click', function() {

                if (navbarToggler.getAttribute('aria-expanded') === 'true') {
                    body.classList.add('no-scroll');
                    // carousalIndicator.style.zIndex = '0';
                    // mobileSearchForm.style.zIndex = '0';
                    // booksearchForm.style.zIndex = '0';
                    hamburger.style.display = 'none';
                    crossIcons.style.display = 'block';
                    navbarSupportedContent.style.zIndex = '12000';
                } else {
                    body.classList.remove('no-scroll');
                    // carousalIndicator.style.zIndex = '1';
                    // mobileSearchForm.style.zIndex = '1';
                    hamburger.style.display = 'block';
                    crossIcons.style.display = 'none';
                }

            });
        });

        function closeNavbar() {
            const navLinks = document.querySelectorAll('.nav-item')
            const menuToggle = document.getElementById('navbarSupportedContent')
            const bsCollapse = new bootstrap.Collapse(menuToggle)

            navLinks.forEach((l) => {
                l.addEventListener('click', () => {
                    bsCollapse.toggle()
                })
            })
        }

        function showInput() {
            let input = document.getElementById('search-inputt');
            input.style.display = "block";
        }

        function showingForm() {

        }
    </script>
</body>

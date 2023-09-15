<nav class="navbar navbar-expand-md  navbar-light bg-light p-0 shadow-sm" id="navbar">
    <div class="container">
        <a class="navbar-brand " href="{{ url('/') }}">
            <img id="large-device-logo" src="{{ asset('images/site/headerLogo.png') }}" alt="">
            <img id="navbar-image" src="{{ asset('images/site/small-device-logo.png') }}" alt="">
        </a>

        <div class="d-flex" id="navIcons">
            {{-- <div class="search-containerM " style="margin-right: 10px;" id="searchHeader">
                <form id="search_formM" class="shadow-sm" action="{{ route('search') }}" method="POST">
                    @csrf<input id="search-inputM" name="title" class="form-control shadow-none header-search-form"
                        type="text" placeholder="Search...">
                    <button type="button" id="search-iconn" onclick="showingForm()"
                        class="rounded-circle d-none d-sm-block d-md-none me-1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div> --}}


            <button class="navbar-toggler shadow-none" id="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <i class="bi bi-list" id="hamburger" style="font-size: 22px; color: #2878EB; font-weight: bold;"></i>
                <i class="bi bi-x-lg " id="crossIcons" style="font-size: 22px; color: #2878EB; font-weight: bold;"></i>
            </button>
        </div>

        <div class="search-containerr mb-2 mx-auto d-none">
            <form id="search_formm" action="{{ route('search') }}" method="POST"> @csrf
                <input id="search-inputt" name="title" class="form-control" type="search" placeholder="Search..."
                    style="display: none;">
            </form>
        </div>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto navbar-list" id="item-list">
                <div class="cross-icons py-2">

                </div>
                <li class="nav-item ">
                    <a class="nav-link" href="/">{{ __('Home') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('aboutsU') }}">{{ __('About Us') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('books.all') }}">{{ __('All Books') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('mocks.all') }}">{{ __('All Mocks') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('contactUs') }}">{{ __('Contact US') }}</a>
                </li>
                <li class="nav-item ">
                    <div class="header">
                        <div class="search-container">
                            <button type="button" id="search-icon" class="btn btn-primary rounded-circle">
                                <i class="fa-solid fa-magnifying-glass mx-auto"></i>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="search-container">
                <form id="search_form" action="{{ route('search') }}" method="POST"> @csrf<input id="search-input"
                        name="title" class="form-control" type="search" placeholder="Search..."></form>
                <button id="search-button" class="btn btn-primary rounded-circle"> <i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>


    </div>
</nav>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HowTest </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Books</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Book</h6>
                <a class="collapse-item" target="_blank" href="{{ route('Book.create') }}">Add Books</a>
                <a class="collapse-item" href="{{ route('Book.index') }}">View Books</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseMock" aria-expanded="true"
            aria-controls="collapseMock">
            <i class="fas fa-fw fa-cog"></i>
            <span>Mocks</span>
        </a>
        <div id="collapseMock" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Mocks</h6>
                <a class="collapse-item" target="_blank" href="{{ route('Mock.create') }}">Add Mocks</a>
                <a class="collapse-item" href="{{ route('Mock.index') }}">View Mocks</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
            aria-controls="collapse3">
            <i class="fas fa-fw fa-cog"></i>
            <span>Category</span>
        </a>
        <div id="collapse3" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category</h6>
                <a class="collapse-item" href="{{ route('category.create') }}">Add Category</a>
                <a class="collapse-item" href="{{ route('category.index') }}">View Category</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true"
            aria-controls="collapse5">
            <i class="fas fa-fw fa-cog"></i>
            <span>Question Bank</span>
        </a>
        <div id="collapse5" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Question Bank</h6>
                <a class="collapse-item" href="{{ route('questionBank.create') }}">Add Question Bank</a>
                <a class="collapse-item" href="{{ route('questionBank.index') }}">View Question Bank</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>View Users</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('viewSubscribe') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>View Subscribers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contacts') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Contact Us</span></a>
    </li>

    <!-- Divider -->


    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

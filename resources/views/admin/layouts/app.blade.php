<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content>
    <meta name="author" content>

    <title>Admin - HowTest</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <style>
        .modal-title {
            font-family: Inter;
            font-size: 16px;
            font-weight: 600;
            line-height: 7px;
            letter-spacing: 0.13px;
        }

        .modal-title-pos {
            padding: 200px;
        }

        .modalCloseBtn {
            padding: 10px 15px;
            font-family: Inter;
            font-size: 25px;
            font-weight: 600;
            line-height: 7px;
            letter-spacing: 0.13px;
            color: rgba(50, 50, 50, 1);
            background: transparent;
            border: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .closebtn {
            background: transparent;
            color: rgba(50, 50, 50, 1);
            border: none;
        }

        .modal-body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #downloadModal {
            width: 353px;
            height: 343px;
            margin: auto;
        }



        .modal-content {
            width: 425px !important;
            height: 372px !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @yield('head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.layouts.slider')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('admin.layouts.header')
                <!-- End of Topbar --
                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; HowTest 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to
                        Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are
                    ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('script')
    <script>
        function applyInputBehavior(inputElement) {
            // Set the default value to 0
            // inputElement.value = 0;
            // Add an event listener to handle input changes
            inputElement.addEventListener("input", function() {
                // Get the entered value
                var enteredValue = parseFloat(inputElement.value);
                // Check if the entered value is less than 0
                if (isNaN(enteredValue) || enteredValue < 0) {
                    inputElement.value = 0; // Set the value to 0
                    console.log('successful');
                }
            });
        }
        var inputElements = document.querySelectorAll(".number-input");
        inputElements.forEach(function(inputElement) {
            applyInputBehavior(inputElement);
        });
        // Get all the navigation items with dropdowns
        const navItems = document.querySelectorAll('.nav-item.active');

        // Attach a click event listener to each navigation item
        navItems.forEach(navItem => {
            const navLink = navItem.querySelector('.nav-link');
            const collapseTarget = navLink.getAttribute('data-target');

            // Add a click event listener to the navigation link
            navLink.addEventListener('click', () => {
                // Close all open dropdowns
                document.querySelectorAll('.collapse.show').forEach(collapse => {
                    if (collapse.id !== collapseTarget) {
                        collapse.classList.remove('show');
                    }
                });
            });
        });
    </script>

</body>

</html>

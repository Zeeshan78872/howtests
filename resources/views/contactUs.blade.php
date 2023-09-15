@extends('layouts.app')
@section('title', 'HowTest - Contact US')

@section('content')
    <div class="row justify-content-center page-header py-5 m-0" style="width: 100%; background-color: #2878EB1A;">
        <div class="col-12">
            <div class="container">
                <h2 class="page-title text-start">Contact Us</h2>
            </div>
        </div>
    </div>
    <div class="container my-md-5">
        <div class="row mb-5 mt-md-2">
            <div class="col-md-8 p-3" style="background: rgba(249, 249, 249, 1);">
                <h2 class=" text-start">Get In Touch</h2>
                <form action="{{ route('contactUs.store') }}" method="POST">
                    @csrf
                    <div class="row gx-2 my-3">
                        <div class="col-md-6 mb-2"><input type="text" required name="name" class="form-control"
                                placeholder="Name">
                        </div>
                        <div class="col-md-6 mb-2"><input type="email" required name="email" class="form-control"
                                placeholder="Email">
                        </div>
                        <div class="col-md-12 mb-2"><input type="text" name="phone_no"
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninput="formatPhoneNumber(this)" value=""
                                class="form-control" placeholder="+92-332-6105842">
                        </div>

                        <div class="col-md-12 mb-2">
                            <textarea name="message" class="form-control" oninput="checkurl()" id="yourTextareaId" cols="30" rows="5"
                                placeholder="Your Message Here" style="resize: none"></textarea>
                        </div>
                        <div class="col-md-12 py-3">
                            <button type="submit" class="btnSubmit btn-height">Submit Now</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 p-5" style="background: #2878EB; color:white;">
                <h2 class=" text-center">Contact Info</h2>
                <div class="row justify-content-center mt-3">
                    <div class="col-2 text-center" style="font-size: x-large;"><i class="fa-solid fa-globe"></i>
                    </div>
                    <div class="col-8">
                        <h6>Other Websites</h6>
                        <a class="text-white" href="http://howfiv.com">www.howfiv.com</a>
                        <a class="text-white" href="http://www.cssprepforum.com">www.cssprepforum.com</a>
                        <a class="text-white" href="http://www.storyious.com">www.storyious.com</a>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-2 text-center" style="font-size: x-large;"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="col-8">
                        <h6>Whatsapp</h6>
                        <p><a style="color: #fff"
                                href="https://api.whatsapp.com/send?phone=923006322446">+92-300-6322446</a><br>
                            <a style="color: #fff"
                                href="https://api.whatsapp.com/send?phone=923326105842">+92-332-6105842</a>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-2 text-center" style="font-size: x-large;"><i
                            class="fa-solid fa-envelope-open-text"></i></div>
                    <div class="col-8">
                        <h6>Mail Us</h6>
                        <p><a style="color: #fff" href="mailto:info@howtests.com">info@howtests.com</a></p>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-12 text-center"><span class="ms-2 ">
                            <a class="text-white" href="https://www.facebook.com/howfiv"><i style="font-size: 22px;"
                                    class="fa-brands fa-facebook-f me-2"></i></a></span>
                        <span class="ms-2 "><a class="text-white" href="https://www.instagram.com/cssprepforum/"><i
                                    style="font-size: 22px;" class="fa-brands fa-instagram me-2"></i></a></span>
                        <span class="ms-2 "><a class="text-white"
                                href="https://www.google.com/search?q=CSSPREPFORUM&rlz=1C1GCEB_enPK1020PK1020&oq=CSSPREPFORUM&aqs=chrome..69i57j69i60l3j69i65j69i60.6046j0j9&sourceid=chrome&ie=UTF-8"><i
                                    style="font-size: 22px;" class="fa-brands fa-google me-2"></i></a></span>
                        <span class="ms-2 "><a class="text-white" href="https://www.youtube.com/@Howfiv"><i
                                    style="font-size: 22px;" class="fa-brands fa-youtube me-2"></i></a></span>
                        <span class="ms-2 "><a class="text-white" href="https://www.linkedin.com/in/howfiv/"><i
                                    style="font-size: 22px;" class="fa-brands fa-linkedin-in me-2"></i></a></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        // Get the input element
        function formatPhoneNumber(input) {
            // Remove all non-digit characters from the input value
            const cleaned = input.value;

            // Check if the cleaned value is not empty
            if (cleaned.length > 0) {
                // Add +92 at the beginning of the cleaned value and format it with dashes
                input.value = cleaned.replace(/^(\+92)(\d{3})(\d{3})(\d{4}).*/, '$1-$2-$3-$4');
            } else {
                // If the input is empty, clear it
                // input.value = '+92';
            }
        }




        function checkurl() {
            var textareaElement = document.getElementById('yourTextareaId');
            var text = textareaElement.value;

            // Regular expression to find HTTP/HTTPS prefixes
            var httpRegex = /(https?:\/\/[^\s]+)/g;
            var httpMatches = text.match(httpRegex);

            // Remove HTTP/HTTPS prefixes
            if (httpMatches) {
                for (var i = 0; i < httpMatches.length; i++) {
                    text = text.replace(httpMatches[i], '');
                }
            }

            // Regular expression to find common domain extensions
            var domainExtRegex =
                /(\.com|\.net|\.org|\.io|\.co|\.uk|\.gov|\.edu|\.info|\.biz|\.us|\.ca|\.eu|\.tech|\.online|\.live|\.pk|\.in)/g;
            var domainExtMatches = text.match(domainExtRegex);

            // Remove common domain extensions
            if (domainExtMatches) {
                for (var j = 0; j < domainExtMatches.length; j++) {
                    text = text.replace(domainExtMatches[j], '');
                }
            }

            textareaElement.value = text;
        }
    </script>
@endsection

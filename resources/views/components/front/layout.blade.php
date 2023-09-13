<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.min.css
    " rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>info@example.com</small>
                </div>
                <form action="{{ route('locale') }}" style="display: inline-block;" id="locale">
                    <select name="locale"
                        style="display: inline-block;
                background-color: #120f2d;
                color: #fff;
                border: none;
                padding: 2px 20px;
                border-radius: 6px;
                outline:none;
                margin-left: 20px;"
                        id="select-locale">
                        <option value="en" @selected(LaravelLocalization::setLocale() == 'en')>{{ __('English') }}</option>
                        <option value="ar" @selected(LaravelLocalization::setLocale() == 'ar')>{{ __('Arabic') }}</option>
                    </select>
                </form>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <x-front.partials.Links type='front'></x-front.partials.Links>
    <!-- Navbar End -->

    {{ $slot }}

    <!-- Footer start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>Edukate</h1>
                    </a>
                    <p class="m-0">Accusam nonumy clita sed rebum kasd eirmod elitr. Ipsum ea lorem at et diam est,
                        tempor rebum ipsum sit ea tempor stet et consetetur dolores. Justo stet diam ipsum lorem vero
                        clita diam</p>
                </div>
                @if (!Auth::user())
                    <div class="col-md-6 mb-5">
                        <h3 class="text-white mb-4">Newsletter</h3>
                        <div class="w-100">
                            <div class="input-group">
                                <form action="{{ route('login') }}" method="post"
                                    style="width: 100%;display:flex; position: relative;">
                                    @csrf
                                    <input type="password" name="password" class="form-control border-light"
                                        style="padding: 30px;" placeholder="password">
                                    <input type="email" name="email" class="form-control border-light"
                                        style="padding: 30px;position: absolute;" placeholder="Your Email Address"
                                        id="email">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary px-4"
                                            style="text-wrap:nowrap;">Sign
                                            Up</button>
                                        <button type="button" class="btn button btn-primary px-4"
                                            style="padding: 18px 0px;width: 107px;text-wrap:nowrap;position: absolute;"
                                            onclick="this.hidden=true; document.getElementById('email').hidden=true;">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-twitter"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-facebook-f"></i></a>
                        <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-linkedin-in"></i></a>
                        <a class="text-white" href="#"><i class="fab fa-2x fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Our Courses</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Web
                            Design</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Apps
                            Design</a>
                        <a class="text-white-50 mb-2" href="#"><i
                                class="fa fa-angle-right mr-2"></i>Marketing</a>
                        <a class="text-white-50 mb-2" href="#"><i
                                class="fa fa-angle-right mr-2"></i>Research</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>SEO</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Privacy
                            Policy</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Terms &
                            Condition</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Regular
                            FAQs</a>
                        <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Help &
                            Support</a>
                        <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 border-top py-4"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">Your Site Name</a>. All
                        Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js"></script>
    <script>
        if ("{{ Session::get('locale') }}" == 'ar') {
            document.querySelector('html').lang = 'ar';
        }
    </script>

    <script>
        if ("{{ Session::has('success') }}") {
            Swal.fire(
                'Success',
                "{{ Session::get('success') }}",
                'success'
            )
        }
        if ("{{ Session::has('info') }}") {
            Swal.fire(
                'Change Status  Success',
                "{{ Session::get('info') }}",
                'info'
            )
        }
        if ("{{ Session::has('delete') }}") {
            Swal.fire({
                icon: 'warning',
                iconColor: 'red',
                // color: 'red',
                // confirmButtonColor: 'red',
                title: 'Deleted Success',
                text: "{{ Session::get('delete') }}",
                // footer: '<a href="">Why do I have this issue?</a>'
            })
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var languageSelect = document.getElementById("select-locale");
            languageSelect.addEventListener("change", function() {
                var selectedLocale = this.value;
                var currentUrl = window.location.href;
                var baseUrl = '{{ LaravelLocalization::getNonLocalizedURL() }}';
                var localePrefixPosition = currentUrl.indexOf('/' + "{{LaravelLocalization::setLocale()}}");
                if (localePrefixPosition !== -1) {
                    // Replace the existing locale prefix with the selected locale
                    var newUrl = currentUrl.substr(0, localePrefixPosition + 1) + selectedLocale +
                        currentUrl.substr(localePrefixPosition + 3);
                    // Redirect the user to the new URL
                    window.location.href = newUrl;
                    console.log(selectedLocale);
                    console.log(localePrefixPosition);
                    console.log(currentUrl)
                    console.log(baseUrl)
                    console.log(newUrl)
                    console.log("{{LaravelLocalization::getCurrentLocale()}}")
                };
            })
        });
        // LaravelLocalization::getCurrentLocale()
    </script>
</body>

</html>

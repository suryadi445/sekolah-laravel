<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .carousel-control {
            width: 4%;
        }

        .carousel-control.left,
        .carousel-control.right {
            margin-left: 15px;
            background-image: none;
        }

        @media (max-width: 767px) {
            .carousel-inner .active.left {
                left: -100%;
            }

            .carousel-inner .next {
                left: 100%;
            }

            .carousel-inner .prev {
                left: -100%;
            }

            .active>div {
                display: none;
            }

            .active>div:first-child {
                display: block;
            }

        }

        @media (min-width: 767px) and (max-width: 992px) {
            .carousel-inner .active.left {
                left: -50%;
            }

            .carousel-inner .next {
                left: 50%;
            }

            .carousel-inner .prev {
                left: -50%;
            }

            .active>div {
                display: none;
            }

            .active>div:first-child {
                display: block;
            }

            .active>div:first-child+div {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .carousel-inner .active.left {
                left: -25%;
            }

            .carousel-inner .next {
                left: 25%;
            }

            .carousel-inner .prev {
                left: -25%;
            }
        }

        ul {
            list-style-type: none;
        }

        .jumbo {
            background-image: url("{{ asset('images/upload/image.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 450px !important;
        }

        body {
            font-family: 'Amaranth' !important;
            font-size: 16px !important;
            max-width: 100%;
            overflow-x: hidden;
        }

        @media only screen and (max-width: 600px) {
            .jumbo {
                object-fit: cover;
                width: 100% !important;
                height: 200px !important;
            }
        }
    </style>

    {{-- style for counter --}}
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">



    {{-- <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
        integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> --}}
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
    @include('layouts.navbar')

    @yield('container')

    @include('layouts.counter')

    @include('layouts.footer')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/fontawesome/css/all.css">

    <script type="text/javascript" src="{{ URL::to('/') }}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/validation.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/jquery.slim.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/popper.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ URL::to('/') }}/css/mystyle.css">
</head>

<body>
    <div class="container m-auto">
        <div class="row m-4">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <a class="navbar-brand" href="#"><img src="{{ URL::to('/') }}/images/logo.png"
                            class="img-fluid" height="35%" width="35%" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#collapsibleNavbar">
                        <span class="bg-dark fa-sharp fa-solid fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/home"><i class="fa-solid fa-house"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/events"><i class="fa-regular fa-image"></i> Events
                                    Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about"><i class="fa-solid fa-circle-info"></i> About
                                    Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact"><i class="fa-regular fa-address-card"></i>
                                    Contact </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login"><i class="fa-solid fa-right-to-bracket"></i> Login
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a class="nav-link" href="/register"><i class="fa-solid fa-user-plus"></i> Register
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

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
                                <a class="nav-link" href="{{ URL::to('/') }}/manage_users"><i
                                        class="fa-solid fa-users-line"></i>
                                    Manage Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/') }}/manage_events"><i
                                        class="fa-regular fa-image"></i> Manage Events
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/') }}/user_change_profile"><i
                                        class="fa-regular fa-address-card"></i> Change Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/') }}/user_change_profile_picture"><i
                                        class="fa-solid fa-id-badge"></i>
                                    Change Profile Picture </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/') }}/change_password"><i
                                        class="fa-solid fa-key"></i> Change Password
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ URL::to('/') }}/logout"><i
                                        class="fa-solid fa-right-from-bracket"></i></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        @yield('admin_dynamic_1')

        <div class="row align-items-center" style="background-color:#DE0826">
            <div class="Col-12 align-items-center">
                <div style="color: white;margin-top:15px;margin-bottom:15px;" class="align-items-center">Copyright
                    &copy; 2023
                </div>
            </div>
        </div>

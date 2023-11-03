@include('header')
@if (session()->has('succ'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!! </strong> {{ session('succ') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!! </strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-md-3 col-6">
            <h1>Login</h1>
            <br>
            <form method="post" action="{{ URL::to('/') }}/login_authentication">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" name="em" placeHolder="Email" id="em1" class="form-control">
                        <p id="em_err" style="color: red;">
                            @error('em')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="password" name="pwd" placeHolder="Password" id="pwd1"
                            class="form-control">
                        <p id="pwd_err" style="color: red;">
                            @error('pwd')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="row" style="text-align:center;">
                    <div class="col">
                        <input type="submit" value="Login" name="btn-login" class="btn btn-danger">

                        <input type="reset" value="Reset" name="btn-message" class="btn btn-danger">
                    </div>
                </div>
                <br>
                <div class="row" style="text-align:center;">
                    <div class="col">
                        <p> Don't have an Account? &nbsp;&nbsp;<a href="register.php"> <input type="Button"
                                    value="Create Account" name="btn-message" class="btn btn-danger"></a></p>
                    </div>
                </div>

                <div class="row" style="text-align:center;">
                    <div class="col">
                        <p> Don't Remeber you Password?<a href="forget_password_form"> <input type=" Button"
                                    value="Forgot Password" name="btn-message" class="btn btn-danger"></a></p>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@include('footer')

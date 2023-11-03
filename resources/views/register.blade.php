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
            <h1>Register Yourself</h1>
            <br>
            <form method="post" actio="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" name="fn" placeHolder="Fullname" id="fn1"
                            value="{{ old('fn') }}" class="form-control">

                        <span style="color:red">
                            @error('fn')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="text" name="em" placeHolder="Email" id="em1" class="form-control"
                            value="{{ old('em') }}">

                        <span style="color:red">
                            @error('em')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="password" name="pwd" placeHolder="Password" id="pwd1" class="form-control"
                            value="{{ old('pwd') }}">

                        <span style="color:red">
                            @error('pwd')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="password" name="pwd_confirmation" placeHolder="Confirm Password" id="repwd1"
                            class="form-control" value="{{ old('repwd') }}">

                        <span style="color:red">
                            @error('pwd_confirmation')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="number" name="mobile" placeHolder="Mobile Number" id="mobile1"
                            class="form-control" value="{{ old('mobile') }}">

                        <span style="color:red">
                            @error('mobile')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="file" name="pic" id="pic1" class="form-control">
                        <span style="color:red">
                            @error('pic')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <br>
                <div class="row" style="text-align:center;">
                    <div class="col">
                        <input type="submit" value="Register" name="btn_reg" class="btn btn-danger">

                        <input type="reset" value="Reset" name="btn-message" class="btn btn-danger">
                    </div>
                </div>
                <br>

                <div class="row" style="text-align:center;">
                    <div class="col">
                        <p> Already have an Account?<a href="{{ URL::to('/') }}/login"> <input type=" Button"
                                    value="Login" name="btn-message" class="btn btn-danger"></a></p>
                    </div>
                </div>
                <br>

            </form>
        </div>
    </div>
</div>

@include('footer')

@include('header');
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
            <h1> Verify OTP</h1>
            <br>
            <form action="{{ URL::to('/') }}/verify_otp_forget_password_action" method="post">
                @csrf
                <div class="row">
                    <div clas="col">
                        <input type="text" class="form-control" placeholder="Enter OTP" name="otp"
                            id="pass">
                        <span style="color:red">
                            @error('otp')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div clas="col">
                        <input type="submit" class="btn btn-danger" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
@include('footer');

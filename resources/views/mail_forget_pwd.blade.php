Hello Mr/Ms. {{ $data3['name'] }}

You have requested for a Password reset link, so below is the link to reset your password.
is given below.

Link::http://127.0.0.1:8000/verify_forget_pwd_otp/{{ $data3['email'] }}/{{ $data3['token'] }}

OTP for password reset is {{ $data3['otp'] }}

This is the password reset link for your account with RK university
Student Demo Website.

The link is valid for 30 minutes. Please use forgot password facility again if the link has
expired

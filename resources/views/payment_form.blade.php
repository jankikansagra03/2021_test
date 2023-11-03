@include('header')
<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-md-3 col-6">
            <h1>Razor Pay Payment Gateway</h1>
            <br>
            <form action="/payment" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" name="username" id="uname1" placeholder="Enter Username"
                            class="form-control">

                        <span style="color:red">
                            @error('username')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="text" name="email" id="email1" placeholder="Enter Email"
                            class="form-control">

                        <span style="color:red">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="text" name="amount" placeholder="Enter Amount" class="form-control">

                        <span style="color:red">
                            @error('amount')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <br>
                <div class="row" style="text-align:center;">
                    <div class="col">
                        <button type="submit" id="rzp-button1" class="btn btn-danger">Pay Now</button>
                    </div>
                </div>
            </form>

            {{-- <button id="rzp-button1">Pay</button> --}}
            @if (Session::has('amount'))
                <div class="container tex-center mx-auto">
                    <form action="/pay" method="POST" class="text-center mx-auto mt-5">
                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                        <script>
                            var options = {
                                "key": "rzp_test_2B7SjKnlI8d1lM", // Enter the Key ID generated from the Dashboard
                                "amount": "{{ Session::get('amount') }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                "currency": "INR",
                                "name": "Acme Corp", //your business name
                                "description": "Test Transaction",
                                "image": "https://example.com/your_logo",
                                "order_id": "{{ Session::get('order_id') }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                "handler": function(response) {
                                    alert(response.razorpay_payment_id);
                                    alert(response.razorpay_order_id);
                                    alert(response.razorpay_signature)
                                },
                                "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                                    "name": "Janki Kansagra", //your customer's name
                                    "email": "janki.kansagra@rku.ac.in",
                                    "contact": "8155825235" //Provide the customer's phone number for better conversion rates 
                                },
                                "notes": {
                                    "address": "Razorpay Corporate Office"
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.on('payment.failed', function(response) {
                                alert(response.error.code);
                                alert(response.error.description);
                                alert(response.error.source);
                                alert(response.error.step);
                                alert(response.error.reason);
                                alert(response.error.metadata.order_id);
                                alert(response.error.metadata.payment_id);
                            });
                            document.getElementById('rzp-button1').onclick = function(e) {
                                rzp1.open();
                                e.preventDefault();
                            }
                        </script>
                        <input type="hidden" custom="Hidden Element" name="hidden">
                    </form>
            @endif

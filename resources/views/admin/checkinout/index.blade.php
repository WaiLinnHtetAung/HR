@extends('auth.app')
@section('title', 'Pin Code')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
                        <h4 class="mt-2 mb-4 fw-bold text-center">QR</h4>
                        <img style="width: 200px;" src="data:image/png;base64, {!! base64_encode(
                            QrCode::format('png')->size(100)->generate('Make me into an QrCode!'),
                        ) !!} ">
                        <p class="text-center mt-3">Please scan QR to check in or checkout</p>
                    </div>
                    <hr>
                    <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                        <h4 class="mt-3 mb-4 fw-bold text-center">Pin Code</h4>
                        <input type="text" name="mycode" id="pincode-input1">
                        <p class="text-center mt-3">Please enter PIN to check in or checkout</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#pincode-input1').pincodeInput({
                inputs: 4,
                complete: function(value, e, errorElement) {
                    $.ajax({
                        url: '/check-in',
                        type: 'post',
                        data: {
                            pin_code: value
                        },
                        success: function(res) {
                            console.log(res.message);
                        }
                    })

                    $(errorElement).html("I'm sorry, but the code not correct");
                }
            });
        })
    </script>
@endsection

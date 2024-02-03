<!DOCTYPE html>
<html>
<head>
    <style>
        #background {
            background-image: url('/home/images/background.jpg');
            background-size: cover;
            min-height: 100vh;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Set a semi-transparent white background for the card */
        }

        .text-center {
            color: white; /* Set the text color to white */
        }
    </style>
    @include('home.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</head>
<body>
    @include('home.header');
    <div class="hero_area" id="background">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center text-white">Payment Method</h2>
                    <br>
                    <div class="card">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header p-0">
                                    <h2 class="mb-0">
                                        <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span>Credit card</span>
                                                <div class="icons">
                                                    <img src="/home/images/stripe.png" width="30">
                                                    <img src="/home/images/visa.png" width="30">
                                                    <img src="/home/images/mc2.png" width="30">
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body payment-card-body">

                                        <!-- Display Laravel Validation Errors -->
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('stripe.post', ['totalPrice' => $totalprice]) }}"  class="require-validation"
                                            data-cc-on-file="false"
                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                            id="payment-form">
                                            @csrf

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body payment-card-body">
                                                    <div class="form-row row">
                                                        <div class="col-xs-12 col-md-6 form-group required">
                                                            <label class="control-label">Name on Card</label>
                                                            <input class="form-control" name="name" size="4" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-row row">
                                                        <div class="col-xs-12 col-md-6 form-group card required">
                                                            <label class="control-label">Card Number</label>
                                                            <input autocomplete="off" name="cardnumber" class="form-control card-number" size="20" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-row row">
                                                        <div class="col-xs-12 col-md-4 form-group cvc required">
                                                            <label class="control-label">CVC</label>
                                                            <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4 form-group expiration required">
                                                            <label class="control-label">Expiration Month</label>
                                                            <input class="form-control card-expiry-month" placeholder="MM" size="2" type="text">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4 form-group expiration required">
                                                            <label class="control-label">Expiration Year</label>
                                                            <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text">
                                                        </div>
                                                    </div>



                                                <div class="row" style="text-align: center;">
                                                <div class="col-xs-12">
                                                    <button style="width :200px" type="submit" class="btn btn-danger" name="" >Pay Now</button>
                                                </div>
                                            </div>

                                        </form>
                                        <br>


                                        <!-- Display Success Message -->
                                        @if(session('success'))
                                            <div class="alert alert-success mt-3">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    @include('home.footer');
    <div class="cpy_"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="/home/js/jquery-3.4.1.min.js"></script>
    <!-- Popper.js -->
    <script src="/home/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/home/js/bootstrap.js"></script>
    <!-- Custom JS -->
    <script src="/home/js/custom.js"></script>
</body>
<script type="text/javascript">

    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            $(this).find('button[type="submit"]').prop('disabled', true);
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                             'input[type=text]', 'input[type=file]',
                             'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
              var $input = $(el);
              if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
              }
            });

            if (!$form.data('cc-on-file')) {
              e.preventDefault();
              Stripe.setPublishableKey($form.data('stripe-publishable-key'));
              Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
              }, stripeResponseHandler);
            }

        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }



    });
    </script>
</html>

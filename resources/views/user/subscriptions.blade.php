@extends('layouts.user')
@section('styles')
    <link href="{{ asset('user_assets/libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .switchery {
            width: 90px;
        }
        .card-pricing-recommended {
            background-color: #3088c7 !important;
        }
    </style>
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">@lang('subscriptions')</li>
                </ol>
            </div>
            <h4 class="page-title">@lang('Plans')</h4>
        </div>
    </div>
</div>
@if(isset($trial_version_msg) && $trial_version_msg != "")
    <div class="alert alert-info col-md-8 offset-2" role="alert">
        <i class="mdi mdi-alert-circle-outline mr-2"></i> {{ $trial_version_msg }}
    </div>
@endif
@if(isset($success))
    <div class="alert alert-success" role="alert">
        <i class="mdi mdi-check-all mr-2"></i> {{ $success }}
    </div>
@elseif(isset($fail))
    <div class="alert alert-danger" role="alert">
        <i class="mdi mdi-block-helper mr-2"></i> {{ $fail }}
    </div>
@endif
<!-- Plans -->
<div class="row mb-3">
    <div class="col-md-6 offset-3 text-center">
        <span class="font-16 font-weight-bold mr-1">@lang('Monthly')</span>
        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#1C8AB9" />
        <span class="font-16 font-weight-bold ml-1">@lang('Yearly')</span>
    </div>
</div>
@php
    $user = \Illuminate\Support\Facades\Auth::user();
    $plan_id = $user->subscribe_id;//\App\Models\User\SubscribePlan::query()->where("plan_id", $user->plan_id)->get()[0]->id ?? 0;
@endphp
<div class="row" id="yearly">
    <div class="col-md-3 offset-3">
        <div class="card card-pricing">
            <div class="card-body text-center">
                <p class="card-pricing-plan-name font-weight-bold text-uppercase pb-0">@lang('Basic Plan')</p>
                <h2 class="card-pricing-price pt-0 mb-0"><sup>€</sup>&nbsp;220 <span>/ @lang('Year')</span></h2>
                <ul class="card-pricing-features pt-0 pb-0">
                    <li>@lang('Scout young players and academies')</li>
                </ul>
                <ul class="card-pricing-features pt-0">
                    <li>@lang('Free Trial')</li>
                    <li>(@lang('Save') 20 €)</li>
                </ul>
                @if($user->is_subscribed == 1)
                    @if($plan_id == 3)
{{--                        <a href="{{ url('/subscribe/paypal/cancel/3') }}" class="btn btn-danger btn-block waves-effect waves-light mt-1 mb-2 width-sm">Cancel</a>--}}
                        <button class="btn btn-outline-info btn-block mt-1 mb-2 width-sm" disabled="">@lang('Selected')</button>
                    @else
                        <button class="btn btn-outline-info btn-block mt-1 mb-2 width-sm" disabled="">@lang('Other Plan Selected')</button>
                    @endif
                @else
                    <a href="#" class="btn btn-outline-info btn-block waves-effect waves-light mt-1 mb-2 width-sm" onclick="paymentMethod(3)">@lang('Select')</a>
                @endif
                <div class="dropdown-divider"></div>
                <ul class="card-pricing-features">
                    <li>@lang('Add and follow your own players')</li>
                    <li>@lang('Create new teams and tournaments')</li>
                    <li>@lang('Create and export PDF reports')</li>
                    <li>@lang('Find your players with smart filters')</li>
                </ul>
            </div>
        </div> <!-- end Pricing_card -->
    </div> <!-- end col -->

    <div class="col-md-3">
        <div class="card card-pricing card-pricing-recommended">
            <div class="card-body text-center">
                <p class="card-pricing-plan-name font-weight-bold text-uppercase pb-0">@lang('Plan Pro')</p>
                <img src="{{ asset('user_assets/images/pro_logo.png') }}" width="100px" height="40px" style="top: 13px; right: 5px; position: absolute;" />
                <h2 class="card-pricing-price pt-0 mb-0"><sup>€</sup>&nbsp;290 <span>/ @lang('Year')</span></h2>
                <ul class="card-pricing-features pt-0 pb-0">
                    <li>@lang('Scout young and professional players')</li>
                </ul>
                <ul class="card-pricing-features pt-0">
                    <li>@lang('Free Trial')</li>
                    <li>(@lang('Save') 70 €)</li>
                </ul>
                @if($user->is_subscribed == 1)
                    @if($plan_id == 4)
{{--                        <a href="{{ url('/subscribe/paypal/cancel/4') }}" class="btn btn-danger btn-block waves-effect waves-light mt-1 mb-2 width-sm">Cancel</a>--}}
                        <button class="btn btn-light btn-block mt-1 mb-2 width-sm" disabled="">@lang('Selected')</button>
                    @else
                        <button class="btn btn-light btn-block mt-1 mb-2 width-sm" disabled="">@lang('Other Plan Selected')</button>
                    @endif
                @else
                    <a href="#" class="btn btn-light btn-block waves-effect waves-light mt-1 mb-2 width-sm" onclick="paymentMethod(4)">@lang('Select')</a>
                @endif
                <div class="dropdown-divider"></div>
                <ul class="card-pricing-features">
                    <li>@lang('Add and follow your own players + pre-loaded players')</li>
                    <li>@lang('Create new teams and tournaments')</li>
                    <li>@lang('Create and export PDF reports')</li>
                    <li>@lang('Find your players with smart filters')</li>
                    <li>@lang('+250 competitions, +170000 players, +75 teams')</li>
                    <li>@lang('Compare players')</li>
                    <li>@lang('Add more users or collaborators')</li>
                </ul>
            </div>
        </div> <!-- end Pricing_card -->
    </div> <!-- end col -->
</div>
<!-- end row -->
<div class="row" id="monthly">
    <div class="col-md-3 offset-3">
        <div class="card card-pricing">
            <div class="card-body text-center">
                <p class="card-pricing-plan-name font-weight-bold text-uppercase pb-0">@lang('Basic Plan')</p>
                <h2 class="card-pricing-price pt-0 mb-0"><sup>€</sup>&nbsp;20 <span>/ @lang('Month')</span></h2>
                <ul class="card-pricing-features pt-0 pb-0">
                    <li>@lang('Scout young players and academies')</li>
                </ul>
                <ul class="card-pricing-features pt-0">
                    <li>@lang('Free Trial')</li>
                    <li>(240 € @lang('per year'))</li>
                </ul>
                @if($user->is_subscribed == 1)
                    @if($plan_id == 1)
{{--                        <a href="{{ url('/subscribe/paypal/cancel/1') }}" class="btn btn-danger btn-block waves-effect waves-light mt-1 mb-2 width-sm">Cancel</a>--}}
                        <button class="btn btn-outline-info btn-block mt-1 mb-2 width-sm" disabled="">@lang('Selected')</button>
                    @else
                        <button class="btn btn-outline-info btn-block mt-1 mb-2 width-sm" disabled="">@lang('Other Plan Selected')</button>
                    @endif
                @else
                    <a href="#" class="btn btn-outline-info btn-block waves-effect waves-light mt-1 mb-2 width-sm" onclick="paymentMethod(1)">@lang('Select')</a>
                @endif
                <div class="dropdown-divider"></div>
                <ul class="card-pricing-features">
                    <li>@lang('Add and follow your own players')</li>
                    <li>@lang('Create new teams and tournaments')</li>
                    <li>@lang('Create and export PDF reports')</li>
                    <li>@lang('Find your players with smart filters')</li>
                </ul>
            </div>
        </div> <!-- end Pricing_card -->
    </div> <!-- end col -->

    <div class="col-md-3">
        <div class="card card-pricing card-pricing-recommended">
            <div class="card-body text-center">
                <p class="card-pricing-plan-name font-weight-bold text-uppercase pb-0">@lang('Plan Pro')</p>
                <img src="{{ asset('user_assets/images/pro_logo.png') }}" width="100px" height="40px" style="top: 13px; right: 5px; position: absolute;" />
                <h2 class="card-pricing-price pt-0 mb-0"><sup>€</sup>&nbsp;30 <span>/ @lang('Month')</span></h2>
                <ul class="card-pricing-features pt-0 pb-0">
                    <li>@lang('Scout young and professional players')</li>
                </ul>
                <ul class="card-pricing-features pt-0">
                    <li>@lang('Free Trial')</li>
                    <li>(360 € @lang('per year'))</li>
                </ul>
                @if($user->is_subscribed == 1)
                    @if($plan_id == 2)
{{--                        <a href="{{ url('/subscribe/paypal/cancel/2') }}" class="btn btn-danger btn-block waves-effect waves-light mt-1 mb-2 width-sm">Cancel</a>--}}
                        <button class="btn btn-light btn-block mt-1 mb-2 width-sm" disabled="">@lang('Selected')</button>
                    @else
                        <button class="btn btn-light btn-block mt-1 mb-2 width-sm" disabled="">@lang('Other Plan Selected')</button>
                    @endif
                @else
                    <a href="#" class="btn btn-light btn-block waves-effect waves-light mt-1 mb-2 width-sm" onclick="paymentMethod(2)">@lang('Select')</a>
                @endif
                <div class="dropdown-divider"></div>
                <ul class="card-pricing-features">
                    <li>@lang('Add and follow your own players + pre-loaded players')</li>
                    <li>@lang('Create new teams and tournaments')</li>
                    <li>@lang('Create and export PDF reports')</li>
                    <li>@lang('Find your players with smart filters')</li>
                    <li>@lang('+250 competitions, +170000 players, +75 teams')</li>
                    <li>@lang('Compare players')</li>
                    <li>@lang('Add more users or collaborators')</li>
                </ul>
            </div>
        </div> <!-- end Pricing_card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<!-- payment selection modal -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true"  id="payment_method_modal" data-backdrop="static" payment-type="1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">@lang('Payment Method')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-block btn-lg btn-outline-info waves-effect waves-light" onclick="gotoStripe()">
                    <i class="mdi mdi-credit-card"></i> @lang('Credit Card')</button>
                    
                        <form action="#" method="post" id="payment-form" class="card card-body" style="display:none;">
                            @csrf                    
                            <div class="form-group">
                                <div class="card-body">
                                    <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    <input type="hidden" name="plan" id="plan_id"/>
                                </div>
                            </div>
                            <button class="btn btn-dark width-xs waves-effect waves-light" type="submit">@lang('Pay')</button>
                        </form>
                    <div class="dropdown-divider"></div>
                    <button type="button" class="btn btn-block btn-lg btn-outline-info waves-effect waves-light" onclick="gotoPaypal()">
                    <i class="mdi mdi-paypal"></i> @lang('Paypal')</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal -->

@endsection

@section('scripts')
    @parent
    <script src="{{ asset('user_assets/libs/switchery/switchery.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        let paymentType = 0;
        $(document).ready(function () {
            $(".card-pricing").css("height", $(".card-pricing-recommended").css("height"));
            // selectType();
            $('[data-plugin="switchery"]').each(function (e, n) {
                new Switchery($(this)[0], $(this).data())
            }).change(function() {
                if (this.checked)
                {
                    $("#yearly").css("display", "");
                    $("#monthly").css("display", "none");
                } else {
                    $("#yearly").css("display", "none");
                    $("#monthly").css("display", "");
                }
            });
            $("#yearly").css("display", "none");
            $("#monthly").css("display", "");
        });
        function selectType() {
            setTimeout(function () {
                if($("#yearly_tag").hasClass("active"))
                {
                    $("#yearly").css("display", "");
                    $("#monthly").css("display", "none");
                } else {
                    $("#yearly").css("display", "none");
                    $("#monthly").css("display", "");
                }
            }, 100);
        }
        
        function paymentMethod(type)
        {
            paymentType = type;
            $('#payment_method_modal').modal();
            $('#plan_id').val(paymentType);
            $('#payment-form').attr("action", "{{ url('/subscribe/stripe') }}/" + paymentType);
        }

        function gotoPaypal()
        {
            location.href = "{{ url('/subscribe/paypal') }}/" + paymentType;
        }

        function gotoStripe()
        {
            if($('#payment-form').is(":visible"))
                $('#payment-form').hide();
            else
                $('#payment-form').show();
        }

        var stripe = Stripe("{{ \Config::get('services.stripe.key') }}");

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: 'white',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                iconColor: 'white',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                    billing_details: {
                    name: 'Test',
                },
            })
            .then(function(result) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', JSON.stringify(result.paymentMethod));
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
                //console.log(result.paymentMethod);
            });
        }
    </script>
@endsection
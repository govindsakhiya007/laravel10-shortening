@extends('layouts.dashboard')

@section('title') Ticket | Purchase @endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg-12 col-md-12">
        <!-- Breadcrumb Items -->
        <div class="card custom-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="text-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('events.index') }}">Events</a>
                            </li>
                            <li class="breadcrumb-item">
                                Purchase
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Ticket Purchase Form -->
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 mb-4">
                <form method="POST" action="{{ route('tickets.purchase', $event->id) }}" id="purchase-form">
                    @csrf
                    <div class="card p-3 pricing-card">
                        <div class="card-header text-justified pt-2">
                            <p class="tx-18 font-weight-semibold mb-1">{{ $event->title }}</p>
                            <p class="tx-13 mb-1">{{ $event->description }}</p>
                        </div>
                        <div class="card-body pt-2">
                            <div class="form-group">
                                <label for="ticket_type">Ticket Type</label>
                                <select name="ticket_type" id="ticket_type" class="form-control" required>
                                    <option value="">-- Select a ticket type --</option>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{ $ticketType->id }}" data-price="{{ $ticketType->price }}" data-quantity="{{ $ticketType->quantity }}">
                                            {{ $ticketType->name }} - ${{ number_format($ticketType->price, 2) }} (Available: {{ $ticketType->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                <div id="ticket_type_error" class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1" placeholder="0" required>
                                <div id="quantity_error" class="text-danger">@error('quantity'){{ $message }}@enderror</div>
                            </div>
                            <div class="form-group">
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control">
                                    <!-- Stripe Element will be inserted here. -->
                                </div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <button id="card-button" class="btn btn-primary">Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function() {
        // --
        // Setup stripe
        var stripe = Stripe('{{ config("stripe.key") }}'),
            elements = stripe.elements(),
            card = elements.create('card');

        card.mount('#card-element');

        // --
        // Validate form
        $('#purchase-form').validate({
            rules: {
                ticket_type: {
                    required: true
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 1
                }
            },
            messages: {
                ticket_type: {
                    required: "Please select a ticket type"
                },
                quantity: {
                    required: "Please enter a quantity",
                    number: "Please enter a valid number",
                    min: "Quantity must be at least 1"
                }
            },
            errorPlacement: function(error, element) {
                var name = element.attr('name');
                error.appendTo($('#' + name + '_error'));
            },
            submitHandler: function(form) {
                var ticketTypeId = $('#ticket_type').val(),
                    ticketTypeQuantity = $('#ticket_type option:selected').data('quantity'),
                    quantity = $('#quantity').val(),
                    ticketPrice = $('#ticket_type option:selected').data('price');

                // --
                // Check validations
                if (quantity > ticketTypeQuantity) {
                    showToast("The quantity exceeds available tickets.", "error");
                    return false;
                }

                var amount = ticketPrice * quantity,
                    minimumAmount = 0.50; // Minimum amount in dollars

                if (amount < minimumAmount) {
                    showToast("The amount must be at least $0.50.", "error");
                    return false;
                }

                // --
                // Handle payment
                $.ajax({
                    url: '{{ route("tickets.createPaymentIntent", ["event" => $event->id]) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        amount: amount,
                        ticket_type_id: ticketTypeId,
                        quantity: quantity
                    },
                    success: function(response) {
                        var clientSecret = response.client_secret;
                        stripe.createPaymentMethod({
                            type: 'card',
                            card: card,
                            billing_details: {
                                name: '{{ Auth::user()->name }}',
                            },
                        }).then(function(result) {
                            $('#card-button').attr('disabled', true);
                            if (result.error) {
                                $('#card-button').attr('disabled', false);
                                $('#card-errors').text(result.error.message);
                            } else {
                                stripe.confirmCardPayment(clientSecret, {
                                    payment_method: result.paymentMethod.id,
                                }).then(function(result) {
                                    if (result.error) {
                                        $('#card-button').attr('disabled', false);
                                        $('#card-errors').text(result.error.message);
                                    } else {
                                        if (result.paymentIntent.status === 'succeeded') {
                                            $.ajax({
                                                url: '{{ route("tickets.purchase", $event->id) }}',
                                                method: 'POST',
                                                data: {
                                                    _token: '{{ csrf_token() }}',
                                                    ticket_type_id: ticketTypeId,
                                                    quantity: quantity,
                                                    payment_intent_id: result.paymentIntent.id,
                                                },
                                                success: function(response) {
                                                    $('#card-button').attr('disabled', false);
                                                    if (response.success) {
                                                        showToast(response.message, 'success');
                                                        window.location.href = '{{ route("events.index") }}';
                                                    } else {
                                                        showToast("Error processing your request. Please try again.", 'error');
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
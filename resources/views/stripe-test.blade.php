<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago de Suscripción - Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f8f8; color: #222; }
        .container { max-width: 400px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem; }
        h2 { color: #f1c40f; text-align: center; }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; margin-bottom: .5rem; }
        #card-element { background: #f1f1f1; padding: .75rem; border-radius: 6px; }
        .btn { background: #f1c40f; color: #222; border: none; padding: .7rem 1.2rem; border-radius: 30px; font-weight: bold; cursor: pointer; width: 100%; }
        .alert { margin-bottom: 1rem; padding: .7rem; border-radius: 6px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Suscripción 1 mes - $100 MXN</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        <form id="payment-form" method="POST" action="{{ route('stripe.pay') }}">
            @csrf
            <div class="form-group">
                <label for="card-element">Tarjeta de crédito o débito</label>
                <div id="card-element"></div>
            </div>
            <button class="btn" id="submit">Pagar $100 MXN</button>
        </form>
        <div id="card-errors" role="alert"></div>
    </div>
    <script>
        const stripe = Stripe("{{ $stripeKey }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            const {token, error} = await stripe.createToken(card);
            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</body>
</html>

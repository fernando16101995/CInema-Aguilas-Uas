<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción Cinema Águilas</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <style>
        body {
            background: #232635;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stripe-container {
            width: 80vw;
            max-width: 800px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.15);
            padding: 3rem 2rem;
            text-align: center;
            margin: auto;
        }
        .stripe-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #232635;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #232635;
            text-align: left;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
        .btn-stripe {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.1rem;
            border-radius: 8px;
            background: #e50914;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-stripe:hover {
            background: #b0060f;
        }
    </style>
</head>
<body>
    <div class="stripe-container">
        <h2 class="stripe-title">Suscríbete a <strong>Cinema Águilas</strong></h2>
        <form action="{{ route('stripe.pay') }}" method="POST">
            @csrf
            <label for="card-holder-name" class="form-label">Nombre del titular</label>
            <input type="text" name="card_holder_name" id="card-holder-name" class="form-control" required>
            <button type="submit" class="btn-stripe" style="margin-bottom: 1rem;">Pagar $9.90 USD</button>
        </form>
        <div style="margin-top: 1rem;">
            <a href="{{ route('logout') }}" style="color: #232635; text-decoration: underline; font-size: 1rem; font-weight: 500;"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo - Cinema Águilas UAS</title>
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body>
    <header class="catalog-header">
        <div class="container">
            <h1>Catálogo de películas</h1>
            <p>Explora nuestra selección</p>
        </div>
    </header>

    <main class="container catalog-grid">
        @for ($i = 1; $i <= 12; $i++)
            <article class="card">
                <div class="card-thumb" style="background-image: url('/images/placeholder-300x450.png')"></div>
                <div class="card-body">
                    <h3 class="card-title">Película Ejemplo #{{ $i }}</h3>
                    <p class="card-meta">2024 · Acción · 2h 10m</p>
                    <p class="card-desc">Una breve descripción de la película. Emocionante, épica y para toda la familia.</p>
                    <div class="card-actions">
                        <a href="#" class="btn btn-primary">Ver detalles</a>
                        <a href="#" class="btn btn-secondary">Ver tráiler</a>
                    </div>
                </div>
            </article>
        @endfor
    </main>
</body>
</html>
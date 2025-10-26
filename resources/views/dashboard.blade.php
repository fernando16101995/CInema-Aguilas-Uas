<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinemas Aguilas Uas - Home</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <header class="header">
        <div class="logo">Cinemas<span>AguilasUas</span></div>
        <nav>
            <ul class="menu">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Series</a></li>
                <li><a href="#">Películas</a></li>
                <li><a href="#">Favoritos</a></li>
            </ul>
        </nav>
        <div class="user-options">
            <a href="#" class="btn">Mi perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Descubre, mira y disfruta</h1>
            <p>Tu plataforma de entretenimiento dorado y azul</p>
            <a href="#" class="btn-primary">Explorar ahora</a>
        </div>
    </section>

    <main class="content">
        <h2>Películas populares</h2>
        <div class="movie-grid">
            @for ($i = 1; $i <= 6; $i++)
                <div class="movie-card">
                    <img src="https://picsum.photos/300/450?random={{ $i }}" alt="Pelicula {{ $i }}">
                    <div class="overlay">
                        <h3>Pelicula {{ $i }}</h3>
                        <button class="btn-watch">Ver ahora</button>
                    </div>
                </div>
            @endfor
        </div>
    </main>

    <footer>
        <p>© 2025 Cinemas Aguilas Uas | Universidad Autónoma de Sinaloa</p>
    </footer>

</body>
</html>

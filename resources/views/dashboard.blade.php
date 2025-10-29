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
                <li><a href="#lo-nuevo">Lo Nuevo</a></li>
                <li><a href="#accion">Acción</a></li>
                <li><a href="#terror">Terror</a></li>
                <li><a href="#comedia">Comedia</a></li>
                <li><a href="#drama">Drama</a></li>
                <li><a href="#scifi">Ciencia Ficción</a></li>
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



    <main class="content">
        <!-- Lo Nuevo -->
    <section class="movie-section" id="lo-nuevo">
            <h2 class="section-title">Lo Nuevo</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=nuevo{{ $i }}" alt="Película Nueva {{ $i }}">
                            <div class="movie-info">
                                <h3>Nueva Película {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Acción -->
    <section class="movie-section" id="accion">
            <h2 class="section-title">Acción</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=accion{{ $i }}" alt="Película de Acción {{ $i }}">
                            <div class="movie-info">
                                <h3>Acción Extrema {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Terror -->
    <section class="movie-section" id="terror">
            <h2 class="section-title">Terror</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=terror{{ $i }}" alt="Película de Terror {{ $i }}">
                            <div class="movie-info">
                                <h3>Pesadilla {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Comedia -->
    <section class="movie-section" id="comedia">
            <h2 class="section-title">Comedia</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=comedia{{ $i }}" alt="Película de Comedia {{ $i }}">
                            <div class="movie-info">
                                <h3>Risas Garantizadas {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Drama -->
    <section class="movie-section" id="drama">
            <h2 class="section-title">Drama</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=drama{{ $i }}" alt="Película de Drama {{ $i }}">
                            <div class="movie-info">
                                <h3>Drama Intenso {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Ciencia Ficción -->
    <section class="movie-section" id="scifi">
            <h2 class="section-title">Ciencia Ficción</h2>
            <div class="movie-carousel">
                <div class="movie-scroll">
                    @for ($i = 1; $i <= 8; $i++)
                        <div class="movie-card">
                            <img src="https://picsum.photos/300/450?random=scifi{{ $i }}" alt="Película de Ciencia Ficción {{ $i }}">
                            <div class="movie-info">
                                <h3>Futuro Digital {{ $i }}</h3>
                                <div class="movie-actions">
                                    <button class="btn-play">▶ Reproducir</button>
                                    <button class="btn-info">+ Mi Lista</button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 Cinemas Aguilas Uas | Universidad Autónoma de Sinaloa</p>
    </footer>

    <script>
        // Scroll suave al hacer clic en el menú
        document.querySelectorAll('.menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 90,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
        // Mejora de la experiencia de scroll en los carruseles
        document.querySelectorAll('.movie-scroll').forEach(carousel => {
            let isDown = false;
            let startX;
            let scrollLeft;

            carousel.addEventListener('mousedown', (e) => {
                isDown = true;
                carousel.classList.add('active');
                startX = e.pageX - carousel.offsetLeft;
                scrollLeft = carousel.scrollLeft;
            });

            carousel.addEventListener('mouseleave', () => {
                isDown = false;
                carousel.classList.remove('active');
            });

            carousel.addEventListener('mouseup', () => {
                isDown = false;
                carousel.classList.remove('active');
            });

            carousel.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - carousel.offsetLeft;
                const walk = (x - startX) * 2;
                carousel.scrollLeft = scrollLeft - walk;
            });
        });

        // Animaciones suaves al hacer hover en las cards
        document.querySelectorAll('.movie-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.boxShadow = '0 20px 40px rgba(255, 215, 0, 0.3)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.boxShadow = 'none';
            });
        });
    </script>

</body>
</html>

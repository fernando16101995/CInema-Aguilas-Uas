<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinemas Aguilas Uas - Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!-- Secciones dinámicas por género -->
        @php
            // Obtener todos los géneros únicos, aunque estén en campos con múltiples géneros separados por coma
            $allGenres = collect();
            foreach ($peliculas as $pelicula) {
                $genres = array_map('trim', explode(',', $pelicula->genre));
                foreach ($genres as $g) {
                    $allGenres->push($g);
                }
            }
            $uniqueGenres = $allGenres->unique()->sort();
        @endphp

    
        @if ($peliculasSeguirViendo->count() > 0)
            <section class="movie-section" id="seguir-viendo">
                <h2 class="section-title">Seguir Viendo</h2>
                <div class="movie-carousel">
                    <div class="movie-scroll">
                        
                        @foreach ($peliculasSeguirViendo as $pelicula)
                            <div class="movie-card">
                                <a href="#" onclick="openMovieTab('{{ addslashes(json_encode($pelicula)) }}')">
                                    <img src="{{ $pelicula->poster_url }}" alt="{{ $pelicula->title }}">
                                </a>
                                <div class="movie-info">
                                    <h3>{{ $pelicula->title }}</h3>
                                    <p style="font-size:0.9rem; margin-bottom:0.5rem;">{{ $pelicula->genre }} · {{ $pelicula->duration_minutes }} min</p>
                                    <div class="movie-actions">
                                      <a href="javascript:void(0)" 
                                               class="btn-play" 
                                               onclick="logView({{ $pelicula->id }}, '{{ $pelicula->video_url }}')">
                                               ▶ Reproducir
                                            </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
        @endif

            @foreach ($uniqueGenres as $genero)
            <section class="movie-section" id="{{ Str::slug($genero) }}">
                <h2 class="section-title">{{ $genero }}</h2>
                <div class="movie-carousel">
                    <div class="movie-scroll">
                        @foreach ($peliculas as $pelicula)
                            @php
                                $genres = array_map('trim', explode(',', $pelicula->genre));
                            @endphp
                            @if (in_array($genero, $genres))
                                <div class="movie-card">
                                    <a href="#" onclick="openMovieTab('{{ addslashes(json_encode($pelicula)) }}')">
                                        <img src="{{ $pelicula->poster_url }}" alt="{{ $pelicula->title }}">
                                    </a>
                                    <div class="movie-info">
                                        <h3>{{ $pelicula->title }}</h3>
                                        <p style="font-size:0.9rem; margin-bottom:0.5rem;">{{ $pelicula->genre }} · {{ $pelicula->duration_minutes }} min</p>
                                        <div class="movie-actions">
                                            <a href="javascript:void(0)" 
                                           class="btn-play" 
                                           onclick="logView({{ $pelicula->id }}, '{{ $pelicula->video_url }}')">
                                           ▶ Reproducir
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
           @endforeach
    </main>

    <footer>
        <p>© 2025 Cinemas Aguilas Uas | Universidad Autónoma de Sinaloa</p>
    </footer>

    <script>
    function openMovieTab(peliculaJson) {
        const pelicula = JSON.parse(peliculaJson);
        const win = window.open('', '_blank');
       
        win.document.write(`
            <html lang="es">
            <head>
                <title>${pelicula.title}</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    body { font-family: 'Poppins', sans-serif; background: #001F3F; color: #fff; margin: 0; padding: 0; }
                    .container { max-width: 600px; margin: 40px auto; background: #012040; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.3); padding: 2rem; }
                    img { width: 100%; border-radius: 8px; margin-bottom: 1.5rem; }
                    h1 { color: #FFD700; margin-bottom: 1rem; }
                    .meta { color: #FFD700; margin-bottom: 1rem; }
                    .desc { margin-bottom: 2rem; }
                    .btn-play { background: #FFD700; color: #001F3F; padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 1.1rem; display: inline-block; }
                    .btn-play:hover { background: #fff; color: #001F3F; }
                    .btn-back { background: #4b5563; color: #fff; padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 1.1rem; display: inline-block; margin-top: 1.5rem; border: none; cursor: pointer; }
                    .btn-back:hover { background: #FFD700; color: #001F3F; }
                </style>
                <script>
                        function clickReproducir() {
                            // 1. Llama a la función 'logView' de la ventana "madre" (el dashboard)
                            if (window.opener && window.opener.logView) {
                                // Llama a la función, pero pasa 'null' como URL
                                window.opener.logView(${pelicula.id}, null); 
                            }
                            
                            // 2. Redirige la pestaña actual al video
                            window.location.href = "${pelicula.video_url}";
                        }
                    <\/script>
            </head>
            <body>
                <div class="container">
                    <img src="${pelicula.poster_url}" alt="${pelicula.title}">
                    <h1>${pelicula.title}</h1>
                    <div class="meta">${pelicula.genre} · ${pelicula.duration_minutes} min</div>
                    <div class="desc">${pelicula.description}</div>
                 
                   <a href="javascript:void(0)" class="btn-play" onclick="clickReproducir()">▶ Reproducir</a>
                     
                    <button class="btn-back" onclick="window.close()">Volver al dashboard</button>
                </div>
            </body>
            </html>+
        `);
        win.document.close();
    }
    </script>

    <script>
    function logView(peliculaId, videoUrl) {
        
        // 1. Abre la nueva pestaña
       
        window.open(videoUrl, '_blank');

        // 2. Busca el token
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // 3. Si no hay token, no podemos guardar, pero la pestaña ya se abrió
        if (!token) {
            console.error('¡Error de CSRF! No se encontró la meta-etiqueta.');
            return false; // Detiene el script
        }
        
        const data = { pelicula_id: peliculaId };

        // 4. Envía la petición (Fetch) en segundo plano
     
        fetch("{{ route('playback.log') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data),
            keepalive: true 
        })
        .then(response => {
          
            if (!response.ok) {
                console.error('Error al guardar historial: ' + response.status);
                throw new Error('Fallo del servidor: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Historial guardado para pelicula ID:', peliculaId);
            } else {
                console.error('Error de lógica al guardar historial:', data.error);
            }
        })
        .catch(error => {
            console.error('Error de red al guardar historial:', error);
        });
        
        // 5. Devolvemos 'false' para PREVENIR que el <a>
        return false;
    }
    </script>

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

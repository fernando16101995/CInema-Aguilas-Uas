<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Películas</title>
    
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
</head>
<body style="background-color: #111827;"> 
    <nav class="admin-sidebar">
        <h2>Admin Netflix</h2>
        <hr style="border-color: #4b5563; margin: 15px 0;">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.peliculas.index') }}" style="background-color: #e11d48; color: white;">Administrar Películas</a>
        <a href="{{ route('admin.users.index') }}">Administrar Usuarios</a>
        <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit">Cerrar Sesión</button> </form>
    </nav>

    <main class="admin-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="color: white; font-size: 1.8rem; font-weight: bold;">Administrar Películas</h1>
            <a href="javascript:void(0)" onclick="openCreateModal()" class="admin-btn-primary">Añadir Nueva Película</a>
        </div>
        
        <div class="catalog-grid"> 
            @foreach ($peliculas as $pelicula)
                <article class="card"> 
                    <div class="card-thumb" style="background-image: url('{{ $pelicula->poster_url }}')"></div> 
                    <div class="card-body"> 
                        <h3 class="card-title">{{ $pelicula->title }}</h3> 
                        <p class="card-meta">{{ $pelicula->genre }} · {{ $pelicula->duration_minutes }}m</p> 
                        
                        <div class="card-actions-admin"> 
                            <a href="javascript:void(0)" onclick="openEditModal('{{ $pelicula->id }}')" class="admin-btn-secondary">Modificar</a>
                            
                            <form action="{{ route('admin.peliculas.destroy', $pelicula->id) }}" method="POST" onsubmit="return confirm('¿Seguro?');">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="admin-btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div id="edit-modal-container" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
            <div id="modal-content">
                <button onclick="closeModal()" class="close-button">&times;</button>
                <div id="modal-body">Cargando formulario...</div>
            </div>
        </div>
    </main>
<script>
    // Nueva función robusta para aplicar valores y estilos
    function applyInputValues(containerElement) {
        // Busca TODOS los inputs y textareas dentro del contenido cargado.
        const inputElements = containerElement.querySelectorAll('input[data-value], textarea');
        
        inputElements.forEach(input => {
            // Asigna el valor (si es un input que usa data-value)
            if (input.dataset.value) {
                input.value = input.dataset.value;
            }
            
            
        });
    }

    function openEditModal(peliculaId) {
        const modalContainer = document.getElementById('edit-modal-container');
        const modalBody = document.getElementById('modal-body');

        modalContainer.style.display = 'flex';
        modalBody.innerHTML = 'Cargando...';

        fetch(`/admin/peliculas/${peliculaId}/edit`)
            .then(response => {
                if (!response.ok) throw new Error('Respuesta de red no válida');
                return response.text();
            })
            .then(html => {
                // 1. Inserta el HTML del formulario
                modalBody.innerHTML = html;
                document.getElementById('modal-content').querySelector('.close-button').onclick = closeModal;
                
                // 2. Ejecutamos la función de carga DE FORMA EXPLÍCITA sobre el cuerpo del modal.
                applyInputValues(modalBody); 

            })
            .catch(error => {
                modalBody.innerHTML = 'Error al cargar el formulario.';
                console.error('Error al cargar la edición:', error);
            });
    }

    function closeModal() {
        document.getElementById('edit-modal-container').style.display = 'none';
        // Limpiamos el contenido del modal al cerrarse para prevenir IDs duplicados
        document.getElementById('modal-body').innerHTML = 'Cargando formulario...'; 
    }
    // Nueva función para abrir el formulario de CREACIÓN (usa la ruta create)
function openCreateModal() {
    const modalContainer = document.getElementById('edit-modal-container');
    const modalBody = document.getElementById('modal-body');

    modalContainer.style.display = 'flex';
    modalBody.innerHTML = 'Cargando...';

    // La ruta 'admin/peliculas/create' debe devolver el HTML del formulario vacío
    fetch('{{ route('admin.peliculas.create') }}')
        .then(response => {
            if (!response.ok) throw new Error('Respuesta de red no válida: ' + response.status);
            return response.text();
        })
        .then(html => {
            // 1. Inserta el HTML del formulario
            modalBody.innerHTML = html;
            
            // 2. Asegura que el botón de cerrar funcione (usa la clase del botón)
            document.getElementById('modal-content').querySelector('.close-button').onclick = closeModal;
            
            // 3. ¡SOLUCIÓN CLAVE! Ejecutamos la función de carga de valores y estilos.
            // Esto asegura que el texto se vea correctamente y que los valores vacíos se asignen.
            applyInputValues(modalBody); 

        })
        .catch(error => {
            modalBody.innerHTML = `Error al cargar. Revisa los logs. (${error.message})`;
            console.error('Error al cargar la edición:', error);
        });
}
</script>
</body>
</html>
{{-- resources/views/admin/peliculas/editar-pelicula.blade.php --}}

<div class="modal-form-header">
    <h1 style="font-size: 1.5rem; color: white;">Modificar Película: {{ $pelicula->title }}</h1>
    <hr style="border-color: #4b5563; margin: 10px 0;">
</div>

<form id="editForm" action="{{ route('admin.peliculas.update', $pelicula->id) }}" method="POST">
    @csrf
    @method('PUT') 

    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" class="form-control" id="title-input" name="title" 
               data-value="{{ old('title', $pelicula->title) }}" required>
    </div>

    <div class="form-group">
        <label for="description">Descripción / Sinopsis:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $pelicula->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="genre">Género:</label>
        <input type="text" class="form-control" id="genre-input" name="genre" 
               data-value="{{ old('genre', $pelicula->genre) }}">
    </div>

    <div class="form-group">
        <label for="duration_minutes">Duración (minutos):</label>
        <input type="number" class="form-control" id="duration_minutes-input" name="duration_minutes" 
               data-value="{{ old('duration_minutes', $pelicula->duration_minutes) }}">
    </div>

    <div class="form-group">
        <label for="poster_url">URL del Póster:</label>
        <input type="url" class="form-control" id="poster_url-input" name="poster_url" 
               data-value="{{ old('poster_url', $pelicula->poster_url) }}" required>
    </div>
    
    <div class="form-group">
        <label for="video_url">URL del Video:</label>
        <input type="url" class="form-control" id="video_url-input" name="video_url" 
               data-value="{{ old('video_url', $pelicula->video_url) }}">
    </div>
    
    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
        <button type="submit" class="btn-success">Guardar Cambios</button>
        <button type="button" onclick="closeModal()" class="btn-cancel">Cancelar</button>
    </div>
</form>
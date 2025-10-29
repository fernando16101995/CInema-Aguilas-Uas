<form id="peliculaForm" action="" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" class="form-control" id="title-input" name="title" 
               data-value="" required>
    </div>

    <div class="form-group">
        <label for="description">Descripción / Sinopsis:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
    </div>

    <div class="form-group">
        <label for="genre">Género:</label>
        <input type="text" class="form-control" id="genre-input" name="genre" 
               data-value="">
    </div>

    <div class="form-group">
        <label for="duration_minutes">Duración (minutos):</label>
        <input type="number" class="form-control" id="duration_minutes-input" name="duration_minutes" 
               data-value="">
    </div>

    <div class="form-group">
        <label for="poster_url">URL del Póster:</label>
        <input type="url" class="form-control" id="poster_url-input" name="poster_url" 
               data-value="" required>
    </div>
    
    <div class="form-group">
        <label for="video_url">URL del Video:</label>
        <input type="url" class="form-control" id="video_url-input" name="video_url" 
               data-value="">
    </div>
    
    <div style="margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;">
        <button type="submit" class="btn-success">Guardar</button>
        <button type="button" onclick="closeModal()" class="btn-cancel">Cancelar</button>
    </div>
</form>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Perfil</title>
    
    @vite('resources/css/app.css')
    
    </head>
<body> <div class="form-container">
        <h1>Añadir Perfil</h1>
        <p>Añade un perfil para otra persona que vea Netflix.</p>
        <hr style="border-color: #4b5563; margin: 20px 0;">

        <form action="{{ route('profiles.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nombre_perfil">Nombre:</label>
                <input type="text" id="nombre_perfil" name="nombre_perfil" required>
            </div>

            <div class="form-group">
    <label>Elige un avatar:</label>

    <div class="avatar-grid">
        @foreach ($avatars as $index => $avatarUrl)
            <label class="avatar-option">
                <input type="radio" name="avatar_url" value="{{ $avatarUrl }}" 
                       {{ $index == 0 ? 'checked' : '' }}>

                <img src="{{ $avatarUrl }}" alt="Avatar {{ $index + 1 }}">
            </label>
        @endforeach
    </div>
</div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="es_niño" value="1">
                    ¿Es un perfil infantil?
                </label>
            </div>
            
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('profiles.index') }}" style="margin-left: 10px; color: #9ca3af;">Cancelar</a>
        </form>
    </div>
</body>
</html>
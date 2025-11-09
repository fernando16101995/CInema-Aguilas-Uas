<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién está viendo?</title>
    
    @vite('resources/css/app.css')
    
    </head>
<body> <div class="profile-container">
        <h1 style="font-size: 2.5rem; margin-bottom: 30px;">¿Quién está viendo?</h1>
        
        <div class="profile-grid">
            
            @foreach ($profiles as $profile)
                <div class="profile-card">
                     <a href="{{ route('profiles.select', $profile->id) }}">
                     <img src="{{ $profile->avatar_url }}" alt="{{ $profile->nombre_perfil }}">
                     <p class="profile-name">{{ $profile->nombre_perfil }}</p>
                    </a>
                </div>
            @endforeach
            
            <div class="profile-card add-profile">
                <a href="{{ route('profiles.create') }}">
                    <div class="add-profile-box">
                        <span>+</span>
                    </div>
                    <p class="profile-name">Añadir Perfil</p>
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>
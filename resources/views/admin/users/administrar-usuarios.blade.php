<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    
    @vite('resources/css/app.css') <style>
        .user-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .user-table th, .user-table td { border: 1px solid #4b5563; padding: 12px; text-align: left; }
        .user-table th { background-color: #374151; }
        .user-table tr:nth-child(even) { background-color: #1f2937; }
        .user-table .actions { display: flex; gap: 10px; }
        /* Clases para botones reutilizadas de la vista de películas */
        .admin-btn-secondary { background-color: #4b5563; color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; border: none; cursor: pointer; }
        .admin-btn-danger { background-color: #b91c1c; color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; border: none; cursor: pointer; }
    </style>
</head>
<body style="background-color: #111827;">

    <nav class="admin-sidebar">
        <h2>Admin Netflix</h2>
        <hr style="border-color: #4b5563; margin: 15px 0;">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.peliculas.index') }}">Administrar Películas</a>
        <a href="{{ route('admin.users.index') }}" style="background-color: #e11d48; color: white;">Administrar Usuarios</a>
        <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit">Cerrar Sesión</button> </form>
    </nav>

    <main class="admin-content">
        <h1 style="color: white; font-size: 1.8rem; font-weight: bold;">Administrar Usuarios</h1>

        @if (session('success'))
            <div style="background-color: #10B981; color: white; padding: 10px; border-radius: 5px; margin-top: 15px;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="background-color: #EF4444; color: white; padding: 10px; border-radius: 5px; margin-top: 15px;">{{ session('error') }}</div>
        @endif

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role == 'admin' ? 'Administrador' : 'Usuario' }}</td>
                        <td class="actions">
                            <form action="{{ route('admin.users.toggleAdmin', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH') <button type="submit" class="admin-btn-secondary">
                                    {{ $user->role == 'admin' ? 'Quitar Admin' : 'Hacer Admin' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');">
                                @csrf
                                @method('DELETE') <button type="submit" class="admin-btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
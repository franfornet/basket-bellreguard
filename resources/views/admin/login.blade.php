<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - CB Bellreguard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #C8102E 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: white;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .login-box h2 {
            font-weight: 900;
            text-transform: uppercase;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .login-box p {
            color: #aaa;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        .btn-login {
            background: #C8102E;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 6px;
            font-size: 1rem;
        }
        .btn-login:hover { background: #a00d24; color: white; }
        .form-control:focus { border-color: #C8102E; box-shadow: 0 0 0 0.2rem rgba(200,16,46,0.25); }
        .volver { color: #aaa; text-decoration: none; font-size: 0.85rem; }
        .volver:hover { color: #C8102E; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="text-center mb-4">
            <span style="font-size:2.5rem;">🏀</span>
        </div>
        <h2>Panel Admin</h2>
        <p>CB Bellreguard · Acceso restringido</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control"
                       placeholder="admin@cbbellreguard.es" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-login">Entrar</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('inicio') }}" class="volver">← Volver a la web</a>
        </div>
    </div>
</body>
</html>
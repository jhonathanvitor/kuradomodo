{{-- resources/views/admin/login/index.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Painel Administrativo</title>
    <link rel="icon" href="{{ asset('img/home/ICON-KURADOMODO.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-user-shield fa-3x"></i>
            <h2>Painel Administrativo</h2>
            <p>Faça login para acessar o sistema</p>
        </div>

        {{-- Mensagens de sucesso --}}
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensagens de erro --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            {{-- Campo Email --}}
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Digite seu email" required>
                <label for="email">
                    <i class="fas fa-envelope me-2"></i>Email
                </label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Campo Senha --}}
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Digite sua senha" required>
                <label for="password">
                    <i class="fas fa-lock me-2"></i>Senha
                </label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Lembrar de mim --}}
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Lembrar de mim
                </label>
            </div>

            {{-- Botão de login --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Entrar
                </button>
            </div>
        </form>

        {{-- Link para voltar ao site --}}
        <div class="back-to-site">
            <a href="{{ url('/') }}">
                <i class="fas fa-arrow-left me-2"></i>
                Voltar ao site
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Adiciona estado de loading ao botão durante o submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Entrando...';
        });

        // Adiciona animação de foco nos campos
        document.querySelectorAll('.form-control').forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Remove mensagens de erro após 5 segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>

</html>

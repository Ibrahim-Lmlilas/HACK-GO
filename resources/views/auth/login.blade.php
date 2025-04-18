<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HACK&GO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #9370db;
            --secondary-color: #8a2be2;
            --text-color: #333;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            color: var(--text-color);
        }

        .auth-container {
            display: flex;
            height: 100vh;
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, var(--secondary-color), #9370db);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        .right-panel {
            flex: 1;
            background-color: white;
            padding: 2rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }

        .auth-form {
            max-width: 450px;
            margin: 0 auto;
            width: 100%;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(147, 112, 219, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #8a2be2;
            border-color: #8a2be2;
        }

        .btn-outline-secondary {
            border-color: #ddd;
            color: #666;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .icon-container {
            width: 120px;
            height: 120px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-link {
            color: var(--primary-color);
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
            color: #8a2be2;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                padding: 1.5rem;
            }
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="left-panel">

            <div class="icon-container">
                <i class="fas fa-plane-departure fa-4x" style="opacity: 0.9;"></i>
            </div>
            <h2>Welcome back to HACK&GO</h2>
            <p class="mt-3">Sign in to access your account, manage your bookings, and continue exploring amazing destinations.</p>
        </div>

        <div class="right-panel">

            <div class="auth-form">
                <a href="{{ url('/') }}" class="me-3" style="color: var(--primary-color);">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="text-center mb-4 d-flex align-items-center justify-content-center">
                    <span class="logo">HACK&GO</span>
                </div>

                <h1 class="form-title">Sign in</h1>
                <p class="mb-4">Don't have an account? <a href="{{ route('register') }}" class="auth-link">Create an account</a></p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            Sign in
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mb-4">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

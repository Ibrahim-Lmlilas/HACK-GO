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

        .social-btn {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            background-color: white;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .social-btn:hover {
            background-color: #f8f9fa;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #777;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider span {
            padding: 0 1rem;
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
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="left-panel">
            <div class="icon-container">
                <i class="fas fa-plane-departure fa-4x" style="opacity: 0.9;"></i>
            </div>
            <h2>Start your journey with HACK&GO</h2>
            <p class="mt-3">Create an account to plan your trips, manage bookings, and discover amazing destinations around the world.</p>
        </div>

        <div class="right-panel">
            <div class="auth-form">
                <a href="{{ url('/') }}" class="me-3" style="color: var(--primary-color);">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="text-center  d-flex align-items-center justify-content-center">
                    <span class="logo">HACK&GO</span>
                </div>

                <h1 class="form-title">Create your account</h1>
                <p class="mb-3">Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in</a></p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First name</label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="John">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last name</label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" placeholder="Doe">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••">
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
                        <label for="password-confirm" class="form-label">Confirm password</label>
                        <div class="input-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="••••••">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Update the terms checkbox section -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal" class="auth-link">terms of service</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal" class="auth-link">privacy policy</a>
                            </label>
                        </div>
                    </div>

                    <!-- Add this at the end of the file, just before the closing </body> tag -->
                    @include('legal.modals')

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100">
                            Create account
                        </button>
                    </div>
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

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password-confirm');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    <!-- Add this before the closing </body> tag, after your existing scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

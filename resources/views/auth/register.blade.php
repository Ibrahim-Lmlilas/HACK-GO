


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Authentication</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .auth-container {
            max-width: 700px;
            width: 90%;
            margin: 0 auto;
        }
        .auth-form {
            background-color: rgba(75, 75, 75, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.memphistours.com/large/768915513_Golden%20hour%20at%20centered%20Bab%20al%20mansour%20gate%20in%20the%20old%20town%20medina%20of%20Meknes,%20Morocco.%20Horizontal.jpg');">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="auth-container relative z-10">

<div class="auth-form rounded-lg p-8 shadow-lg" style="max-width: 800px; width: 100%;">
    <div class="text-center mb-6">
        <div class="bg-gray-800/50 py-2 px-4 rounded-full mb-4 inline-block">
            <p class="text-white uppercase tracking-wider text-xs">Create your account</p>
        </div>

    </div>

    @if ($errors->any())
        <!-- Error display remains unchanged -->
    @endif

    <form class="space-y-4" action="{{ route('register') }}" method="POST">
        @csrf
        <!-- Changed to 2 inputs per row -->
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="first_name" class="block text-xs font-medium text-white/90 mb-1">First Name</label>
                    <input id="first_name" name="first_name" type="text" autocomplete="given-name" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="First name" value="{{ old('first_name') }}">
                </div>
                <div>
                    <label for="last_name" class="block text-xs font-medium text-white/90 mb-1">Last Name</label>
                    <input id="last_name" name="last_name" type="text" autocomplete="family-name" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Last name" value="{{ old('last_name') }}">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="username" class="block text-xs font-medium text-white/90 mb-1">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Username" value="{{ old('username') }}">
                </div>
                <div>
                    <label for="email" class="block text-xs font-medium text-white/90 mb-1">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="password" class="block text-xs font-medium text-white/90 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Password">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-white/90 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Confirm password">
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4  text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 border-[#1f2937] border-4">
                <span class="mr-2">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                        <path d="M16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                </span>
                Create Account
            </button>
        </div>

        <div class="text-center">
            <p class="text-xs text-white/80">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-300 ">
                    Sign in instead
                </a>
            </p>
        </div>
    </form>
</div>
        </div>
    </div>
</body>
</html>

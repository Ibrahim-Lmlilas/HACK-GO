
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
            max-width: 400px;
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

<div class="auth-form rounded-lg p-8 shadow-lg">
    <div class="text-center mb-6">
        <div class="bg-gray-800/50 py-2 px-4 rounded-full mb-4 inline-block">
            <p class="text-white uppercase tracking-wider text-xs">WELCOME BACK</p>
        </div>

    </div>

    @if ($errors->any())
        <div class="bg-gray-800/30 border border-red-500/50 rounded-lg p-3 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-4 w-4 text-red-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-xs text-white">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    @endif

    <form class="space-y-4" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-xs font-medium text-white/90 mb-1">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Enter your email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password" class="block text-xs font-medium text-white/90 mb-1">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-2 border border-white/30 bg-white/10 placeholder-white/60 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 backdrop-blur-sm text-sm" placeholder="Enter your password">
        </div>

        <div class="text-center">
            <p class="text-xs text-white/80">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors duration-300">
                    Sign up now
                </a>
            </p>
        </div>

        <div>
            <button type="submit" class=" border-[#1f2937] border-4 w-full flex justify-center py-2 px-4  text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300">
                Sign in
            </button>
        </div>
    </form>
</div>
        </div>
    </div>
</body>
</html>

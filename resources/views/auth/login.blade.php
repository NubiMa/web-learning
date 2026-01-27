{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - CodeLearn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">
    <a href="{{ route('home') }}"
        class="absolute top-4 left-4 flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white/80 backdrop-blur-sm rounded-lg hover:bg-white hover:text-gray-900 transition-all duration-200 border border-gray-200/60 shadow-sm hover:shadow-md group">
        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Back to Home
    </a>
    <!-- Navigation -->
    {{-- <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-900">CodeLearn</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Courses</a>
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Community</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Sign Up</a>
                </div>
            </div>
        </div>
    </nav> --}}

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <p class="font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Login</h2>
                    <p class="mt-2 text-gray-600">Welcome back! Please enter your details.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus placeholder="Enter your email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                placeholder="Enter your password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-lg shadow-lg hover:shadow-xl">
                        Login
                    </button>
                </form>

                <!-- Register Link -->
                <p class="mt-6 text-center text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">Register</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>

</html>

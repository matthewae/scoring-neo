<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Scoring Dokumen Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(135deg, #06B6D4, #6366F1, #A855F7);
        }
        .login-container {
            position: relative;
            z-index: 2;
        }
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .btn-login {
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    <div class="min-h-screen flex items-stretch login-container">
        <!-- Logo Section -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center p-12 relative z-10">
            <div class="text-center transform transition-all duration-500 hover:scale-105">
                <div class="flex justify-center items-center gap-6 mb-6">
                    <img src="/images/logo fix2.png" alt="Logo Fix" class="w-40 h-auto animate-fade-in">
                    <img src="/images/adbang.png" alt="Logo Adbang" class="w-60 h-auto animate-fade-in">
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Scoring Dokumen Konstruksi</h1>
                <p class="text-white/90">Inovasi Menuju Konsultan Konstruksi Terkemuka</p>
            </div>
        </div>
        
        <!-- Login Form Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="bg-white/80 backdrop-blur-md p-8 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] w-full max-w-md transform transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_20px_40px_rgba(0,0,0,0.12)]">
                <div class="md:hidden text-center mb-8">
                    <img src="/images/logo.svg" alt="Logo" class="w-40 h-auto mx-auto mb-4 transform transition-all duration-500 hover:scale-105 animate-fade-in">
                    <h1 class="text-2xl font-bold text-gray-800">Scoring Dokumen Konstruksi</h1>
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-6">
                    <div class="relative">
                        <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Your Username</label>
                        <input type="text" name="username" id="username" class="form-input shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your username" required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" class="form-input shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 pr-10 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Enter your password" required>
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-login w-full bg-gradient-to-r from-cyan-500 via-indigo-500 to-purple-500 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline hover:from-cyan-600 hover:via-indigo-600 hover:to-purple-600 shadow-lg hover:shadow-xl transition-all duration-300">
                            SIGN IN
                        </button>
                    </div>

                    <div class="text-center mt-6">
                        <span class="text-gray-600">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="ml-1 font-semibold text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                            Register here
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/particles-config.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof particlesJS !== 'undefined') {
                particlesJS.load('particles-js', '/js/particles-config.js', function() {
                    console.log('particles.js loaded - callback');
                });
            }

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.querySelector('i').classList.toggle('bi-eye');
                this.querySelector('i').classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Scoring Dokumen Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(135deg, #1E40AF, #3730A3, #4C1D95);
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .login-container {
            position: relative;
            z-index: 2;
        }
        .form-input {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input:focus {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }
        .btn-login {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #1E40AF, #3730A3);
        }
        .btn-login:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .btn-login:hover:before {
            left: 100%;
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-fade-in {
            animation: fade-in 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(30, 64, 175, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(30, 64, 175, 0.35);
            border-color: rgba(255, 255, 255, 0.4);
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
                    <img src="/images/logo fix2.png" alt="Logo" class="w-40 h-auto animate-fade-in">
                    <img src="/images/adbang.png" alt="Logo Adbang" class="w-60 h-auto animate-fade-in">
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Scoring Dokumen Konstruksi</h1>
                <p class="text-white/90">Inovasi Menuju Konsultan Konstruksi Terkemuka</p>
            </div>
        </div>
        
        <!-- Register Form Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="glass-card p-8 rounded-xl w-full max-w-md">
                <div class="md:hidden text-center mb-8">
                    <img src="/images/logo.svg" alt="Logo" class="w-40 h-auto mx-auto mb-4 transform transition-all duration-500 hover:scale-105 animate-fade-in">
                    <h1 class="text-2xl font-bold text-gray-800">Scoring Dokumen Konstruksi</h1>
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center text-gray-900">Create Your Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="username" class="block text-gray-800 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" class="form-input shadow appearance-none border rounded w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old('username') }}" required>
                    @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-800 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="form-input shadow appearance-none border rounded w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-800 text-sm font-bold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input shadow appearance-none border rounded w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="btn-login bg-gradient-to-r from-cyan-500 via-indigo-500 to-purple-500 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline hover:from-cyan-600 hover:via-indigo-600 hover:to-purple-600 shadow-lg hover:shadow-xl transition-all duration-300">
                        Register
                    </button>
                    <a href="{{ route('login') }}" class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                        Sudah punya akun?
                    </a>
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
        });
    </script>
</body>
</html>

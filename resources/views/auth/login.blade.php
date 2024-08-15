<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your App Name</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center min-h-screen">
    <div class="card w-96 bg-white shadow-2xl rounded-lg overflow-hidden">
        <div class="card-body p-8">
            <h2 class="card-title text-3xl font-bold mb-6 text-center text-gray-800">Welcome Back</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text text-gray-600">Email</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="email@example.com" class="input input-bordered bg-gray-50 focus:bg-white transition-colors duration-200" required>
                </div>
                <div class="form-control mt-4">
                    <label class="label" for="password">
                        <span class="label-text text-gray-600">Password</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="input input-bordered bg-gray-50 focus:bg-white transition-colors duration-200" required>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-2 px-4 rounded-full transition-all duration-200 transform hover:scale-105">
                        Sign In
                    </button>
                </div>
            </form>
            <div class="text-center mt-6">
                <p class="text-gray-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="link link-primary font-semibold hover:underline">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
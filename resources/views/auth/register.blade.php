<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200 flex items-center justify-center min-h-screen">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-4">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-control">
                    <label class="label" for="name">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" id="name" name="name" placeholder="John Doe" class="input input-bordered" required>
                </div>
                <div class="form-control mt-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="email@example.com" class="input input-bordered" required>
                </div>
                <div class="form-control mt-4">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="input input-bordered" required>
                </div>
                <div class="form-control mt-4">
                    <label class="label" for="password_confirmation">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" class="input input-bordered" required>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p>Already have an account? <a href="{{ route('login') }}" class="link link-primary">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
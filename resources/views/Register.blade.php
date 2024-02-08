<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('/img/logo2.png') }}">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Login.css') }}">
</head>

<body>
    <main class="login-form">
            <div class="container">
                <div class="card login-card">
                    <h3 class="card-header">Register</h3>
                    <div class="card-body">
                        <form method="POST" action="/register">
                            @csrf
                            <!-- Name Input -->
                            <div class="form-group">
                                <input type="text" placeholder="Name" id="name" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{ old('name') }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Email Input -->
                            <div class="form-group">
                                <input type="email" placeholder="Email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="form-group">
                                <input type="password" placeholder="Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Submit Button -->
                            <div class="d-grid mx-auto login-btn-container">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <!-- Login Link -->
                        <div class="text-center fs-6">
                            Sudah punya akun? <a href="/login">Login</a><br><br>
                            <a href="/">Kembali ke home</a>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>

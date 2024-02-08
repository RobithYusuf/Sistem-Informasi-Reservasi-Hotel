<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('/img/logo2.png') }}">
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Login.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main class="login-form">
        <div class="container">

            <div class="card login-card">
                <h3 class="card-header">Login</h3>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session()->has('loginError'))
                <div class="alert alert-danger">
                    {{ session('loginError') }}
                </div>
                @endif


                <div class="card-body">
                    <form method="POST" action="/login">
                        @csrf
                        <div class="form-group">
                            <input type="email" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="d-grid mx-auto login-btn-container">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                    <div class="text-center fs-6">
                        Belum punya akun? <a href="/register" style="font-weight: bold;">Buat Akun</a><br><br>
                        <a href="/" style="margin-top: 10px;">Kembali ke home</a>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @if(session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if(session('loginAlert'))
    <script>
        Swal.fire({
            title: 'Perhatian',
            text: "{{ session('loginAlert') }}",
            icon: 'info',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <!-- <script>
    Swal.fire({
        title: 'Test',
        text: 'Ini adalah pesan test.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
</script> -->


    @if(session('authenticatedAlert'))
    <script>
        Swal.fire({
            title: 'Perhatian',
            text: "{{ session('authenticatedAlert') }}",
            icon: 'info',
            confirmButtonText: 'OK'
        });
    </script>
    @endif



</body>

</html>

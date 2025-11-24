<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login - Irrigation Department</title>
    <link rel="icon" type="image/jpg" href="{{ asset('assets/img/avatar/logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
body {
    background: linear-gradient(
                  rgba(0, 64, 32, 0.7), 
                  rgba(0, 100, 0, 0.7)
              ),
              url("{{ asset('assets/login-bg_old.jpg') }}");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
        .form-section {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @media (max-width: 576px) {

}
    </style>
</head>
<body>
<!-- Logo Row -->
<div class="container-fluid mt-4">
    <div class="row justify-content-center text-center">
        <div class="col-12">
            <!-- Centered Logo -->
            <img src="{{ asset('assets/img/avatar/KP-Logo_white.png') }}" alt="KP Logo" class="img-fluid" style="width: 90px;">

            <h4 class="mt-2 fw-bold text-white">E-Abyana</h4>
            <p class="text-light mb-0" style="margin-top:-5px;">Water Billing & Collection System</p>
        </div>
    </div>
</div>

<!-- Login Form -->
<div class="form-section">
    <div class="col-md-4 col-sm-8">
        <div class="login-form p-4 border shadow bg-white" style="border-radius: 15px">
            <h2 class="h4 fw-bold text-center text-success mb-4">Login</h2>
            <form action="{{ url('signin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Enter Email">
                </div>
                <div class="mb-3 position-relative">
    <label for="password" class="form-label">Password</label>
    <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
            <i class="fa fa-eye" id="eyeIcon"></i>
        </span>
    </div>
</div>
              <button type="submit" class="btn btn-success w-100 fw-semibold">Login</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle icon class
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>
            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            @endif
</body>
</html>
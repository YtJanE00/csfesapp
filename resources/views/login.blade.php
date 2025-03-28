<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSFES | Log in</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('style/login/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('style/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/login/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/login/css/iofrm-theme27.css') }}">
    <!-- Logo -->
    <link rel="shortcut icon" href="{{ asset('style/img/cpsulogo.png') }}">

    <style>
        .form-body.without-side .form-content .form-button .ibtn:hover {
            background-color: #198754;
            color: #fff;
            -webkit-box-shadow: 0 0 0 rgba(80, 182, 255, 0.31);
            box-shadow: 0 0 0 rgba(80, 182, 255, 0.31);
            border: 0;
        }
        
        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container input {
            width: 100%;
            padding-right: 40px; /* Space for the eye icon */
        }

        .password-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888888; /* Default eye color */
        }

        .password-container i:hover {
            color: #4CAF50; /* Highlight color on hover */
        }
    </style>
</head>
<body>
    <div class="form-body without-side">
        
        <div class="iofrm-layout">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('style/login/images/graphic8.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="form-icon">
                            <img src="{{ asset('style/img/cpsulogov4.png') }}" alt="Logo" width="35%">
                        </div>
                        <h3 class="form-title-center">CSFES<br>
                            <small style="font-size: 10pt;">Sign in to start session</small>
                        </h3>
                        <form action="{{ route('getLogin') }}" method="post">
                            @csrf

                            @if(session('success'))
                            <div class="alert alert-success" style="font-size: 12pt;">
                                <i class="fas fa-check"></i> {{ session('success') }}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger" style="font-size: 12pt;">
                                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            </div>
                            @endif

                            <input class="form-control" type="email" name="email" placeholder="E-mail Address" required autofocus>
                            <div class="password-container">
                                <input class="form-control" type="password" name="password" placeholder="Password" id="studentPassInput" required>
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn ibtn-full">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('style/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('style/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/login/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('style/login/js/main.js') }}"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('studentPassInput');
    
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
    
            // Change eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
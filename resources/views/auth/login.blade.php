@extends('layouts.auth')

@section('title', 'Login - Gym GenZ Admin')

@section('content')
    <div class="login-form">
        <div class="form-header">
            <div class="logo-container">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h1>Gym GenZ</h1>
        </div>
        <p>Please enter your Login and your Password</p>

        <form method="POST" action="">
            @csrf

            <div class="form-group">
                <span class="input-icon"><i class="fas fa-user"></i></span>
                <input type="text" name="email" class="form-control" placeholder="Username or Email" required>
            </div>

            <div class="form-group position-relative">
                <span class="input-icon"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>

            <a href="#" class="forgot-password">Forgot password?</a>

            <button type="submit" class="btn btn-login">Login</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

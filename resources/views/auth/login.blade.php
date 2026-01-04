<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SHOP Admin || Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #ff6b6b;
            --accent: #7209b7;
            --admin-dark: #1a1a2e;
            --admin-accent: #0d47a1;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --box-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--light);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .login-card {
            display: flex;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            min-height: 680px;
            transition: var(--transition);
        }

        .login-card:hover {
            box-shadow: var(--box-shadow-hover);
        }

        .left-section {
            flex: 1;
            background: linear-gradient(135deg, var(--admin-dark) 0%, var(--admin-accent) 100%);
            color: white;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            top: -100px;
            right: -100px;
        }

        .left-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            bottom: -80px;
            left: -80px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            font-size: 28px;
            font-weight: 700;
            position: relative;
            z-index: 2;
        }

        .logo i {
            margin-right: 12px;
            font-size: 32px;
            color: #4cc9f0;
        }

        .admin-badge {
            background: rgba(76, 201, 240, 0.2);
            color: #4cc9f0;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
            border: 1px solid rgba(76, 201, 240, 0.3);
        }

        .welcome-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .welcome-subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .features {
            margin-top: 40px;
            position: relative;
            z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .feature i {
            background: rgba(255, 255, 255, 0.15);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
            color: #4cc9f0;
        }

        .feature-text {
            font-size: 15px;
            font-weight: 500;
        }

        .right-section {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: var(--gray);
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--admin-dark);
            font-size: 15px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 52px;
            border: 1.5px solid var(--gray-light);
            border-radius: var(--border-radius);
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
            background-color: white;
            position: relative;
            z-index: 1;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.15);
        }

        .form-control.is-invalid {
            border-color: var(--secondary);
        }

        .invalid-feedback {
            color: var(--secondary);
            font-size: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
        }

        .invalid-feedback i {
            margin-right: 6px;
            font-size: 14px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            width: 18px;
            height: 18px;
            accent-color: var(--admin-accent);
        }

        .remember-me label {
            font-size: 15px;
            color: var(--admin-dark);
        }

        .forgot-password {
            color: var(--admin-accent);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(to right, var(--admin-accent), var(--admin-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
        }

        .login-button i {
            margin-right: 10px;
            font-size: 18px;
        }

        .login-button:hover {
            background: linear-gradient(to right, var(--admin-dark), var(--admin-accent));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 71, 161, 0.3);
        }

        .notification {
            position: fixed;
            top: 30px;
            right: 30px;
            padding: 18px 25px;
            border-radius: var(--border-radius);
            background-color: white;
            color: black;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            transform: translateX(150%);
            transition: transform 0.4s ease;
            z-index: 1000;
            max-width: 350px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            border-left: 4px solid #4CAF50;
        }

        .notification.error {
            border-left: 4px solid var(--secondary);
        }

        .notification i {
            font-size: 22px;
            margin-right: 15px;
        }

        .notification.success i {
            color: #4CAF50;
        }

        .notification.error i {
            color: var(--secondary);
        }

        .security-note {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--admin-accent);
            text-align: center;
        }

        .security-note i {
            color: var(--admin-accent);
            margin-right: 8px;
        }

        .security-note span {
            font-size: 14px;
            color: var(--gray);
        }

        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                max-width: 600px;
                margin: 0 auto;
            }

            .left-section,
            .right-section {
                padding: 40px 30px;
            }

            .left-section {
                padding-bottom: 50px;
            }

            .welcome-title {
                font-size: 36px;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .left-section,
            .right-section {
                padding: 30px 20px;
            }

            .welcome-title {
                font-size: 30px;
            }

            .login-title {
                font-size: 28px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        /* Animation for form elements */
        .form-group {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .remember-forgot {
            animation: fadeInUp 0.5s ease 0.3s forwards;
            opacity: 0;
        }

        .login-button {
            animation: fadeInUp 0.5s ease 0.4s forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Shake animation for errors */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-card">
            <!-- Left Section with Admin Branding -->
            <div class="left-section">
                <div class="logo">
                    <i class="fas fa-store"></i>
                    E-SHOP <span class="admin-badge">ADMIN</span>
                </div>
                <h1 class="welcome-title">Admin Dashboard Access</h1>
                <p class="welcome-subtitle">Sign in to manage your store, monitor sales, and control inventory.</p>

                <div class="features">
                    <div class="feature">
                        <i class="fas fa-chart-line"></i>
                        <div class="feature-text">Real-time Analytics & Reports</div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-boxes"></i>
                        <div class="feature-text">Inventory Management System</div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-users-cog"></i>
                        <div class="feature-text">Customer & Order Management</div>
                    </div>
                </div>
            </div>

            <!-- Right Section with Admin Login Form -->
            <div class="right-section">
                <div class="login-header">
                    <h2 class="login-title">Admin Login</h2>
                    <p class="login-subtitle">Restricted access - Authorized personnel only</p>
                </div>

                <!-- Laravel Admin Login Form -->
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">Admin Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user-shield"></i>
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="admin@eshop.com" required
                                autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Admin Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-key"></i>
                            <input type="password"
                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                placeholder="••••••••" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Keep me signed in') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt"></i> {{ __('Access Dashboard') }}
                    </button>
                </form>

                <div class="security-note">
                    <i class="fas fa-shield-alt"></i>
                    <span>For security reasons, please log out after each session</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast (for JavaScript notifications) -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <div class="notification-content">
            <div class="notification-title">Admin Access Granted</div>
            <div class="notification-message">Redirecting to admin dashboard...</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('.login-form');
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.querySelector('input[name="password"]');
            const notification = document.getElementById('notification');

            // If there are validation errors, show them with animation
            const errorFields = document.querySelectorAll('.is-invalid');
            if (errorFields.length > 0) {
                errorFields.forEach(field => {
                    field.style.animation = 'shake 0.5s ease';
                });

                showNotification('Please check your credentials and try again.', 'error');
            }

            // Check if old email exists and add a subtle highlight
            if (emailInput.value) {
                emailInput.style.backgroundColor = 'rgba(13, 71, 161, 0.05)';
                setTimeout(() => {
                    emailInput.style.backgroundColor = '';
                }, 2000);
            }

            // Optional: Add enhanced validation for better UX
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailPattern.test(email)) {
                    this.classList.add('is-invalid');
                }
            });

            passwordInput.addEventListener('blur', function() {
                if (this.value && this.value.length < 8) {
                    this.classList.add('is-invalid');
                }
            });

            // Clear validation on focus
            emailInput.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
            });

            passwordInput.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
            });

            // Form submit enhancement
            loginForm.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;

                // Only show loading animation if form is valid
                if (this.checkValidity()) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
                    submitButton.disabled = true;
                }
            });

            // Show notification function
            function showNotification(message, type) {
                const icon = notification.querySelector('i');
                const title = notification.querySelector('.notification-title');
                const msg = notification.querySelector('.notification-message');

                // Set notification content
                msg.textContent = message;

                // Set notification type
                notification.className = 'notification';
                notification.classList.add(type);

                if (type === 'success') {
                    icon.className = 'fas fa-check-circle';
                    title.textContent = 'Admin Access Granted';
                } else {
                    icon.className = 'fas fa-exclamation-circle';
                    title.textContent = 'Access Denied';
                }

                // Show notification
                notification.classList.add('show');

                // Hide notification after 4 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 4000);
            }

            // Add admin-focused security features
            // Auto logout warning after 5 minutes of inactivity
            let inactivityTimer;

            function resetInactivityTimer() {
                clearTimeout(inactivityTimer);
                inactivityTimer = setTimeout(() => {
                    if (document.querySelector('.login-form')) {
                        showNotification('For security, session will expire due to inactivity.', 'error');
                    }
                }, 300000); // 5 minutes
            }

            // Reset timer on user activity
            document.addEventListener('mousemove', resetInactivityTimer);
            document.addEventListener('keypress', resetInactivityTimer);
            resetInactivityTimer();
        });
    </script>
</body>

</html>

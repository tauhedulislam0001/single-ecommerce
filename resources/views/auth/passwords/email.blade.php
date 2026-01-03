<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SHOP Admin || Forgot Password</title>
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
            --success: #4CAF50;
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

        .forgot-card {
            display: flex;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            min-height: 680px;
            transition: var(--transition);
        }

        .forgot-card:hover {
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

        .forgot-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .forgot-icon {
            font-size: 64px;
            color: var(--admin-accent);
            margin-bottom: 25px;
            position: relative;
            display: inline-block;
        }

        .forgot-icon::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(13, 71, 161, 0.1);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .forgot-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--admin-dark);
            margin-bottom: 15px;
        }

        .forgot-subtitle {
            color: var(--gray);
            font-size: 16px;
            max-width: 400px;
            margin: 0 auto 25px;
            line-height: 1.6;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: var(--border-radius);
            border-left: 4px solid var(--success);
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            animation: slideIn 0.5s ease;
        }

        .alert-success i {
            margin-right: 10px;
            font-size: 18px;
            color: var(--success);
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--admin-dark);
            font-size: 15px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 18px;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 18px 20px 18px 55px;
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
            margin-top: 8px;
            display: flex;
            align-items: center;
        }

        .invalid-feedback i {
            margin-right: 8px;
            font-size: 14px;
        }

        .reset-button {
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
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .reset-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .reset-button:hover::before {
            left: 100%;
        }

        .reset-button i {
            margin-right: 12px;
            font-size: 18px;
        }

        .reset-button:hover {
            background: linear-gradient(to right, var(--admin-dark), var(--admin-accent));
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(13, 71, 161, 0.3);
        }

        .reset-button:active {
            transform: translateY(-1px);
        }

        .back-to-login {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: var(--gray);
        }

        .back-to-login a {
            color: var(--admin-accent);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
        }

        .back-to-login a:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        .back-to-login a i {
            margin-right: 6px;
            font-size: 14px;
        }

        .email-sent-animation {
            display: none;
            text-align: center;
            margin-top: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: var(--border-radius);
            animation: fadeIn 0.5s ease;
        }

        .email-sent-animation.show {
            display: block;
        }

        .email-icon {
            font-size: 48px;
            color: var(--admin-accent);
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
        }

        .notification {
            position: fixed;
            top: 30px;
            right: 30px;
            padding: 18px 25px;
            border-radius: var(--border-radius);
            background-color: white;
            color: var(--admin-dark);
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
            border-left: 4px solid var(--success);
        }

        .notification.error {
            border-left: 4px solid var(--secondary);
        }

        .notification i {
            font-size: 22px;
            margin-right: 15px;
        }

        .notification.success i {
            color: var(--success);
        }

        .notification.error i {
            color: var(--secondary);
        }

        @media (max-width: 992px) {
            .forgot-card {
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

            .forgot-icon {
                font-size: 56px;
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

            .forgot-title {
                font-size: 28px;
            }

            .forgot-icon {
                font-size: 48px;
            }
        }

        /* Animation for form elements */
        .form-group {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        .reset-button {
            animation: fadeInUp 0.5s ease 0.2s forwards;
            opacity: 0;
        }

        .back-to-login {
            animation: fadeInUp 0.5s ease 0.3s forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
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

        /* Success animation */
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            position: relative;
        }

        .success-checkmark .check-icon {
            width: 80px;
            height: 80px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 4px solid #4CAF50;
        }

        .success-checkmark .check-icon::before {
            top: 3px;
            left: -2px;
            width: 30px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }

        .success-checkmark .check-icon::after {
            top: 0;
            left: 30px;
            width: 60px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
            animation: rotate-circle 4.25s ease-in;
        }

        .success-checkmark .check-icon .icon-line {
            height: 5px;
            background-color: #4CAF50;
            display: block;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
        }

        .success-checkmark .check-icon .icon-line.line-tip {
            top: 46px;
            left: 14px;
            width: 25px;
            transform: rotate(45deg);
            animation: icon-line-tip 0.75s;
        }

        .success-checkmark .check-icon .icon-line.line-long {
            top: 38px;
            right: 8px;
            width: 47px;
            transform: rotate(-45deg);
            animation: icon-line-long 0.75s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forgot-card">
            <!-- Left Section with Admin Branding -->
            <div class="left-section">
                <div class="logo">
                    <i class="fas fa-store"></i>
                    E-SHOP <span class="admin-badge">ADMIN</span>
                </div>
                <h1 class="welcome-title">Reset Your Password</h1>
                <p class="welcome-subtitle">Forgot your admin password? No worries! We'll help you regain access to your
                    dashboard securely.</p>

                <div class="features">
                    <div class="feature">
                        <i class="fas fa-envelope"></i>
                        <div class="feature-text">Email Verification Link</div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i>
                        <div class="feature-text">Secure Password Reset</div>
                    </div>
                    <div class="feature">
                        <i class="fas fa-clock"></i>
                        <div class="feature-text">Link Valid for 60 Minutes</div>
                    </div>
                </div>
            </div>

            <!-- Right Section with Forgot Password Form -->
            <div class="right-section">
                <div class="forgot-header">
                    <div class="forgot-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h2 class="forgot-title">Forgot Password?</h2>
                    <p class="forgot-subtitle">Enter your admin email address below and we'll send you a secure link to
                        reset your password.</p>
                </div>

                <!-- Laravel Status Message -->
                @if (session('status'))
                    <div class="alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Laravel Forgot Password Form -->
                <form class="forgot-form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">Admin Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                id="exampleInputEmail" placeholder="admin@eshop.com" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="reset-button">
                        <i class="fas fa-paper-plane"></i> {{ __('Send Reset Link') }}
                    </button>
                </form>

                <div class="back-to-login">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>

                <!-- Success Animation (Hidden by default) -->
                <div class="email-sent-animation" id="emailSentAnimation">
                    <div class="success-checkmark">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                    <h3 style="color: var(--admin-dark); margin-bottom: 10px;">Email Sent!</h3>
                    <p style="color: var(--gray);">Check your inbox for the password reset link. The link will expire in
                        60 minutes.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i>
        <div class="notification-content">
            <div class="notification-title">Success!</div>
            <div class="notification-message">Reset link sent to your email!</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forgotForm = document.querySelector('.forgot-form');
            const emailInput = document.querySelector('input[name="email"]');
            const notification = document.getElementById('notification');
            const emailSentAnimation = document.getElementById('emailSentAnimation');

            // Check for validation errors
            const errorFields = document.querySelectorAll('.is-invalid');
            if (errorFields.length > 0) {
                errorFields.forEach(field => {
                    field.style.animation = 'shake 0.5s ease';
                });

                showNotification('Please check your email address.', 'error');
            }

            // Check if there's a success message (from Laravel session)
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                // Show email sent animation
                emailSentAnimation.classList.add('show');
                forgotForm.style.display = 'none';

                // Animate the success icon
                setTimeout(() => {
                    const tipLine = document.querySelector('.line-tip');
                    const longLine = document.querySelector('.line-long');
                    tipLine.style.animation = 'icon-line-tip 0.75s';
                    longLine.style.animation = 'icon-line-long 0.75s';
                }, 300);
            }

            // Form submission enhancement
            forgotForm.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;

                // Validate email format
                const email = emailInput.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailPattern.test(email)) {
                    e.preventDefault();
                    emailInput.classList.add('is-invalid');
                    showNotification('Please enter a valid email address.', 'error');
                    return;
                }

                // Show loading animation
                if (this.checkValidity()) {
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending Reset Link...';
                    submitButton.disabled = true;

                    // For demo purposes, simulate sending
                    // In production, this would be handled by Laravel
                    setTimeout(() => {
                        // This is just for demo - in real app, form would submit to Laravel
                        // submitButton.innerHTML = originalText;
                        // submitButton.disabled = false;
                    }, 2000);
                }
            });

            // Real-time email validation
            emailInput.addEventListener('input', function() {
                const email = this.value;
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email && !emailPattern.test(email)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            // Show notification function
            function showNotification(message, type) {
                const icon = notification.querySelector('i');
                const title = notification.querySelector('.notification-title');
                const msg = notification.querySelector('.notification-message');

                msg.textContent = message;
                notification.className = 'notification';
                notification.classList.add(type);

                if (type === 'success') {
                    icon.className = 'fas fa-check-circle';
                    title.textContent = 'Success!';
                } else {
                    icon.className = 'fas fa-exclamation-circle';
                    title.textContent = 'Error!';
                }

                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 4000);
            }

            // Check if old email exists and add a subtle highlight
            if (emailInput.value) {
                emailInput.style.backgroundColor = 'rgba(13, 71, 161, 0.05)';
                setTimeout(() => {
                    emailInput.style.backgroundColor = '';
                }, 2000);
            }

            // Add success animations CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes icon-line-tip {
                    0% {
                        width: 0;
                        left: 1px;
                        top: 19px;
                    }
                    54% {
                        width: 0;
                        left: 1px;
                        top: 19px;
                    }
                    70% {
                        width: 50px;
                        left: -8px;
                        top: 37px;
                    }
                    84% {
                        width: 17px;
                        left: 21px;
                        top: 48px;
                    }
                    100% {
                        width: 25px;
                        left: 14px;
                        top: 46px;
                    }
                }

                @keyframes icon-line-long {
                    0% {
                        width: 0;
                        right: 46px;
                        top: 54px;
                    }
                    65% {
                        width: 0;
                        right: 46px;
                        top: 54px;
                    }
                    84% {
                        width: 55px;
                        right: 0px;
                        top: 35px;
                    }
                    100% {
                        width: 47px;
                        right: 8px;
                        top: 38px;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>

@extends('layouts.layout')

@section('title', 'Login - Laravel MongoDB App')

@section('content')
<style>
    .login-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeInUp 0.8s ease;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
        max-width: 450px;
        width: 100%;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 400% 100%;
        animation: gradientMove 3s ease infinite;
    }

    @keyframes gradientMove {
        0%, 100% { background-position: 0% 0%; }
        50% { background-position: 100% 0%; }
    }

    .login-header {
        text-align: center;
        padding: 2.5rem 2rem 1rem;
        position: relative;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        position: relative;
    }

    .login-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        font-weight: 400;
    }

    .login-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        animation: pulse 2s infinite;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .login-icon i {
        font-size: 2rem;
        color: white;
    }

    .login-body {
        padding: 0 2rem 2.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        color: white;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 2.2rem;
        color: rgba(255, 255, 255, 0.5);
        transition: color 0.3s ease;
    }

    .form-control:focus + .input-icon {
        color: #667eea;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        padding: 0.875rem 2rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .btn-login:hover::before {
        left: 100%;
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        color: #ff6b8a;
        padding: 1rem;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .alert-danger p {
        margin: 0;
        font-size: 0.9rem;
    }

    .alert-danger p:not(:last-child) {
        margin-bottom: 0.5rem;
    }

    .forgot-password {
        text-align: center;
        margin-top: 1.5rem;
    }

    .forgot-password a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .forgot-password a:hover {
        color: #667eea;
    }

    /* Loading animation for form submission */
    .btn-login.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-login.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .login-card {
            margin: 1rem;
            border-radius: 20px;
        }

        .login-header {
            padding: 2rem 1.5rem 1rem;
        }

        .login-body {
            padding: 0 1.5rem 2rem;
        }

        .login-title {
            font-size: 1.75rem;
        }

        .login-icon {
            width: 70px;
            height: 70px;
        }

        .login-icon i {
            font-size: 1.75rem;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h2 class="login-title">Selamat Datang</h2>
            <p class="login-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Username
                    </label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Enter your email"
                           required>
                    <i class="fas fa-at input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                    <i class="fas fa-key input-icon"></i>
                </div>

                <button type="submit" class="btn btn-login w-100" id="loginBtn">
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </span>
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = loginBtn.querySelector('.btn-text');

    // Add loading state on form submission
    form.addEventListener('submit', function() {
        loginBtn.classList.add('loading');
        btnText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
        loginBtn.disabled = true;
    });

    // Add input focus effects
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });

        // Add typing effect
        input.addEventListener('input', function() {
            if (this.value) {
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            }
        });
    });

    // Add enter key support
    inputs.forEach((input, index) => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else {
                    form.submit();
                }
            }
        });
    });
});

function showComingSoon() {
    // Simple notification for forgot password (you can implement actual functionality)
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(255, 193, 7, 0.1);
        border: 1px solid rgba(255, 193, 7, 0.3);
        color: #ffc107;
        padding: 1rem;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        z-index: 9999;
        animation: slideInRight 0.3s ease;
    `;
    notification.innerHTML = '<i class="fas fa-info-circle me-2"></i>Feature coming soon!';
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection
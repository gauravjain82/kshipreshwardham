<!DOCTYPE html>
<html lang="en">
@php
    $header = DB::table('setting')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $header->title ?? 'मंदिर' }} - प्रशासन लॉगिन</title>

    <!-- CSS Files -->
    <link rel="icon" type="image/png" href="{{ asset($header->favicon) }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/bootstrap/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    
    <!-- Google Font for Devanagari -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Tiro+Devanagari+Sanskrit:ital@0;1&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Sacred Background Elements */
        body::before {
            content: "🕉️";
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 60px;
            opacity: 0.1;
            color: #fff;
            transform: rotate(-15deg);
        }
        
        body::after {
            content: "॥ ॐ ॥";
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 50px;
            opacity: 0.1;
            color: #fff;
            font-family: 'Tiro Devanagari Sanskrit', serif;
        }
        
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        
        .floating-elements span {
            position: absolute;
            color: rgba(255, 215, 0, 0.1);
            font-family: 'Tiro Devanagari Sanskrit', serif;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            border: 2px solid rgba(255, 215, 0, 0.3);
            animation: slideUp 0.5s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #8B5A2B 0%, #D4AF37 100%);
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path d="M50 10 L60 40 L90 40 L65 60 L75 90 L50 70 L25 90 L35 60 L10 40 L40 40 Z" fill="white"/></svg>');
            background-size: 50px 50px;
            opacity: 0.1;
        }
        
        .login-header img {
            max-width: 180px;
            max-height: 80px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }
        
        .login-header h2 {
            color: #fff;
            font-size: 24px;
            margin-top: 15px;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }
        
        .login-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-top: 5px;
            font-family: 'Tiro Devanagari Sanskrit', serif;
            position: relative;
            z-index: 2;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #4A4A4A;
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            color: #D4AF37;
            font-size: 18px;
            z-index: 3;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #E0E0E0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            font-family: 'Poppins', sans-serif;
        }
        
        .form-control:focus {
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            outline: none;
            background: #fff;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            color: #D4AF37;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            z-index: 3;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #8B5A2B;
        }
        
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #D4AF37;
        }
        
        .checkbox-wrapper label {
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }
        
        .forgot-link {
            color: #8B5A2B;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #D4AF37;
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #8B5A2B 0%, #D4AF37 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 13px;
        }
        
        .footer-text i {
            color: #D4AF37;
            margin: 0 3px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #999;
            font-size: 12px;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
        }
        
        .divider span {
            padding: 0 15px;
            color: #D4AF37;
            font-family: 'Tiro Devanagari Sanskrit', serif;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header {
                padding: 20px;
            }
            
            .login-header img {
                max-width: 140px;
            }
            
            body::before,
            body::after {
                font-size: 40px;
            }
        }
        
        /* Additional decorative elements */
        .mangal-kalash {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 30px;
            opacity: 0.1;
            color: #fff;
            animation: float 8s ease-in-out infinite;
        }
    </style>
</head>

<body>
    <!-- Floating Sacred Elements -->
    <div class="floating-elements">
        <span style="top: 10%; left: 5%; font-size: 25px;">ॐ</span>
        <span style="top: 20%; right: 8%; font-size: 35px;">🪔</span>
        <span style="bottom: 15%; left: 10%; font-size: 30px;">🔔</span>
        <span style="bottom: 25%; right: 5%; font-size: 40px;">🌿</span>
        <span style="top: 40%; left: 15%; font-size: 20px;">🙏</span>
        <span style="top: 70%; right: 12%; font-size: 25px;">🕉️</span>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset($header->logo ?? '') }}" alt="मंदिर लोगो" onerror="this.src='https://via.placeholder.com/180x80?text=मंदिर'">
                <h2>प्रशासन लॉगिन</h2>
                <p>॥ श्री राम समर्थ ॥</p>
            </div>
            
            <div class="login-body">
                <form id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="username">
                            <i class="bi bi-person-badge me-1"></i> उपयोगकर्ता नाम
                        </label>
                        <div class="input-group">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" id="username" name="username" class="form-control" 
                                   placeholder="अपना उपयोगकर्ता नाम दर्ज करें" autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <i class="bi bi-lock me-1"></i> पासवर्ड
                        </label>
                        <div class="input-group">
                            <i class="bi bi-key input-icon"></i>
                            <input type="password" id="password" name="password" class="form-control" 
                                   placeholder="अपना पासवर्ड दर्ज करें">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                   
                    
                    <button type="submit" class="btn-login" id="submitBtn">
                        <i class="bi bi-box-arrow-in-right me-2"></i> लॉगिन करें
                    </button>
                   
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script>
        $(document).ready(function () {
            // Form Submit Handler
            $("#loginForm").submit(function (e) {
                e.preventDefault();

                let username = $("#username").val().trim();
                let password = $("#password").val().trim();
                let submitBtn = $("#submitBtn");

                // Validation
                if (username === "" || password === "") {
                    showToast("कृपया उपयोगकर्ता नाम और पासवर्ड दर्ज करें", "error");
                    return;
                }

                // Disable button and show loading state
                submitBtn.prop('disabled', true).html('<i class="bi bi-hourglass-split me-2"></i> लॉगिन हो रहा है...');

                // AJAX Request
                $.ajax({
                    url: "{{ route('AdminLogin') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        username: username,
                        password: password
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            showToast("लॉगिन सफल! आपका स्वागत है", "success");
                            setTimeout(() => {
                                window.location.href = response.redirect_url;
                            }, 1500);
                        } else {
                            showToast(response.message || "गलत उपयोगकर्ता नाम या पासवर्ड", "error");
                            submitBtn.prop('disabled', false).html('<i class="bi bi-box-arrow-in-right me-2"></i> लॉगिन करें');
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = "कुछ गलत हो गया! कृपया पुनः प्रयास करें";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        showToast(errorMsg, "error");
                        submitBtn.prop('disabled', false).html('<i class="bi bi-box-arrow-in-right me-2"></i> लॉगिन करें');
                    }
                });
            });

            // Password Toggle
            $("#togglePassword").click(function (e) {
                e.preventDefault();
                const passwordInput = $("#password");
                const toggleIcon = $("#toggleIcon");

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });

            // Toast Notification Function
            function showToast(message, type) {
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: type === "success" ? "linear-gradient(135deg, #28a745, #20c997)" : "linear-gradient(135deg, #dc3545, #c82333)",
                    stopOnFocus: true,
                    className: "toast-notification",
                }).showToast();
            }

            // Enter key press handler
            $("#password").keypress(function (e) {
                if (e.which === 13) {
                    $("#loginForm").submit();
                }
            });

            // Remove loading state if page is loaded from cache
            $(window).on('pageshow', function() {
                $("#submitBtn").prop('disabled', false).html('<i class="bi bi-box-arrow-in-right me-2"></i> लॉगिन करें');
            });
        });
    </script>
</body>
</html>
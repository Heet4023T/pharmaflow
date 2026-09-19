<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PharmaFlow - {{ucfirst($title ?? 'Login')}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{!empty(AppSettings::get('favicon')) ? asset('storage/'.AppSettings::get('favicon')) : asset('assets/img/favicon.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- PharmaFlow Design System -->
    <link rel="stylesheet" href="{{asset('assets/css/pharmaflow.css')}}">
    <!-- Page CSS -->
    @stack('page-css')
</head>
<body>

<div class="pf-auth-container">

    <!-- Left Branding Panel -->
    <div class="pf-auth-left">
        <!-- Brand -->
        <div class="pf-auth-brand">
            <div class="pf-auth-logo-icon">
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V21C3 22.1 3.9 23 5 23H19C20.1 23 21 22.1 21 21V5C21 3.9 20.1 3 19 3ZM12 3C12.55 3 13 3.45 13 4C13 4.55 12.55 5 12 5C11.45 5 11 4.55 11 4C11 3.45 11.45 3 12 3ZM13 17H11V15H9V13H11V11H13V13H15V15H13V17ZM19 21H5V5H7V7H17V5H19V21Z" fill="white"/>
                </svg>
            </div>
            <h1>PharmaFlow</h1>
            @if (($authPortal ?? 'user') === 'admin')
                <span class="pf-auth-portal-badge">Admin Portal</span>
                <p>PharmaFlow Administration</p>
            @else
                <span class="pf-auth-portal-badge">Staff Portal</span>
                <p>PharmaFlow User Access</p>
            @endif
        </div>

        <!-- Animated capsules -->
        <div class="pf-animation-area">
            <div class="pf-capsule"></div>
            <div class="pf-capsule"></div>
            <div class="pf-capsule"></div>
        </div>

        <!-- Feature list -->
        <div class="pf-features">
            <div class="pf-feature-item">
                <i class="fas fa-boxes"></i>
                <span>Complete inventory management</span>
            </div>
            <div class="pf-feature-item">
                <i class="fas fa-chart-line"></i>
                <span>Sales & purchase reports</span>
            </div>
            <div class="pf-feature-item">
                <i class="fas fa-bell"></i>
                <span>Automated stock alerts</span>
            </div>
            <div class="pf-feature-item">
                <i class="fas fa-shield-alt"></i>
                <span>Role-based access control</span>
            </div>
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="pf-auth-right">
        <div class="pf-auth-form-wrap">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-alerts.danger :error="$error" />
                @endforeach
            @endif
            @yield('content')
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/script.js')}}"></script>
<!-- Page JS -->
@stack('page-js')
</html>
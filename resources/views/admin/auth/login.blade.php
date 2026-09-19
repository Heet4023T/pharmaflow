@extends('admin.layouts.plain')

@section('content')
@php $isAdminLogin = ($authPortal ?? 'user') === 'admin'; @endphp

<nav class="pf-portal-switch" aria-label="Choose login portal">
    <a href="{{ route('login') }}" class="{{ $isAdminLogin ? '' : 'active' }}" @if(!$isAdminLogin) aria-current="page" @endif>
        <svg class="pf-portal-icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21a8 8 0 0 0-16 0"></path>
            <circle cx="12" cy="8" r="4"></circle>
        </svg>
        <span>User Login</span>
    </a>
    <a href="{{ route('admin.login') }}" class="{{ $isAdminLogin ? 'active' : '' }}" @if($isAdminLogin) aria-current="page" @endif>
        <svg class="pf-portal-icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V6l-8-3-8 3v6c0 6 8 10 8 10z"></path>
            <path d="M9 12l2 2 4-4"></path>
        </svg>
        <span>Admin Login</span>
    </a>
</nav>

<h2>{{ $isAdminLogin ? 'Admin Login' : 'User Login' }}</h2>
<p class="auth-subtitle">
    {{ $isAdminLogin ? 'Sign in to the PharmaFlow Administration Panel' : 'Access your PharmaFlow workspace' }}
</p>

@if (session('login_error'))
<x-alerts.danger :error="session('login_error')" />
@endif

<!-- Login Form -->
<form action="{{ $isAdminLogin ? route('admin.login') : route('login') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Email Address</label>
        <input class="form-control" name="email" type="email" placeholder="your@email.com" value="{{old('email')}}" required autocomplete="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" type="password" placeholder="Enter your password" required autocomplete="current-password">
    </div>
    <div class="form-group" style="margin-top:24px;">
        <button class="btn btn-primary btn-block" type="submit">{{ $isAdminLogin ? 'Sign In as Admin' : 'Sign In' }}</button>
    </div>
</form>
<!-- /Login Form -->

<div class="auth-link-row">
    <a href="{{route('password.request')}}">Forgot your password?</a>
</div>
@if (!$isAdminLogin)
<div class="auth-link-row" style="margin-top:8px;">
    Don&apos;t have an account? <a href="{{route('register')}}">Register</a>
</div>
@endif
@endsection

@extends('admin.layouts.plain')

@section('content')
<h2>Forgot Password?</h2>
<p class="auth-subtitle">Enter your email to receive a password reset link</p>

<!-- Form -->
<form action="{{route('password.request')}}" method="post">
    @csrf
    <div class="form-group">
        <label>Email Address</label>
        <input class="form-control" name="email" type="email" placeholder="your@email.com" autocomplete="email">
    </div>
    <div class="form-group" style="margin-top:24px;">
        <button class="btn btn-primary btn-block" type="submit">Send Reset Link</button>
    </div>
</form>
<!-- /Form -->

<div class="auth-link-row">
    Remember your password? <a href="{{route('login')}}">Sign In</a>
</div>
@endsection
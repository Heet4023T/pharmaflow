@extends('admin.layouts.plain')

@section('content')
<h2>Reset Password</h2>
<p class="auth-subtitle">Enter your new password below</p>

<!-- Form -->
<form action="{{route('password.request')}}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{request()->token}}">
    <div class="form-group">
        <label>Email Address</label>
        <input class="form-control" name="email" type="email" placeholder="your@email.com" autocomplete="email">
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input class="form-control" name="password" type="password" placeholder="Enter new password" autocomplete="new-password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input class="form-control" name="password_confirmation" type="password" placeholder="Repeat new password" autocomplete="new-password">
    </div>
    <div class="form-group" style="margin-top:24px;">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
    </div>
</form>
<!-- /Form -->

<div class="auth-link-row">
    Remember your password? <a href="{{route('login')}}">Sign In</a>
</div>
@endsection
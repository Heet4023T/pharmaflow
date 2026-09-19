@extends('admin.layouts.plain')

@section('content')
<h2>Create account</h2>
<p class="auth-subtitle">Register for PharmaFlow access</p>

<!-- Register Form -->
<form action="{{route('register')}}" method="POST">
    @csrf
    <div class="form-group">
        <label>Full Name</label>
        <input class="form-control" name="name" type="text" value="{{old('name')}}" placeholder="Your full name" required autocomplete="name">
    </div>
    <div class="form-group">
        <label>Email Address</label>
        <input class="form-control" name="email" type="email" value="{{old('email')}}" placeholder="your@email.com" required autocomplete="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" type="password" placeholder="Create a password" required autocomplete="new-password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input class="form-control" name="password_confirmation" type="password" placeholder="Repeat your password" required autocomplete="new-password">
    </div>
    <div class="form-group" style="margin-top:24px;">
        <button class="btn btn-primary btn-block" type="submit">Create Account</button>
    </div>
</form>
<!-- /Register Form -->

<div class="auth-link-row">
    Already have an account? <a href="{{route('login')}}">Sign In</a>
</div>
@endsection
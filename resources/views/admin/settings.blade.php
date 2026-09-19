@extends('admin.layouts.app')
@php
    $title ='settings';
@endphp

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">General Settings</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Settings</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">				
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-settings" style="color:var(--pf-primary);"></i>
                    System Configuration
                </h4>
            </div>
            <div class="card-body">
                @include('app_settings::_settings')	
            </div>
        </div>
    </div>
</div>
@endsection

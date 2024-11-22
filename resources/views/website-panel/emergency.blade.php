@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/emergency.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('welcome') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="d-flex justify-content-between align-items-end">
        <h4 class="place_heading">Emergency</h4>
        <div class="welcome_logo_div">
            <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
            <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" /> 
        </div>
    </div>
    <div class="row place_row mt-3">
        <a href="{{route('hospitalList')}}" class="col-6 text-decoration-none">
            <div class="card_div">Hospitals</div>
        </a>
        <a href="{{route('bankList')}}" class="col-6 text-decoration-none">
            <div class="card_div">Banks</div>
        </a>
    </div>
</div>
@endsection
@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/hospitals.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('emergency') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="d-flex justify-content-between align-items-end">
        <h4 class="place_heading"></h4>
        <div class="welcome_logo_div">
            <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
            <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" /> 
        </div>
    </div>
    <div class="d-flex  justify-content-between  mt-3">
        @foreach ($hospitalImages as $hospitalImage)
        <img src="{{asset('hospitals/'.$hospitalImage->photo)}}" alt="" class="card_div" />
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="place_heading">Hospital</h4>
        <div class="row mt-3">
            @foreach($hospitals as $hospital)
            <div class="col-6 mt-3">
                <div class="card_css">
                    <h5 class="card_heading">{{$hospital->name}}</h5>
                    <p class="sub_text" style="color: #16539A;">{{$hospital->address}}</p>
                    <p class="sub_text">Category/Type:{{$hospital->category}}</p>
                    <p class="sub_text">Pincode:{{$hospital->pincode}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
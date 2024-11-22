@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/all-qr.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{url('ayodhya-dham-temple-detail/'.Crypt::encryptString($ayodhyaDhamTemples->id))}}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="inside_card">
        <div class="d-flex justify-content-between align-items-end">
            <h4 class="place_heading"></h4>
            <div class="welcome_logo_div">
                <img src="{{asset('website-assets/image/logo.png')}}" />
                <img src="{{asset('website-assets/image/ayodya_logo.png')}}" />
            </div>
        </div>
        <div class="spacing_css">
            <h1 class="heading_css pt-3 pb-5">QR Code</h1>
            <div >{{generateQr($ayodhyaDhamTemples->via_railway_station_map_link)}}</div>
            <p class="sub_text mt-5">{{$ayodhyaDhamTemples->name}}</p>
            <h5 class="sub_heading">Scan to share location</h5>
        </div>
    </div>
</div>
</div>
@endsection
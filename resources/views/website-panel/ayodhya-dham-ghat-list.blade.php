@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/ghat.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('ayodhyaDhamPlace') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="d-flex justify-content-between align-items-end">
        <h4 class="place_heading">Ghat</h4>
        <div class="welcome_logo_div">
            <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
            <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" />
        </div>
    </div>
    <div class="row place_row mt-3">
        @foreach ($ayodhyaDhamGhat as $ghat)
        <div class="col-6">
            <a href="{{url('ayodhya-dham-ghat-detail/'.Crypt::encryptString($ghat->id))}}" class="category_card_div">
                <img src="{{asset('ayodhya-dham/ghats/'.$ghat->photo)}}" alt="temples" class="category_image" />
                <p class="place_card_text text-nowrap">{{$ghat->name}}</p>
            </a>
        </div> 
        @endforeach
    </div>
</div>
@endsection
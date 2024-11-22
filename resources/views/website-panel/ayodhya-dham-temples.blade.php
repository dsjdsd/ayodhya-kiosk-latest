@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/best-place.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('ayodhyaDhamPlace') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="welcome_logo_div">
        <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
        <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" />
    </div>
    <h4 class="place_heading">Best {{count($ayodhyaDhamTemples)}} places to visit in Ayodhya</h4>
    <div class="row place_row p-0">
        @foreach ($ayodhyaDhamTemples as $temple)
        <a href="{{url('ayodhya-dham-temple-detail/'.Crypt::encryptString($temple->id))}}" class="col-4 mt-2  text-decoration-none">
            <div class="place_card_div mb-0 pb-0">
                <img src="{{asset('ayodhya-dham/temples/'.$temple->photo)}}" class="w-100"  style="height:62px; object-fit:cover"/>
                <p class="place_card_text text-nowrap">{{$temple->name}}</p>
            </div>
        </a>    
        @endforeach
    </div>
</div>
@endsection
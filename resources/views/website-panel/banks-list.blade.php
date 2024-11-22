@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/bank.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('emergency') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="d-flex justify-content-between align-items-end">
        <h4 class="place_heading">Banks</h4>
        <div class="welcome_logo_div">
            <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
            <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" /> 
        </div>
    </div>

    <div class="mt-3">
        <div class="row mt-3">
           @foreach ($banks as $bank)
           <div class="col-6 mt-3">
            <div class="card_css">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card_heading">{{$bank->name}}</h5>
                    <img src="{{asset('banks/'.$bank->photo)}}" alt="" class="" />
                </div>
                <a href="{{$bank->address_link}}" target="_blank">
                    <p class="sub_text" style="color: #16539A;">{{$bank->address}}</p>
                </a>
                    <p class="sub_text">Website Link : <a href="{{$bank->website}}" style="color: #16539A;">{{$bank->website}}</a>
                        
                        </p>
                        <p class="sub_text">Category/Type:{{$bank->category}}</p>
                    <p class="sub_text">Pincode:{{$bank->pincode}}</p>
              
            </div>
            </div> 
           @endforeach
        </div>
    </div>
</div>
@endsection
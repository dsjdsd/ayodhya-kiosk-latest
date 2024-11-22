@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/all-hotels.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('travelList') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
        <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="welcome_select_div">
        <i class="fa fa-search search_icon_css"></i>
        <select class="welcome_search">
            <option>Search....</option>
        </select>
        &nbsp;
        <button class="welcome_btn_css">Next <i class="fa fa-arrow-right"></i></button>
    </div>
    <div class="mt-3">
        <h4 class="place_heading">Hotels</h4>
        <div class="mt-3">
            @foreach ($hotelList as $hotel)
            <div class="card_css">
                <!-- <div class="mr-2">
                    <div >
                        <img src="{{asset('hotels/'.$hotel->photo)}}" alt="" class="mb-1"/>
                    </div>
                    <div>
                        <img src="{{asset('hotels/'.$hotel->image1)}}" alt="" />
                        <img src="{{asset('hotels/'.$hotel->image2)}}" alt="" />
                        <img src="{{asset('hotels/'.$hotel->image3)}}" alt="" />
                    </div>
                </div> -->
                <div class="mr-2">
                <div class="top-image">
                    <img  src="{{asset('hotels/'.$hotel->photo)}}" alt="Top Image">
                </div>

                <!-- Bottom Three Images -->
                <div class="bottom-images">
                    <div>
                        <img src="{{asset('hotels/'.$hotel->image1)}}" alt="Bottom Image 1">
                    </div>
                    <div>
                        <img src="{{asset('hotels/'.$hotel->image2)}}" alt="Bottom Image 2">
                    </div>
                    <div>
                        <img src="{{asset('hotels/'.$hotel->image3)}}" alt="Bottom Image 3">
                    </div>
                </div>
</div>


            <div class="borde_css"></div>
            <div style="margin-left: 20px;">
                <h5 class="card_heading">{{$hotel->name}}</h5>
                <p class="sub_text"><span style="color: #16539A;">Address:</span> {{$hotel->address}}</p>
                <p class="sub_text1"><i class="fa fa-phone" aria-hidden="true"></i> +91 {{$hotel->mobile_number}}</p>
                <p class="sub_text">
                    <button class="btn_css">View Details</button>
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
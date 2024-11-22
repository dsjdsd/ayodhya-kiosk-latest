@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/travel.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('welcome') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="width_css">
    <div class="wrapper">
        <div class="center-slider">
            @foreach ($otherFamousPlaceImage as $image)
            <img src="{{asset('other-temples/'.$image->photo)}}" alt="Image 1" class="slider_img" />
            @endforeach
        </div>
    </div>
    <div class="position-relative">
        <p class="travel_heading">Travel</p>
        @foreach ($travelList as $travel)
            @if($travel->type == "Accommodation")
            <a href="{{route('hotelList')}}">
                <img src="{{asset('travels/'.$travel->photo)}}" alt="" class="mb-2" />
            </a>  
            @else
            <a href="{{url('travel-detail/'.Crypt::encryptString($travel->id))}}">
                <img src="{{asset('travels/'.$travel->photo)}}" alt="" class="mb-2" />
            </a>  
            @endif
        
        @endforeach
    </a>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.center-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            arrows: false,
            dots: false,
            speed: 500,
            centerPadding: '20px',
            infinite: true,
            autoplaySpeed: 2000,
            autoplay: true
        });
    });
</script>
@endsection
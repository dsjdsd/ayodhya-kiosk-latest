@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/welcome_new.css')}}" rel="stylesheet" />


<!-- <div class="home_main_div">
        <div class="cover"> -->
            <div class="header">
                <div class="ribbon">
                    <div class="ribbon-text"> <a href="{{route('/')}}" class="ribbon-text">Home</a></div>
                </div>
            </div>

            <div class="w-75 m-auto">
                <div class="welcome_logo_div">
                <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
                <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" /> 
                </div>

                <h1 class="welcome_heading_css mb-0">Welcome to</h1>
            </div>
            <div class="welcome_content_div">
                <div>
                    <h1 class="welcome_heading"><span style="color:#E85722;">Shree Ayodhya ji Teerth Vikas Parishad</span></h1>
                    <div class="welcome_select_div">
                        <i class="fa fa-search search_icon_css"></i>
                        <select class="welcome_search">
                            <option>Search....</option>
                        </select>
                        &nbsp;
                        <button class="welcome_btn_css">Next <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Slick Slider -->
            <div class="wrapper">
                <div class="center-slider">
                    @foreach ($ayodhyaDhamTemple as $temple)
                    <img src="{{asset('ayodhya-dham/temples/'.$temple->photo)}}" alt="Image 1" class="slider_img" />
                    @endforeach
                </div>
            </div>

        <!-- </div> -->
        <div class="welcome_last_div">
            <div class="row justify-content-between w-75 m-auto">
                <a href="{{route('ayodhyaDhamPlace')}}" class="col-3 p-0 text-decoration-none">
                    <div class="welcome_card" style="background: #8E4ED1;"><img src="{{asset('website-assets/image/dham.svg')}}" /></div>
                    <p class="welcome_image_name">Ayodhya Dham</p>
                </a>
                <a href="{{route('otherFamousTemple')}}" class="col-3 p-0 text-decoration-none">
                    <div class="welcome_card" style="background: #0C76E7"><img src="{{asset('website-assets/image/place.svg')}}" /></div>
                    <p class="welcome_image_name">Other famous places</p>
                </a>
                <a href="{{route('travelList')}}" class="col-3 p-0 text-decoration-none">
                    <div class="welcome_card" style="background: #8AC241"><img src="{{asset('website-assets/image/travels.svg')}}" /></div>
                    <p class="welcome_image_name">Travels</p>
                </a>
                <a href="{{route('emergency')}}" class="col-3 p-0 text-decoration-none">
                    <div class="welcome_card" style="background: #E7330C"><img src="{{asset('website-assets/image/emergency.svg')}}" /></div>
                    <p class="welcome_image_name">Emergency</p>
                </a>
            </div>
           
        <!-- </div> -->
    <!-- </div> -->
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
<!-- 
<div class="welcome_logo_div">
    <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
    <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" /> 
    </div>
    <div class="welcome_content_div">
    <div>
        <h1 class="welcome_heading">Welcome to <br /><b>Shree Ayodhya ji Teerth <br />Vikas Parishad</b>
        </h1>
        <div class="welcome_select_div">
            <i class="fa fa-search search_icon_css"></i>
            <select class="welcome_search">
                <option>Search....</option>
            </select>
            &nbsp;
            <button class="welcome_btn_css">Next <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
    </div>
    <div class="welcome_last_div">
    <div class="row justify-content-between w-75 m-auto">
        <a href="{{route('ayodhyaDhamPlace')}}" class="col-3 p-0 text-decoration-none">
            <div class="welcome_card" style="background: #8E4ED1;"><img src="{{asset('website-assets/image/dham.svg')}}"/></div>
            <p class="welcome_image_name">Ayodhya Dham</p>
        </a>
        <a href="{{route('otherFamousTemple')}}" class="col-3 p-0 text-decoration-none">
            <div class="welcome_card" style="background: #0C76E7"><img src="{{asset('website-assets/image/travels.svg')}}"/></div>
            <p class="welcome_image_name">Other famous places</p>
        </a>
        <a href="{{route('travelList')}}" class="col-3 p-0 text-decoration-none">
            <div class="welcome_card" style="background: #8AC241"><img src="{{asset('website-assets/image/place.svg')}}"/></div>
            <p class="welcome_image_name">Travels</p>
        </a>
        <a href="{{route('emergency')}}" class="col-3 p-0 text-decoration-none">
            <div class="welcome_card" style="background: #E7330C"><img src="{{asset('website-assets/image/emergency.svg')}}"/></div>
            <p class="welcome_image_name">Emergency</p>
        </a>
    </div> -->






    @endsection
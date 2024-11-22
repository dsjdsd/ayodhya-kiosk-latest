@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/place-details.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('ayodhyaDhamGhat') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="mt-4 scroll_div">
        <!-- <small class="date_css mb-2">03 Sep 2024, 01:32 PM IST</small> -->
        <img src="{{asset('ayodhya-dham/ghats/'.$ghatDetail->photo)}}" class="w-100" style="height:207px; object-fit:cover"/>
        <div class="row m-0 my-3 ">
            <div class="col-7 p-0">
                <h1 class="place_heading">{{$ghatDetail->name}}</h1>
                @if($ghatDetail->address)
                <a href="{{$ghatDetail->address_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/location.svg')}}" /> <small class="details_text">Location - {{$ghatDetail->address}}</small></div></a>
                @endif
                @if($ghatDetail->airport_station_km)
                <a href="{{$ghatDetail->airport_station_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Airport  - {{$ghatDetail->airport_station_km}}</small></div>
                @endif
                @if($ghatDetail->airport_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$ghatDetail->airport_station_estimate_time}}</small>
                </div>
                @endif
                @if($ghatDetail->via_railway_station_km)
                <a href="{{$ghatDetail->via_railway_station_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Railway Station - {{$ghatDetail->via_railway_station_km}}</small></div>
                @endif
                @if($ghatDetail->via_railway_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$ghatDetail->via_railway_station_estimate_time}}</small>
                </div>
                @endif
                @if($ghatDetail->bus_stop_km)
                <a href="{{$ghatDetail->bus_stop_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Bus Stop - {{$ghatDetail->bus_stop_km}}</small></div>
                @endif
                @if($ghatDetail->bus_stop_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$ghatDetail->bus_stop_estimate_time}}</small>
                </div>
                @endif
                <table class="mt-2">
                    <tr>
                        <th colspan="3" class="text-center">Check Conveyence to Ayodhya Mandir</th>
                    </tr>
                    <tr>
                        <td class="text-center"><img src="{{asset('website-assets/image/bus.svg')}}" /></td>
                        <td class="text-center details_border_css"><img src="{{asset('website-assets/image/car_1.svg')}}" /></td>
                        <td class="text-center"><img src="{{asset('website-assets/image/bike.svg')}}" /></td>
                    </tr>
                </table>
            </div>
            <div class="col-5 other_place mt-3">
                <h5 class="other_place_heading">Other Ghat</h5>
                <div class="row m-0">
                    @foreach ($otherFamousGhatImage as $image)
                    <div class="col-6 mt-1 p-0"><img src="{{asset('ayodhya-dham/ghats/'.$image->photo)}}" style="height:45px;" /></div>
                    @endforeach
                </div>
            </div>

        </div>
        <div>
            <div class="page_details">
               {!!$ghatDetail->description!!}
            </div>
        </div>
    </div>
</div>
@endsection
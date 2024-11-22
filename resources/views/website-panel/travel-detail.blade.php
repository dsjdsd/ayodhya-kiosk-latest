@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/place-details.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('travelList') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="mt-4 scroll_div">
        <small class="date_css mb-2">{{ now('Asia/Kolkata')->format('d-m-Y :H:i:s') }}</small>
        <img src="{{asset('travel_details/'.$travelDetail->photo)}}" />
        <div class="row m-0 my-3 ">
            <div class="col-7 p-0">
                <h1 class="place_heading">{{$travelDetail->name}}</h1>
                @if(isset($travelDetail->open_time))
                <div class="pt-2">
                    <img src="{{ asset('website-assets/image/time.svg') }}" alt="Open time icon" />
                    <small class="details_text">Open timings: {{ $travelDetail->open_time }}</small>
                </div>
                @endif
                @if(isset($travelDetail->address))
                <div class="pt-2"> 
                    <img src="{{asset('website-assets/image/location.svg')}}" /> <small class="details_text">Location - {{$travelDetail->address}}</small>
                </div>
                @endif   
                @if(isset($travelDetail->via_airport))
                <div class="pt-2"> 
                    <img src="{{asset('website-assets/image/car.svg')}}" /> 
                    <small class="details_text">Via {{$travelDetail->name}} - {{$travelDetail->via_airport}}</small>
                </div>
                @endif   
                @if(isset($travelDetail->estimate_time))
                <div class="pt-2"> 
                    <img src="{{asset('website-assets/image/time.svg')}}" /> 
                    <small class="details_text">Estimated Time - {{$travelDetail->estimate_time}}</small>
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
                <h5 class="other_place_heading">Other Places</h5>
                <div class="row m-0">
                    @foreach ($otherFamousPlaceImage as $image)
                    <div class="col-6 mt-1 p-0"><img src="{{asset('other-temples/'.$image->photo)}}" style="height:45px;" /></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="page_details">{!! $travelDetail->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
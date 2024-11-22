@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/place-details.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{url('other-famous-sub-category/'.Crypt::encryptString($subCategoryDetail->temple_category_id))}}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>

<div class="place_bg">
    <div class="mt-4 scroll_div">
        <div class="welcome_logo_div">
            <img src="{{asset('settings/'.setting()->logo1)}}" alt="Logo"/>
            <img src="{{asset('settings/'.setting()->logo2)}}"  alt="Logo" />
        </div>
   
        <img src="{{asset('sub-category-temple/'.$subCategoryDetail->photo)}}" class="w-100"/>
        <div class="row m-0 my-3 ">
            <div class="col-7 p-0">
                <h1 class="place_heading">{{$subCategoryDetail->name}}</h1>
                @if($subCategoryDetail->address)
                <a href="{{$subCategoryDetail->address_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/location.svg')}}" /> <small class="details_text">Location - {{$subCategoryDetail->address}}</small></div></a>
                @endif
                @if($subCategoryDetail->airport_station_km)
                <a href="{{$subCategoryDetail->airport_station_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Airport Station - {{$subCategoryDetail->airport_station_km}}</small></div>
                @endif
                @if($subCategoryDetail->airport_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$subCategoryDetail->airport_station_estimate_time}}</small>
                </div>
                @endif
                @if($subCategoryDetail->via_railway_station_km)
                <a href="{{$subCategoryDetail->via_railway_station_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Railway Station - {{$subCategoryDetail->via_railway_station_km}}</small></div>
                @endif
                @if($subCategoryDetail->via_railway_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$subCategoryDetail->via_railway_station_estimate_time}}</small>
                </div>
                @endif
                @if($subCategoryDetail->bus_stop_km)
                <a href="{{$subCategoryDetail->bus_stop_map_link}}"  class=" text-decoration-none text-dark">
                <div class="pt-2"> <img src="{{asset('website-assets/image/car.svg')}}" /> <small class="details_text">Via Bus Stop - {{$subCategoryDetail->bus_stop_km}}</small></div>
                @endif
                @if($subCategoryDetail->bus_stop_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time - {{$subCategoryDetail->bus_stop_estimate_time}}</small>
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
                    <div class="col-6 mt-1 p-0"><img src="{{asset('sub-category-temple/'.$image->photo)}}" style="height:45px;" /></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="page_details">{!! $subCategoryDetail->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
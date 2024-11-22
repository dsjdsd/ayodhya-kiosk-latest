@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/place-details.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('ayodhyaDhamTemple') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
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
        <img src="{{asset('ayodhya-dham/temples/'.$ayodhyaDhamTempleDetail->photo)}}" class="w-100" style="height:207px; object-fit:cover"/>
        <div class="row m-0 my-3 align-items-start">
            <div class="col-7 p-0">


                <h1 class="place_heading">{{$ayodhyaDhamTempleDetail->name}}</h1>
                <div class="pb-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Open timings: {{$ayodhyaDhamTempleDetail->open_time}}</small></div>

                <div class="pb-2" style="{{ count($artiList) == 0 ? 'display:none' : '' }}">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <img src="{{ asset('website-assets/image/arti.png') }}" /> 
                        <small class="details_text" style="color: #0D67C8;">Free Arti Timing</small>
                    </a>
                </div>
                

                @if($ayodhyaDhamTempleDetail->address)
                <a href="{{checkLink($ayodhyaDhamTempleDetail->address_map_link)}}" class="text-decoration-none text-dark">
                    <div class="pt-2"> <img src="{{asset('website-assets/image/location.svg')}}" /> <small class="details_text">Location -{{$ayodhyaDhamTempleDetail->address}}</small></div>
                </a>
                @endif
                {{-- airport --}}
                @if($ayodhyaDhamTempleDetail->airport_station_km)
                <div class="pt-2">
                <a href="{{$ayodhyaDhamTempleDetail->airport_station_map_link}}"  class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/rail.png')}}" /> <small class="details_text">Via Airport - {{$ayodhyaDhamTempleDetail->airport_station_km}}</small></a>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->airport_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time- {{$ayodhyaDhamTempleDetail->airport_station_estimate_time}}</small>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->airport_station_map_link)
                <div class="pt-2">
                    <a href="{{url('temple-qr-location/'.Crypt::encryptString($ayodhyaDhamTempleDetail->id))}}" class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/qr-icon.svg')}}" /> <small class="details_text" >
                    Scan QR for location</small></a>
                </div>
                @endif
                {{-- end railway station --}}
                @if($ayodhyaDhamTempleDetail->via_railway_station_km)
                <div class="pt-2">
                <a href="{{$ayodhyaDhamTempleDetail->via_railway_station_map_link}}"  class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/rail.png')}}" /> <small class="details_text">Via Railway Station - {{$ayodhyaDhamTempleDetail->via_railway_station_km}}</small></a>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->via_railway_station_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time- {{$ayodhyaDhamTempleDetail->via_railway_station_estimate_time}}</small>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->via_railway_station_map_link)
                <div class="pt-2">
                    <a href="{{url('temple-qr-location/'.Crypt::encryptString($ayodhyaDhamTempleDetail->id))}}" class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/qr-icon.svg')}}" /> <small class="details_text" >
                    Scan QR for location</small></a>
                </div>
                @endif
                {{-- bus station --}}
                @if($ayodhyaDhamTempleDetail->bus_stop_km)
                <div class="pt-2">
                <a href="{{checkLink($ayodhyaDhamTempleDetail->bus_stop_map_link)}}"  class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/rail.png')}}" /> <small class="details_text">Bus Stop - {{$ayodhyaDhamTempleDetail->bus_stop_km}}</small></a>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->bus_stop_estimate_time)
                <div class="pt-2"> <img src="{{asset('website-assets/image/time.svg')}}" /> <small class="details_text">Estimated Time- {{$ayodhyaDhamTempleDetail->bus_stop_estimate_time}}</small>
                </div>
                @endif
                @if($ayodhyaDhamTempleDetail->bus_stop_map_link)
                <div class="pt-2">
                    <a href="{{url('temple-qr-location/'.Crypt::encryptString($ayodhyaDhamTempleDetail->id))}}" class=" text-decoration-none text-dark"> <img src="{{asset('website-assets/image/qr-icon.svg')}}" /> <small class="details_text" >
                    Scan QR for location</small></a>
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
            <div class="col-5 other_place mt-3 border p-1 ">
                <h5 class="other_place_heading">Near Me</h5>
                <div class="row m-0 justify-content-between">
                    @foreach ($nearMeList as $nearMe)
                    <div class="col-6 mb-1 p-0 near_container">
                        <img src="{{asset('near-me/'.$nearMe->photo)}}" width="95%"  style="height:48px; object-fit:cover"/>
                        <p class="bottom-left">{{$nearMe->name}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="page_details">
              {!! $ayodhyaDhamTempleDetail->description !!}
            </div>
            
        </div>
    </div>
</div>
        <!-- modal code -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <br />
                        <h5 class="modal-title" id="staticBackdropLabel">Temple Free Darshan Timing</h5>
                        <div class="modal-title1">{{$ayodhyaDhamTempleDetail->open_time}}</div>
                    </div>
                    <div class="modal-body">
                        <h5 class="content_heading"><img src="{{asset('website-assets/image/watch_1.svg')}}" /> Free Arti Timing</h5>
                        @foreach ( $artiList as $arti)
                        <div class="arti_css">{{$arti->arti_name}} - {{$arti->arti_time}}</div>
                        @endforeach
                        <p class="note_css">{!! $ayodhyaDhamTempleDetail->note !!}</p>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-text">Trust does not charge for any Arti and Dashan passes</div>
                    </div>
                </div>
            </div>
        </div>
@endsection
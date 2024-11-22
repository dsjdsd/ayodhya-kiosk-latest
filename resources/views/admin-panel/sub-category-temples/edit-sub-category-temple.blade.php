@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <style>
.description{

    margin-top: 0;
}
    </style>
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{$templeSubCategoryDetail->category_name}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">{{$templeSubCategoryDetail->category_name}}</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminSubCategoryTempleUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row" >
                    <div class="col-lg-6 col-md-12">
                        <label for="Name">Language<span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between flex-wrap">
                            @foreach ($languages as $language)
                            <div>
                                <label for="language">{{$language->name}}</label>
                                <input type="radio" value="{{$language->id}}" {{ $templeSubCategoryDetail->language_id === $language->id ? "checked" : "" }} name="language_id">                            </div> 
                            @endforeach
                        </div>
                        @if ($errors->has('language_id'))
                        <span class="text-danger">{{ $errors->first('language_id') }}</span>
                        @endif
                    </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Name">Name<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="hidden" id="id" name="id" class="form-control" value="{{$templeSubCategoryDetail->id}}" required>
                        <input type="hidden" id="temple_category_id" name="temple_category_id" class="form-control" value="{{$templeSubCategoryDetail->temple_category_id}}" required>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{$templeSubCategoryDetail->name}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif 
                </div>
                
                <div class="col-lg-6 col-md-12">
                    <label for="Address">Temple Address <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{$templeSubCategoryDetail->address}}" required>
                    </div>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Temple Map Link">Temple Map Link<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="address_map_link" name="address_map_link" class="form-control" placeholder="Temple Address Link" value="{{$templeSubCategoryDetail->address_map_link}}" required>
                    </div>
                    @if ($errors->has('address_map_link'))
                        <span class="text-danger">{{ $errors->first('address_map_link') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Airport Station KM">Airport Station KM</label>
                    <div class="form-group">                                
                        <input type="text" id="airport_station_km" name="airport_station_km" class="form-control" placeholder="Airport Station KM" value="{{$templeSubCategoryDetail->airport_station_km}}" >
                    </div>
                    @if ($errors->has('airport_station_km'))
                        <span class="text-danger">{{ $errors->first('airport_station_km') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Airport Station Map Link">Airport Station Map Link </label>
                    <div class="form-group">                                
                        <input type="text" id="airport_station_map_link" name="airport_station_map_link" class="form-control" placeholder="Airport Station Map Link" value="{{$templeSubCategoryDetail->airport_station_map_link}}">
                    </div>
                    @if ($errors->has('airport_station_map_link'))
                        <span class="text-danger">{{ $errors->first('airport_station_map_link') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Airport Station Estimated Time">Airport Station Estimated Time </label>
                    <div class="form-group">                                
                        <input type="text" id="airport_station_estimate_time" name="airport_station_estimate_time" class="form-control" placeholder="Airport Station Estimated Time" value="{{$templeSubCategoryDetail->airport_station_estimate_time}}" >
                    </div>
                    @if ($errors->has('airport_station_estimate_time'))
                        <span class="text-danger">{{ $errors->first('airport_station_estimate_time') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Via Railway Station KM">Via Railway Station KM</label>
                    <div class="form-group">                                
                        <input type="text" id="via_railway_station_km" name="via_railway_station_km" class="form-control" placeholder="Via Railway Station KM" value="{{$templeSubCategoryDetail->via_railway_station_km}}">
                    </div>
                    @if ($errors->has('via_railway_station_km'))
                        <span class="text-danger">{{ $errors->first('via_railway_station_km') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Via Railway Station Map Link">Via Railway Station Map Link </label>
                    <div class="form-group">                                
                        <input type="text" id="via_railway_station_map_link" name="via_railway_station_map_link" class="form-control" placeholder="Via Railway Station Map Link" value="{{$templeSubCategoryDetail->via_railway_station_map_link}}" >
                    </div>
                    @if ($errors->has('via_railway_station_map_link'))
                        <span class="text-danger">{{ $errors->first('via_railway_station_map_link') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Via Railway Station Estimated Time">Via Railway Station Estimated Time</label>
                    <div class="form-group">                                
                        <input type="text" id="via_railway_station_estimate_time" name="via_railway_station_estimate_time" class="form-control" placeholder="Via Railway Station Estimated Time" value="{{$templeSubCategoryDetail->via_railway_station_estimate_time}}">
                    </div>
                    @if ($errors->has('via_railway_station_estimate_time'))
                        <span class="text-danger">{{ $errors->first('via_railway_station_estimate_time') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Bus Stop KM">Bus Stop KM</label>
                    <div class="form-group">                                
                        <input type="text" id="bus_stop_km" name="bus_stop_km" class="form-control" placeholder="Bus Stop KM" value="{{$templeSubCategoryDetail->bus_stop_km}}" >
                    </div>
                    @if ($errors->has('bus_stop_km'))
                        <span class="text-danger">{{ $errors->first('bus_stop_km') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Bus Stop Map Link">Bus Stop Map Link </label>
                    <div class="form-group">                                
                        <input type="text" id="bus_stop_map_link" name="bus_stop_map_link" class="form-control" placeholder="Bus Stop Map Link" value="{{$templeSubCategoryDetail->bus_stop_map_link}}" >
                    </div>
                    @if ($errors->has('bus_stop_map_link'))
                        <span class="text-danger">{{ $errors->first('bus_stop_map_link') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Bus Stop Estimated Time">Bus Stop Estimated Time </label>
                    <div class="form-group">                                
                        <input type="text" id="bus_stop_estimate_time" name="bus_stop_estimate_time" class="form-control" placeholder="Bus Stop Estimated Time" value="{{$templeSubCategoryDetail->bus_stop_estimate_time}}" >
                    </div>
                    @if ($errors->has('bus_stop_estimate_time'))
                        <span class="text-danger">{{ $errors->first('bus_stop_estimate_time') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Photo">Photo</label>
                    @if ($templeSubCategoryDetail->photo)
                    <a href="{{ asset('sub-category-temple/'.$templeSubCategoryDetail->photo) }}" target="_blank">{{ $templeSubCategoryDetail->photo }}</a>
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div>   
                <div class=" col-md-12">
                    <label for="Description">Description</label>
                    <div class="form-group">                                
                        <textarea class="form-control editor" name="description">{{$templeSubCategoryDetail->description}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif 
                </div> 
            </div>
                <button type="submit" class="btn btn-primary">UPDATE</button>
            </form>
        </div>
    </div>
</section>
@stop
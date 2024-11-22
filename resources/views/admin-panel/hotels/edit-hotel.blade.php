@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Hotel Edit</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminHotelList')}}"> Hotel List</a></li>
                        <li class="breadcrumb-item active">Hotel Edit</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminHotelUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                    <div class="col-lg-6 col-md-12">
                        <label for="Name">Language<span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between flex-wrap">
                            @foreach ($languages as $language)
                            <div>
                                <label for="language">{{$language->name}}</label>
                                <input type="radio" value="{{$language->id}}" {{ $hotel_detail->language_id === $language->id ? "checked" : "" }} name="language_id">
                            </div> 
                            @endforeach
                        </div>
                        @if ($errors->has('language_id'))
                        <span class="text-danger">{{ $errors->first('language_id') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-12"></div>
                <div class="col-lg-6 col-md-12">
                    <label for="Hotel Name">Hotel Name<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="hidden" id="id" name="id" class="form-control" value="{{$hotel_detail->id}}" required>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Hotel Name" value="{{$hotel_detail->name}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif 
                </div>

                <div class="col-lg-6 col-md-12">
                    <label for="Mobile Number">Mobile Number<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Mobile Number" value="{{$hotel_detail->mobile_number}}" required maxlength="10" pattern="[6-9]{1}[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div> 
                    @if ($errors->has('mobile_number'))
                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Address">Address<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{$hotel_detail->address}}" required>
                    </div> 
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Hotel Photo">Hotel Photo </label>
                    @if ($hotel_detail->photo)
                    <a href="{{ asset('hotels/'.$hotel_detail->photo) }}" target="_blank">{{ $hotel_detail->photo }}</a>
                    @else
                    
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-1">Image - 1 </label>
                    @if ($hotel_detail->image1)
                    <a href="{{ asset('hotels/'.$hotel_detail->image1) }}" target="_blank">{{ $hotel_detail->image1 }}</a>
                    @else
                    
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="image1" name="image1" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('image1'))
                        <span class="text-danger">{{ $errors->first('image1') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-2">Image - 2</label>
                    @if ($hotel_detail->image2)
                    <a href="{{ asset('hotels/'.$hotel_detail->image2) }}" target="_blank">{{ $hotel_detail->image2 }}</a>
                    @else
                    
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="image2" name="image2" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('image2'))
                        <span class="text-danger">{{ $errors->first('image2') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-3">Image - 3 </label>
                    @if ($hotel_detail->image3)
                    <a href="{{ asset('hotels/'.$hotel_detail->image3) }}" target="_blank">{{ $hotel_detail->image3 }}</a>
                    @else
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="image3" name="image3" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('image3'))
                        <span class="text-danger">{{ $errors->first('image3') }}</span>
                    @endif   
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">UPDATE</button>
            </form>
        </div>
    </div>
</section>
@stop
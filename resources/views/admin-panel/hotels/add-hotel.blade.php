@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Hotel Add</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminHotelList')}}"> Hotel List</a></li>
                        <li class="breadcrumb-item active">Hotel Add</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminHotelSave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                    <div class="col-lg-6 col-md-12">
                        <label for="Name">Language<span class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between flex-wrap">
                            @foreach ($languages as $language)
                            <div>
                                <label for="language">{{$language->name}}</label>
                                <input type="radio" value="{{$language->id}}" {{ $language->name === "English" ? "checked" : "" }} name="language_id">
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
                        <input type="text" id="name" name="name" class="form-control" placeholder="Hotel Name" value="{{old('name')}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Mobile Number">Mobile Number<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control" placeholder="Mobile Number" value="{{old('mobile_number')}}" required maxlength="10" pattern="[6-9]{1}[0-9]{9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div> 
                    @if ($errors->has('mobile_number'))
                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Address">Address<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{old('address')}}" required>
                    </div> 
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Hotel Photo">Hotel Photo <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-1">Image - 1 <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="file" id="image1" name="image1" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    @if ($errors->has('image1'))
                        <span class="text-danger">{{ $errors->first('image1') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-2">Image - 2 <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="file" id="image2" name="image2" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    @if ($errors->has('image2'))
                        <span class="text-danger">{{ $errors->first('image2') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Image-3">Image - 3 <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="file" id="image3" name="image3" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    @if ($errors->has('image3'))
                        <span class="text-danger">{{ $errors->first('image3') }}</span>
                    @endif   
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </form>
        </div>
    </div>
</section>
@stop
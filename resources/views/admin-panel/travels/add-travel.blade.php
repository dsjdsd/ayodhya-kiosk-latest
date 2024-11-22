@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Travel Add</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminTravelList')}}"> Travel List</a></li>
                        <li class="breadcrumb-item active">Travel Add</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminTravelSave')}}" method="post" enctype="multipart/form-data">
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
                    <label for="Travel Type">Travel Type<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="type" name="type" class="form-control" placeholder="Travel Type" value="{{old('type')}}" required>
                    </div>
                    @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Photo">Photo <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </form>
        </div>
    </div>
</section>
@stop
@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Setting Update</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting Update</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminSettingSave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                <div class="col-lg-6 col-md-12">
                    <label for="Title">Title<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" value="{{ isset($setting->title) ? $setting->title : '' }}">                    </div>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif 
                </div>  
                <div class="col-lg-6 col-md-12">
                    <label for="Logo-1">Logo - 1 <span class="text-danger">*</span></label>
                    @if (isset($setting->logo1) && $setting->logo1)
                        <a href="{{ asset('settings/'.$setting->logo1) }}" target="_blank">{{ $setting->logo1 }}</a>
                     @endif
                    <div class="form-group">                                
                        <input type="file" id="logo1" name="logo1" class="form-control" accept=".png, .jpg, .jpeg" fequired>
                    </div>
                    @if ($errors->has('logo1'))
                        <span class="text-danger">{{ $errors->first('logo1') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Logo-2">Logo - 2</label>
                    @if (isset($setting->logo2) && $setting->logo2)
                        <a href="{{ asset('settings/'.$setting->logo2) }}" target="_blank">{{ $setting->logo2 }}</a>
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="logo2" name="logo2" class="form-control" accept=".png, .jpg, .jpeg" >
                    </div>
                    @if ($errors->has('logo2'))
                        <span class="text-danger">{{ $errors->first('logo2') }}</span>
                    @endif   
                </div>   
                <div class="col-lg-6 col-md-12">
                    <label for="Sponsorship By Logo">Sponsorship By Logo </label>
                    @if (isset($setting->sponsorship_by_logo) && $setting->sponsorship_by_logo)
                        <a href="{{ asset('settings/'.$setting->sponsorship_by_logo) }}" target="_blank">{{ $setting->sponsorship_by_logo }}</a>
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="sponsorship_by_logo" name="sponsorship_by_logo" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('sponsorship_by_logo'))
                        <span class="text-danger">{{ $errors->first('sponsorship_by_logo') }}</span>
                    @endif   
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</section>
@stop
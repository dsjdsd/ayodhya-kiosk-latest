@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Temples Category Edit</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminTempleCategoryList')}}"> Temples Category List</a></li>
                        <li class="breadcrumb-item active">Temples Category Edit</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminTempleCategoryUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                <div class="col-lg-6 col-md-12">
                    <label for="Temple Category Name">Temples Category Name<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="hidden" id="id" name="id" class="form-control"  value="{{$temples_category_detail->id}}" required>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Temple Category Name" value="{{$temples_category_detail->name}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Photo">Photo </label>
                    @if ($temples_category_detail->photo)
                    <a href="{{ asset('temple-categories/'.$temples_category_detail->photo) }}" target="_blank">{{ $temples_category_detail->photo }}</a>
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">UPDATE</button>
            </form>
        </div>
    </div>
</section>
@stop
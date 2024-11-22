@extends('admin-panel.includes.master')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Arti</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminArtiList')}}">Arti List</a></li>
                        <li class="breadcrumb-item active">Add Arti</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
       
        <div class="container-fluid">
            <form  action="{{route('adminTempleWiseArtiSave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                    <div class="col-lg-12 col-md-12">
                        <label for="Arti Name">Temples<span class="text-danger">*</span></label>
                        <div class="form-group">                                
                            <select name="temple_id" class="form-control" id="temple_id" required>
                                <option value="">- select temple --</option>
                                @foreach ($ayodhyaDhamTemple as $temple)
                                <option value="{{$temple->id}}">{{$temple->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('temple_id'))
                                <span class="text-danger">{{ $errors->first('temple_id') }}</span>
                            @endif 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="Arti Name">Arti Name<span class="text-danger">*</span></label>
                        <div class="form-group">                                
                            <input type="text" id="arti_name" name="arti_name" class="form-control" placeholder="Arti Name" required>
                            @if ($errors->has('arti_name'))
                                <span class="text-danger">{{ $errors->first('arti_name') }}</span>
                            @endif 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="Arti Time">Arti Time <span class="text-danger">*</span></label>
                        <div class="form-group">                                
                            <input type="text" id="arti_time" name="arti_time" class="form-control" placeholder="Arti Time" required>
                            @if ($errors->has('arti_time'))
                                <span class="text-danger">{{ $errors->first('arti_time') }}</span>
                            @endif 
                        </div>
                    </div>
                    </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
               
            </form>
        </div>
    </div>
</section>

@stop
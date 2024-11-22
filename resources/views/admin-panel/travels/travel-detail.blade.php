@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>{{$travel->type}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminTravelList')}}"> Travel List</a></li>
                        <li class="breadcrumb-item active">{{$travel->type}}</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminTravelDetailUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" >
                <div class="col-lg-6 col-md-12">
                    <label for="Name">Name<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="hidden" id="travel_id" name="travel_id" class="form-control" value="{{$travel->id}}"  required>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{$travel->name}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Open timings">Open timings <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="open_time" name="open_time" class="form-control" placeholder="Open timings" value="{{$travel->open_time}}" required>
                    </div>
                    @if ($errors->has('open_time'))
                        <span class="text-danger">{{ $errors->first('open_time') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Address">Address <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="{{$travel->address}}" required>
                    </div>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Via Airport">Via {{$travel->name}} <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="via_airport" name="via_airport" class="form-control" placeholder="Via Airport" value="{{$travel->via_airport}}" required>
                    </div>
                    @if ($errors->has('via_airport'))
                        <span class="text-danger">{{ $errors->first('via_airport') }}</span>
                    @endif 
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Estimated Time">Estimated Time <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="estimate_time" name="estimate_time" class="form-control" placeholder="Estimated Time" value="{{$travel->estimate_time}}" required>
                    </div>
                    @if ($errors->has('estimate_time'))
                        <span class="text-danger">{{ $errors->first('estimate_time') }}</span>
                    @endif 
                </div>

                <div class="col-lg-6 col-md-12">
                    <label for="Photo">Photo</label>
                    @if ($travel->photo)
                        <a href="{{ asset('travel_details/'.$travel->photo) }}" target="_blank">{{ $travel->photo }}</a>
                    @else
                       
                    @endif
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg">
                    </div>
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif   
                </div> 
                <div class="col-lg-12 col-md-12">
                    <label for="Description">Description</label>
                    <div class="form-group">                                
                        <textarea class="form-control editor" name="description">{{$travel->description}}</textarea>
                    </div>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif 
                </div>   
            </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </form>
        </div>
    </div>
</section>
@stop
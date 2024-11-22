@extends('admin-panel.includes.master')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Details Near the Temple</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminArtiList')}}">List Details Near the Temple</a></li>
                        <li class="breadcrumb-item active">Add Details Near the Temple</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
       
        <div class="container-fluid">
            <form  action="{{route('adminSaveNearMe')}}" method="post" enctype="multipart/form-data">
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
                        <label for="Near Me Name">Near Me Name<span class="text-danger">*</span></label>
                        <div class="form-group">                                
                            <input type="text" id="name" name="name" class="form-control" placeholder="Near Me Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="What is the distance of the Temple">What is the distance of the Temple<span class="text-danger">*</span></label>
                        <div class="form-group">                                
                            <input type="text" id="distance" name="distance" class="form-control" placeholder="What is the distance of the Temple" required>
                            @if ($errors->has('distance'))
                                <span class="text-danger">{{ $errors->first('distance') }}</span>
                            @endif 
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="Photo">Photo <span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg"
                                required>
                        </div>
                        @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                        @endif
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="Description">Description</label>
                        <div class="form-group">
                            <textarea class="form-control editor" name="description">{{old('description')}}</textarea>
                        </div>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    </div>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
               
            </form>
        </div>
    </div>
</section>

@stop
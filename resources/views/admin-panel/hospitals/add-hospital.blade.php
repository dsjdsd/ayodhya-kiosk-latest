@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Hospital Add</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('adminHospitalList')}}"> Hospital List</a></li>
                        <li class="breadcrumb-item active">Hospital Add</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form  action="{{route('adminHospitalSave')}}" method="post" enctype="multipart/form-data">
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
                <div class="col-lg-6 col-md-12">
                    <label for="Name">Name<span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{old('name')}}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
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
                    <label for="Pincode">Pincode</label>
                    <div class="form-group">                                
                        <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Pincode" value="{{old('pincode')}}" maxlength="6" pattern="[0-9]{6}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="category">Category / Type <span class="text-danger">*</span></label>
                    <div class="form-group">                                
                        <select name="category" id="category" class="form-control" required>
                            <option value="">-- Select Category / Type --</option>
                            <option value="public" {{ old('category') == "public" ? "selected" : "" }}>Public</option>
                        </select>
                    </div> 
                    @if ($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                    @endif  
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="Photo">Photo</label>
                    <div class="form-group">                                
                        <input type="file" id="photo" name="photo" class="form-control" accept=".png, .jpg, .jpeg">
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
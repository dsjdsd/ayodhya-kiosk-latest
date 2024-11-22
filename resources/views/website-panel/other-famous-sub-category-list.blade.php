@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/jain-temples.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('otherFamousTemple') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
    <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg mt-3">
<div class="d-flex justify-content-between align-items-end">
    <h4 class="place_heading">{{$templeCategory->name}}</h4>
    <small>{{ now('Asia/Kolkata')->format('d-m-Y :H:i:s') }}</small>
</div>
<div class="row place_row mt-3">
    @foreach ($subCategoryList as $subCategory)
    <div class="col-6">
        <a href="{{url('other-famous-sub-category-detail/'.Crypt::encryptString($subCategory->id))}}" class="category_card_div">
            <img src="{{asset('sub-category-temple/'.$subCategory->photo)}}" alt="temples" class="category_image" />
            <p class="place_card_text text-nowrap">{{$subCategory->name}}</p>
        </a>
    </div>    
    @endforeach
</div>
</div>
@endsection
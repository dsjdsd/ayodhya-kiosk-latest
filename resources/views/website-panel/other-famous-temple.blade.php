@extends('website-panel.includes.master')
@section('content')
<link href="{{asset('website-assets/css/ghat.css')}}" rel="stylesheet" />
<div class="header">
    <div class="ribbon d-flex justify-content-between">
        <a href="{{ route('welcome') }}" class="ribbon-text"><i class="fa fa-angle-left"></i> Back</a>
        <div class="ribbon-text">Welcome</div>
        <a href="{{route('/')}}" class="ribbon-text">Home</a>
    </div>
</div>
<div class="place_bg">
    <div class="d-flex justify-content-between align-items-end">
        <h4 class="place_heading">Other Famous Places</h4>
        <div class="welcome_logo_div">
            <img src="{{asset('website-assets/image/logo.png')}}" />
            <img src="{{asset('website-assets/image/ayodya_logo.png')}}" />
        </div>

    </div>
    <div class="row place_row mt-3">
        @foreach ($templeCategory as $templeCategory)
        <div class="col-6">
            <a href="{{url('other-famous-sub-category/'.Crypt::encryptString($templeCategory->id))}}" class="category_card_div">
                <img src="{{asset('temple-categories/'.$templeCategory->photo)}}" alt="temples"
                    class="category_image" />
                <p class="other_card_text text-nowrap">{{$templeCategory->name}}</p>
            </a>
        </div>
        @endforeach
        @foreach ($otherFamousPlace as $otherTemple)
        <div class="col-6">
            <a href="{{url('other-famous-temple-detail/'.Crypt::encryptString($otherTemple->id))}}" class="category_card_div">
                <img src="{{asset('other-temples/'.$otherTemple->photo)}}" alt="Ghat" class="category_image" />
                <p class="other_card_text1 text-nowrap">{{$otherTemple->name}}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
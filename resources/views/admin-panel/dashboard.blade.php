@extends('admin-panel.includes.master')
@section('content')
<style>
body {
    margin-top: 20px;
    background: #FAFAFA;
}

.order-card {
    color: #fff;
}

.bg-c-blue {
    /* background: linear-gradient(45deg, #4099ff, #73b4ff); */
    background:#a17421;
}

.bg-c-green {
    /* background: linear-gradient(45deg, #2ed8b6, #59e0c5); */
    background: #1ea9d7;
}

.bg-c-yellow {
    /* background: linear-gradient(45deg, #FFB64D, #ffcb80); */
    background: #5e5e28;
}

.bg-c-pink {
    /* background: linear-gradient(45deg, #FF5370, #ff869a); */
    background: #5e2828
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i>
                                Dashboard</a></li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminAyodhyaDhamTempleList')}}">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Ayodhya Dham Temples</h6>
                                        <h2 class="text-right mb-0">
                                        <i class='fas fa-gopuram  f-left'></i>
                                            <!-- <i class="fas fa-landmark f-left"></i> -->
                                                <span>{{$ayodhya_total_dham_temples}}</span>
                                        </h2>
                                        <!-- <a href="{{route('adminAyodhyaDhamTempleList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminAyodhyaDhamGhatList')}}">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Ayodhya Dham Ghat</h6>
                                        <h2 class="text-right mb-0">
                                        <i class="fas fa-water f-left"></i>
                                            <!-- <i class="fas fa-landmark f-left"></i> -->
                                                <span>{{$ayodhya_total_dham_ghats}}</span>
                                        </h2>
                                        <!-- <a href="{{route('adminAyodhyaDhamGhatList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminTempleCategoryList')}}">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Famous Temple Category</h6>
                                        <h2 class="text-right mb-0">
                                            <!-- <i class="fas fa-landmark f-left"></i> -->
                                            <i class='fas fa-gopuram  f-left'></i>
                                            <span>{{$total_other_famous_category_temples}}</span>
                                        </h2>
                                        <!-- <a href="{{route('adminTempleCategoryList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminTempleList')}}">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Other Famous Temples</h6>
                                        <h2 class="text-right mb-0">
                                        <i class="fas fa-place-of-worship f-left"></i>
                                            <!-- <i class="fas fa-hotel f-left"></i> -->
                                            <span>{{$total_other_temples}}</span>
                                        </h2>
                                        <!-- <a href="{{route('adminTempleList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminHotelList')}}">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Hotels</h6>
                                        <h2 class="text-right mb-0">
                                            <!-- <i class="fas fa-university f-left"></i> -->
                                            <i class="fas fa-hotel f-left"></i>
                                            <span>{{$total_hotels}}</span></h2>
                                        <!-- <a href="{{route('adminHotelList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminBankList')}}">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Banks</h6>
                                        <h2 class="text-right mb-0"><i
                                        class="fas fa-landmark f-left"></i><span>{{$total_banks}}</span></h2>
                                        <!-- <a href="{{route('adminBankList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <a href="{{route('adminHospitalList')}}">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Hospitals</h6>
                                        <h2 class="text-right mb-0">
                                                <i
                                                class="fas fa-hospital f-left"></i>
                                                <span>{{$total_hospitals}}</span>
                                        </h2>
                                        <!-- <a href="{{route('adminHospitalList')}}" class="view-more">View More</a> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@stop
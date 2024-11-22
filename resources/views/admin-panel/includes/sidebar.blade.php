<!-- Left Sidebar -->
@php
    $currentRouteName = Route::currentRouteName();
@endphp
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu text-white"></i></button>
        <a href="{{route('adminDashboard')}}"><span class="m-l-10 text-white">Shree Ayodhya ji </br>Teerth Vikas Parishad</span></a>
    </div>
    <div class="menu">
       
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="{{route('adminDashboard')}}"><img src="{{asset('images/03-09-2024-1725342769-download.png')}}" alt="User"></a>
                    <div class="detail">
                        <h4>{{ Auth::user()->name }}</h4>              
                    </div>
                </div>
            </li>
            <li class="{{ $currentRouteName == 'adminDashboard' ? 'active' : '' }}">
                <a href="{{route('adminDashboard')}}">
                    <i class="zmdi zmdi-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ in_array($currentRouteName, ['adminAyodhyaDhamTempleList','adminAyodhyaDhamGhatList','adminTempleWiseArtiAdd']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-map"></i>
                    <span>Ayodhya Dham</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ $currentRouteName == 'adminAyodhyaDhamTempleList' ? 'active' : '' }}">
                        <a href="{{route('adminAyodhyaDhamTempleList')}}">
                            <span>Temples</span>
                        </a>
                    </li>
                    <li class="{{ $currentRouteName == 'adminAyodhyaDhamGhatList' ? 'active' : '' }}">
                        <a href="{{route('adminAyodhyaDhamGhatList')}}">
                            <span>Ghat</span>
                        </a>
                    </li>                
                    <li class="{{ $currentRouteName == 'adminArtiList' ? 'active' : '' }}">
                        <a href="{{route('adminArtiList')}}">
                            <span>Temple Arti List</span>
                        </a>
                    </li>                
                    <li class="{{ $currentRouteName == 'adminNearMeList' ? 'active' : '' }}">
                        <a href="{{route('adminNearMeList')}}">
                            <span>Temple Near Detail</span>
                        </a>
                    </li>                
                </ul>
            </li>
            <li class="{{ in_array($currentRouteName, ['adminTempleCategoryList','adminTempleList']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-globe"></i>
                    <span>Other Famous Places</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ $currentRouteName == 'adminTempleCategoryList' ? 'active' : '' }}">
                        <a href="{{route('adminTempleCategoryList')}}">
                            <span>Temples Category</span>
                        </a>
                    </li>
                    <li class="{{ $currentRouteName == 'adminTempleList' ? 'active' : '' }}">
                        <a href="{{route('adminTempleList')}}">
                            <span>Temples</span>
                        </a>
                    </li>                               
                </ul>
            </li>
            <li class="{{ in_array($currentRouteName, ['adminTravelList']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-airplane"></i>
                    <span>Travels</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ $currentRouteName == 'adminTravelList' ? 'active' : '' }}">
                        <a href="{{ route('adminTravelList') }}">
                            <span>All Travel List</span>
                        </a>
                        @foreach (travelList() as $travel)
                            @if($travel->type == "Accommodation")
                                <a href="{{ route('adminHotelList') }}" >{{ $travel->type }}</a>
                            @else
                                <a href="{{ url('admin/travel-detail/' . Crypt::encryptString($travel->id)) }}" >{{ $travel->type }}</a>
                            @endif
                        @endforeach
                        </li>                        
                </ul>
            </li>

            <li class="{{ in_array($currentRouteName, ['adminHospitalList','adminBankList']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-alert-circle"></i>
                    <span>Emergency</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ $currentRouteName == 'adminHospitalList' ? 'active' : '' }}">
                        <a href="{{route('adminHospitalList')}}">
                            <span>Hospitals</span>
                        </a>
                    </li>                             
                    <li class="{{ $currentRouteName == 'adminBankList' ? 'active' : '' }}">
                        <a href="{{route('adminBankList')}}">
                            <span>Banks</span>
                        </a>
                    </li> 
                </ul>
            </li>
            
            
            <li class="{{ in_array($currentRouteName, ['adminSetting','adminChangePassword']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="zmdi zmdi-settings"></i>
                    <span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ $currentRouteName == 'adminSetting' ? 'active' : '' }}">
                        <a href="{{route('adminSetting')}}">
                            <span>Settings</span>
                        </a>
                    </li>                             
                    <li class="{{ $currentRouteName == 'adminChangePassword' ? 'active' : '' }}">
                        <a href="{{route('adminChangePassword')}}">
                            <span>Change Password</span>
                        </a>
                    </li>                             
                </ul>
            </li>
            <li class="open">
                <a href="{{route('adminLogout')}}">
                    <i class="zmdi zmdi-power"></i>
                    <span>Log out</span>
                </a>
            </li>
            
            
            
        </ul>
    </div>
</aside>
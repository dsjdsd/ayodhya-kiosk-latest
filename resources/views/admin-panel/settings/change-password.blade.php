@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Change Password</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form action="{{ route('adminUpdatePassword') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="old_password">Current Password <span class="text-danger">*</span></label>
                        <div class="form-group position-relative">
                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" required>
                            <span class="toggle-password" toggle="#old_password" style="cursor: pointer; position: absolute; right: 10px; top: 10px;">
                                <i class="fas fa-eye" id="old_password_icon"></i>
                            </span>
                        </div>
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif 
                    </div>
        
                    <div class="col-lg-6 col-md-12">
                        <label for="new_password">New Password <span class="text-danger">*</span></label>
                        <div class="form-group position-relative">
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" required>
                            <span class="toggle-password" toggle="#new_password" style="cursor: pointer; position: absolute; right: 10px; top: 10px;">
                                <i class="fas fa-eye" id="new_password_icon"></i>
                            </span>
                        </div>
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif 
                    </div>    
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            const input = $(this).attr('toggle');
            const $inputField = $(input);
            const $icon = $(this).find('i');

            if ($inputField.attr('type') === 'password') {
                $inputField.attr('type', 'text');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $inputField.attr('type', 'password');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@stop
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Shree Ayodhya ji Teerth Vikas Parishad</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">    
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">   
</head>
<body class="theme-blush">
<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 m-auto">
                <form class="card auth_form" id="login_form" method="POST" action="{{url('admin-login-check')}}">
                @csrf
                  <div class="header">
                        <img class="w-25" src="{{asset('images/logo.png')}}" alt="">
                        <h6></h6>
                        <h5>Admin Log-In</h5>
                    </div>
                    <div class="body">
                        <div class="input-group  user_name_div">
                            <input type="email" class="form-control" placeholder="Email-Id" name="email" id="email" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        <div class="input-group mt-3 password_div">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                            <div class="input-group-append">                                
                                <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                            </div>                            
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <input type="submit" class="btn btn-block waves-effect waves-light mt-3" name="sign_in" value="SIGN IN"/>
                     
                    </div>
                </form>
                <div class="copyright text-center text-white">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="https://www.softgentech.com/" class="text-decoration-none text-white">Softgen Technologies</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
@endif

@if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
@endif

@if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
@endif

@if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
@endif
</script>
</body>
</html>
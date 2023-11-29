<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Login Admin | AutoFast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href={{ asset('assets\images\favicon.ico') }}>

    <!-- Bootstrap Css -->
    <link href={{ asset('assets\css\bootstrap.min.css') }} id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href={{ asset('assets\css\icons.min.css') }} rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href={{ asset('assets\css\app.min.css') }} id="app-style" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Chào mừng chở lại !</h5>
                                        <p>Hãy đăng nhập để tiếp tục</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src={{ asset('assets\images\profile-img.png') }} alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src={{ asset('assets\images\logo.svg') }} alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('login.submit') }}" method="POST">
                                    <div class="form-group">
                                        <label for="username">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="Nhập số điện thoại">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Mật khẩu </label>
                                        <input type="password" name="password" class="form-control" id="userpassword"
                                            placeholder="Nhập mật khẩu">
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customControlInline">Remember
                                            me</label>
                                    </div>
                                    @csrf
                                    @if ($errors->has('login'))
                                        <div class="mt-2 alert alert-danger">
                                            {{ $errors->first('login') }}
                                        </div>
                                    @endif
                                    <div class="mt-3">
                                        <button class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets\libs\jquery\jquery.min.js"></script>
    <script src="assets\libs\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="assets\libs\metismenu\metisMenu.min.js"></script>
    <script src="assets\libs\simplebar\simplebar.min.js"></script>
    <script src="assets\libs\node-waves\waves.min.js"></script>

    <!-- App js -->
    <script src="assets\js\app.js"></script>
    <script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
</body>

</html>

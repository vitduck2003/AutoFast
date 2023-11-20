
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Register | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App js -->
        <script src="assets/js/plugin.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </head>

    <body>

        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary-subtle">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Register Staff</h5>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="p-2">
                                    <form action="{{route('staff.register')}}" method="POST" class="needs-validation" novalidate action="index.html">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>  
                                            <div class="invalid-feedback">
                                                Please Enter Email
                                            </div>      
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Họ và tên" required>
                                            <div class="invalid-feedback">
                                                Please Enter Username
                                            </div>  
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
                                            <div class="invalid-feedback">
                                                Please Enter phone
                                            </div>  
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Mật Khẩu</label>
                                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Mật khẩu" required>
                                            <div class="invalid-feedback">
                                                Please Enter Password
                                            </div>       
                                        </div>
                                        <div>
                                            @if ($errors->any())
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="color:red">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>

                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Đăng Ký</button>
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
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- validation init -->
        <script src="assets/js/pages/validation.init.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
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

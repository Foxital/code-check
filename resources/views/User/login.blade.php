@extends('User.layouts.app',['date'=>$data])

@section('content')

<style>

.page-title{
    overflow:hidden;
}

.register-section{
    overflow:hidden;
}
    .socialsvg{
        margin-right: 5px;
    }
    
    .social{
        border-radius: 40px;
    }
    
    
    .page-title{
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/login-desk.jpg?updatedAt=1691746684366);
    }
    
    .field-icon {
  float: right;
  margin-right: 20px;
  margin-top: -33px;
  position: relative;
  z-index: 2;
}
        
    
/*-----For mobile: ---------------*/    
@media (max-width: 480px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/mob.jpg?updatedAt=1692028778073);
    }
}

/*-----For tablets: ---------------*/
@media (min-width: 481px) and (max-width: 1024px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/mob.jpg?updatedAt=1692028778073);
    }
}

@media (min-width: 1025px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/login-desk.jpg?updatedAt=1691746684366);
   }
}

</style>

<!-- Page Title -->
    <section class="page-title">
        <div class="auto-container" >
			<h2 style="color:#254e58">Login and Register Page</h2>
        </div>
    </section>
    <!-- End Page Title -->
    

	<!-- Register Section -->
    <div class="register-section">
    	<div class="auto-container">
        	<div class="inner-container">
				<div class="row clearfix">
					<!-- Column -->
					<div class="column col-lg-6 col-md-12 col-sm-12">
						<!-- Login Form -->
						<div class="styled-form">
							<h4>Register Here</h4>
							<form method="post"  id="cussignupform" autocomplete="off" >
							    @csrf
							    @error('email')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
							    <input type="hidden" value="{{ isset($_REQUEST['referral_id'])?$_REQUEST['referral_id']:'' }}" name="referralid" />
								<div class="form-group">
									<label for="username">{{ __('Username') }}</label>
									<input id="username" type="text" name="username" value="" required autocomplete="username" autofocus placeholder="Enter your name*" required>
								</div>
								<div class="form-group">
									<label for="email">{{ __('E-Mail') }}</label>
									<input id="remail" type="email" name="email" value="" required autocomplete="email" placeholder="Enter Email Adress*" required>
								</div>
								@error('email')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
								<div class="form-group">
									<label for="password" >{{ __('Password') }}</label>
									<input  id="rpassword" type="password" name="password" value="" required autocomplete="current-password"  placeholder="Create password*" required>
									<span toggle="#rpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								@error('password')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
						        <div class="form-group">
									<button type="submit" id="signup-btn" class="theme-btn btn-style-one">
										Sign Up
									</button>
								</div>
								<div class="form-group">
									<a type="submit" href="{{ route('user.login.google') }}"  class="theme-btn btn-style-one social">
									<svg class="socialsvg" xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 488 512"><style>svg{fill:#ffffff}</style>
									<path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>    
										Sign Up
									</a>
									<a type="submit" href="{{ route('user.login.facebook') }}"  class="theme-btn btn-style-one social">
									<svg class="socialsvg" xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 320 512"><style>svg{fill:#ffffff}</style>
									<path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>    
										Sign Up
									</a>
								</div>
							</form>
						</div>
					</div>
					<!-- Column -->
					<div class="column col-lg-6 col-md-12 col-sm-12">
						<!-- Login Form -->
						<div class="styled-form">
							<h4>Login here</h4>
							<form method="post" id="cusloginform" autocomplete="off">
							    @csrf
							     @error('email')
                                <span>
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
								<div class="form-group">
									<label for="email">Email address</label>
									<input  id="email" type="email"  name="email" placeholder="your@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
								</div>
								@error('email')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
								
								<div class="form-group">
									<label for="password">{{ __('Password') }}</label>
									<input id="password" type="password"  name="password" value="" placeholder="Enter password" required autocomplete="current-password">
									<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
								</div>
								@error('password')
                                <span >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
								<div class="form-group">
									<div class="check-box">
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} name="remember-password" id="type-2"> 
										<label for="type-2">{{ __('Remember Me') }}</label>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="theme-btn btn-style-one">
										{{ __('Login') }}
									</button>
								</div>
								<div class="form-group">
									<a type="submit" href="{{ route('user.login.google') }}" class="theme-btn btn-style-one social">
									<svg class="socialsvg" xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 488 512"><style>svg{fill:#ffffff}</style>
									<path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>    
										Login
									</a>
									<a type="submit" href="{{ route('user.login.facebook') }}" class="theme-btn btn-style-one social">
									<svg class="socialsvg" xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 320 512"><style>svg{fill:#ffffff}</style>
									<path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>    
										Login
									</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Register Section -->



 <script>
        $('#cusloginform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.login.check') }}",
                type: 'POST',
                data: $('#cusloginform').serialize(),
                error: function(err) {
                    var geterr = err.responseJSON.errors;
                    var erromg = '<ul>';
                    for (var prop in geterr) {
                        erromg += '<li>' + geterr[prop][0] + '</li>'
                    }
                    erromg += '</ul>';
                    toastr.error(erromg);
                },
                success: function(res) {
                    toastr.clear();
                    if (res.success == '1') {
                        toastr.success('Success');
                        window.location.replace('/');
                    } else {
                        toastr.error('Error', 'Email and Password Not Match!');
                    }
                }
            });
        });
        $('#cussignupform').submit(function(e) {
            e.preventDefault();
          
            
            $.ajax({
                url: "{{ route('user.signup.check') }}",
                type: 'POST',
                data: $('#cussignupform').serialize(),
                error: function(err) {
                    var geterr = err.responseJSON.errors;
                    var erromg = '<ul>';
                    for (var prop in geterr) {
                        erromg += '<li>' + geterr[prop][0] + '</li>'
                    }
                    erromg += '</ul>';
                    toastr.error(erromg);
                },
                success: function(obj) {
                    toastr.clear();
                    if (obj.success == '1') {
                        toastr.success('Success');
                        window.location.replace('/');
                    } else {
                        toastr.error('Error', 'Please Try Again!');
                    }
                }
            });
        });

       $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

    </script>
    @endsection

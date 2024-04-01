<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<style media="screen">
        *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}


.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}

.login-form{
    height: 520px;
    width: 400px;
    background-color: rgba(0,0,0,0.7);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
.reg-form{
    height: 590px;
    width: 400px;
    background-color: rgba(0,0,0,0.7);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
  
}
.login-form *{
    font-family: 'Poppins',sans-serif;
    color: #fff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}

.reg-form *{
    font-family: 'Poppins',sans-serif;
    color: #fff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}

.login-form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

.reg-form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

.login-label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
.login-input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #fff;
}

.login-button{
    margin-top: 20px;
    width: 100%;
    background-color: #ffffff;
    color: #000;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
  cursor: pointer;
}
.social .social-btn{
 
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social .social-btn:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
  
}
.social i{
  margin-top: 10px;
  margin-right: 4px;
 
}
.login-box{
    display:none;
    top:55%;
    left:50%;
    position: fixed;
    z-index:  999999999999999999999999999;
   
}
.reg-box{
    display:none;
    top:55%;
    left:50%;
    position: fixed;
    z-index:  999999999999999999999999999;
   
}
form .close-btn{
    position: absolute;
    right:20px;
    top:-5px;
    font-size: 18px;
    cursor: pointer;
}
</style>
</head>

<div class="login-box" id="login-box">
    
    <form class="login-form" method="POST" id="cusloginform" autocomplete="off"> 
          @csrf
        <label  id="close-btn" class="login-label close-btn">x</label>
        <h3>Login Here</h3>

        <label class="login-label" for="email">Email</label>
        <input class="login-input" id="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email or Phone">

        <label class="login-label" for="password">{{ __('Password') }}</label>
        <input class="login-input" id="password" type="password" placeholder="Password" required autocomplete="current-password" >

        <button class="login-button" type="submit">{{ __('Login') }}</button>
        <div class="social">
          <a href="{{ route('user.login.google') }}"  class=" social-btn go">G  Google</a>
          <a href="{{ route('user.login.facebook') }}"  class=" social-btn fb">F  Facebook</a>
        </div>
    </form>
</div>

<div class="reg-box" id="reg-box">
    
    <form class="reg-form" method="POST" id="cusloginform" autocomplete="off"> 
          @csrf
        <label  id="reg-close-btn" class="login-label close-btn">x</label>
        <h3>Register Here</h3>
        
        <label class="login-label" for="password">Username</label>
        <input class="login-input" id="password" type="text" placeholder="Password" required autocomplete="current-password" >

        <label class="login-label" for="email">Email</label>
        <input class="login-input" id="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email or Phone">

        <label class="login-label" for="password">{{ __('Password') }}</label>
        <input class="login-input" id="password" type="password" placeholder="Password" required autocomplete="current-password" >

        <button class="login-button" type="submit">{{ __('Sign Up') }}</button>
        <div class="social">
          <a href="{{ route('user.login.google') }}"  class=" social-btn go">G  Google</a>
          <a href="{{ route('user.login.facebook') }}"  class=" social-btn fb">F  Facebook</a>
        </div>
    </form>
</div>



<script>
    document.querySelector('#login-btn').addEventListener("click", function(){
       document.querySelector("#login-box").style.display = 'block';
    });
    
    document.querySelector('#close-btn').addEventListener("click", function(){
       document.querySelector("#login-box").style.display = 'none';
    });
    
    document.querySelector('#reg-btn').addEventListener("click", function(){
       document.querySelector("#reg-box").style.display = 'block';
    });
    
    document.querySelector('#reg-close-btn').addEventListener("click", function(){
       document.querySelector("#reg-box").style.display = 'none';
    });
    
    
    //login works
    
     $('#cusloginform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.login.check') }}",
                type: 'post',
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
                        window.location.reload();
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
                        window.location.reload();
                    } else {
                        toastr.error('Error', 'Please Try Again!');
                    }
                }
            });
        });

        var eyetype = 0;

        function openeye() {
            if (eyetype == 0) {
                eyetype = 1;
                $('.passeye').removeClass('fa-eye-slash').addClass('fa-eye');
                $('.passeyeinp').attr('type', 'text');
            } else {
                eyetype = 0;
                $('.passeye').removeClass('fa-eye').addClass('fa-eye-slash');
                $('.passeyeinp').attr('type', 'password');
            }
        }
</script>
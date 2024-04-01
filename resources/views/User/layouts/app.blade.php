<?php
header("Content-Type: text/html");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-Frame-Options: SAMEORIGIN");
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($data['meta_title']))
      <title>{{ $data['meta_title'] }}</title>
    @endif
    @if(isset($data['meta_descp']))
      <meta name="description" content="{{ $data['meta_descp'] }}">
    @endif
    @if(isset($data['meta_keyword']))
      <meta name="keyword" content="{{ $data['meta_keyword'] }}">
    @endif
    
        <link rel="stylesheet" href="{{ asset('assets/vendors/lightgallery/css/lightgallery-bundle.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/mapbox-gl/mapbox-gl.min.css')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/theme.css')}}">
        
         <!-- From Old -->
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css?v=1.2') }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
        <!-- From Old -->
        
        <!-- Responsive -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script>
        toastr.options = {
            "closeButton": true
        };
    </script>
    @yield('topScript')

    
    @php
        $getscript = \App\Models\Setting::whereIn('id',[2,3])->orderBy('id')->get();
    @endphp
    
    {!! isset($getscript[0]['val'])?$getscript[0]['val']:'' !!}
    
    
    <style>
        
        .toast{
            min-height: 67px;
              width: 560px;
              max-width: 90%;
              border-radius: 12px;
              padding: 16px 22px 17px 20px;
              display: flex;
              align-items: center;
              
        }
        
        .toast-success {
              background-color: var(--black-color);
        }
        
        .toast-info {
              background-color: var(--black-color);
        }
        
        .toast-info2{
              background-color: var(--black-color);
        }
        
        
        .toast-error{
              background-color: var(--black-color);
        }
        
        .toast-warning{
            background-color: var(--black-color);
        }
        
        /*feather*/
        .snowflake {
  color: #fff;
  font-size: 1em;
  font-family: Arial;
  text-shadow: 0 0 1px #000;
}

@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%{-webkit-transform:translateX(0px);transform:translateX(0px)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}100%{-webkit-transform:translateX(0px);transform:translateX(0px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%{transform:translateX(0px)}50%{transform:translateX(80px)}100%{transform:translateX(0px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}
/* Demo Purpose Only*/
.demo {
  font-family: 'Raleway', sans-serif;
	color:#fff;
    display: block;
    margin: 0 auto;
    padding: 15px 0;
    text-align: center;
}
.demo a{
  font-family: 'Raleway', sans-serif;
color: #000;		
}
    </style>
    
</head>

<body>
    
    
<!--<div class="snowflakes" aria-hidden="true">

  <div class="snowflake">
   <img src="{{ asset('assets/images/animation/feather-1.png') }}" width="120px" height="120px">
  </div>
  <div class="snowflake">
   <img src="{{ asset('assets/images/animation/feather-2.png') }}" width="120px" height="120px">
  </div>
  <div class="snowflake">
  </div>
  <div class="snowflake">
   <img src="{{ asset('assets/images/animation/feather-3.png') }}" width="120px" height="120px">
  </div>
  <div class="snowflake">
  </div>
  <div class="snowflake">
  </div>
  <div class="snowflake">
  </div>
  <div class="snowflake">
   <img src="{{ asset('assets/images/animation/feather-2.png') }}" width="120px" height="120px">
  </div>
</div>-->
    
    <!--Google firebase Start-->
    <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-analytics.js";
  import { getMessaging } from "firebase/messaging";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDIGLhy3wSY6WKqX8lqyRS3BKUl0Ks2v-Q",
    authDomain: "reyo-web-notification.firebaseapp.com",
    projectId: "reyo-web-notification",
    storageBucket: "reyo-web-notification.appspot.com",
    messagingSenderId: "112123447542",
    appId: "1:112123447542:web:3008c498176a03f700c4d7",
    measurementId: "G-3Y6BYGYWKL"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  const messaging = firebase.messaging();
  
  
  
   messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });
  

  
</script>
<!--Google firebase End-->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-252905517-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-252905517-1');
</script>




    {!! isset($getscript[1]['val'])?$getscript[1]['val']:'' !!}
    
    @include('User.parts.nav')
   {{-- @include('User.parts.login') --}}
    <div id="app" class="overflow-hide">
        @yield('content')
    </div>

    @include('User.parts.footer')
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/firebase.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



    <script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/vendors/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/vendors/vanilla-lazyload/lazyload.min.js')}}"></script>
    <script src="{{asset('assets/vendors/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/vendors/lightgallery/lightgallery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/lightgallery/plugins/zoom/lg-zoom.min.js')}}"></script>
    <script src="{{asset('assets/vendors/lightgallery/plugins/thumbnail/lg-thumbnail.min.js')}}"></script>
    <script src="{{asset('assets/vendors/lightgallery/plugins/video/lg-video.min.js')}}"></script>
    <script src="{{asset('assets/vendors/lightgallery/plugins/vimeoThumbnail/lg-vimeo-thumbnail.min.js')}}"></script>
    <script src="{{asset('assets/vendors/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendors/slick/slick.min.js')}}"></script>
    <script src="{{asset('assets/vendors/gsap/gsap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/gsap/ScrollToPlugin.min.js')}}"></script>
    <script src="{{asset('assets/vendors/gsap/ScrollTrigger.min.js')}}"></script>
    <script src="{{asset('assets/vendors/mapbox-gl/mapbox-gl.js')}}"></script>
    <script src="{{asset('assets/js/theme.min.js')}}"></script>
    
    
    <!-- From Old -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/toastr.min.js?v=1.1') }}" crossorigin="anonymous"></script>
    <!-- From Old -->

    <script>
    
        function showwiselist(){
            $('#cartdivopen').show();
            $('#cartwisebody').empty();
            $.ajax({
                url: "{{ route('user.wiselist.show') }}",
                success: function(res) {
                    if (res == '') {
                        $('#cartwisebody').append("<h5 class='text-center mb-13'>You have not added anything to wishlist !</h5>");
                    } else {
                        $('#cartwisebody').append(res);
                    }
                }
            });
        }
        
        function saveprod(pvid){
          @if (isset(Auth::user()->name))
          $.ajax({
              url: "{{ route('user.wishlist.save') }}",
              method: 'POST',
              data: {
                  id: pvid,
                  _token: "{{ csrf_token() }}"
              },
              success: function(obj) {
                toastr.clear();
                if (obj.success == '1') {
                    toastr.success('Successfully Added to Wishlist');
                    $('#wishlistbtn_'+pvid).removeClass('btn-grey').addClass('btn-active');
                } else if (obj.success == '2') {
                    toastr.success('Successfully Removed from Wishlist');
                    $('#wishlistbtn_'+pvid).removeClass('btn-active').addClass('btn-grey');
                    $('#cartwiselistpvid_'+pvid).remove();
                } else {
                  toastr.error('Error', 'Please Try Again!');
                }
              }
          });
          @else
            toastr.clear();
            toastr.error('Error', 'Please Login Before Save This Product!');
          @endif
        }

        function totpricelist(){
            var ids = $('#pricecarttotpass').val().split(',');
            var totval = 0;
            ids.forEach(function(item,index){
                var price = parseFloat($('#pricecart_'+item).html());
                var bag = parseInt($('#cartvalpvid_'+item).val());
                var sing_price = price*bag;
                $('#pricecartsingtot_'+item).empty().append(sing_price);
                totval += sing_price;
            });

            $('#addcarttotprice').empty().append(totval);
        }

        function addCart(pvid,token,type){
//            if(type==2){
//                $('#cartlistpvid_'+pvid).remove();
//            }
//            ajaxCart(pvid,token,type,1);
//            totpricelist();
            if (type == 2) {
               $('#cartlistpvid_' + pvid).remove();
                var getvalset = $('#pricecarttotpass').val();
                if(getvalset!=undefined&&getvalset!=''){
                    var ids = getvalset.split(',');
                    ids.forEach(function(item, index) {
                        if(pvid==item){
                            ids.splice(index, 1); 
                        }
                    });
                }
                $('#pricecarttotpass').val(ids.toString());
            }else{
                toastr.clear();
                toastr.success('Successful', 'Product added to cart');
            }
            ajaxCart(pvid, token, type, 1);
            totpricelist();
            
        }

        function ajaxCart(pvid,token,type,addval){
            $.ajax({
                url: "{{ route('user.addtocart') }}",
                method: 'POST',
                data: {
                    id: pvid,
                    type: type,
                    _token: token,
                    addval: addval
                },
                success: function(res) {
                    cartCount();
                    showcart();
                    
                }
            });
        }

        function cartCount(){
            $.ajax({
                url: "{{ route('user.cartcount.show') }}",
                success: function(res) {
                    $('#cartCount').empty().append(res);
                }
            });
        }
        
        function qtyCount(){
            var namef = 'cartvalpvid_';
            var getval = $('#'+namef+id).val();
            $('#'+namef+id).empty().append(getval);
        }

        function minCart(id){
            var namef = 'cartvalpvid_';
            var getval = $('#'+namef+id).val();
            var token = "{{ csrf_token() }}";
            if(getval>1){
                getval--;
                ajaxCart(id,token,1,-1);
            }
            $('#'+namef+id).empty().append(getval);
            totpricelist();
        }

        function adCart(id){
            var namef = 'cartvalpvid_';
            var getval = $('#'+namef+id).val();
            var token = "{{ csrf_token() }}";
            getval++;
            ajaxCart(id,token,1,1);
            $('#'+namef+id).empty().append(getval);
            totpricelist();
        }

        $(document).ready(function(){
        });

        function cartmenu(id){
            $('.cart-drawer-menu').removeClass('active');
            $('#mybag'+id).addClass('active');
            if(id=='1'){
                $('.cartbodyface').hide();
                $('.cartwisebodyface').show();
                showwiselist();
            }else{
                $('.cartbodyface').show();
                $('.cartwisebodyface').hide();
            }
        }
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2557313646899968"
     crossorigin="anonymous"></script>
    @yield('bottomScript')
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
    </script>
    

</body>
</html>

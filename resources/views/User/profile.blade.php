@extends('User.layouts.app')

@section('content')

<style>
     .card-month {
    background-color: #fff;
    box-shadow: 0 6px 10px rgba(2,42,186,.2);
    cursor: pointer;
    border-color: #fff  ;
    display: flex;
    height: 190px;
    border-radius: 10px;
    margin: 0 auto 60px;
    padding: 25px 20px;
    width: 504px;
 }
 
 .card-month-down {
    background-color: #fff;
    box-shadow: 0 6px 10px rgba(2,42,186,.2);
    cursor: pointer;
    border-color: #fff  ;
    display: flex;
    height: 190px;
    border-radius: 10px;
    padding: 25px 20px;
    width: auto;
 }
 
.ccard{
width: 320px;
height: 190px;
  -webkit-perspective: 600px;
  -moz-perspective: 600px;
  perspective:600px;
  
}

.card__part{
  box-shadow: 1px 1px #aaa3a3;
    top: 0;
  position: absolute;
z-index: 1000;
  left: 0;
  display: inline-block;
    width: 320px;
    height: 190px;
    
    background-image: url('{{asset('assets/images/profile/map.png')}}'), linear-gradient(to right bottom, #fd696b, #fa616e, #f65871, #f15075, #ec4879); /*linear-gradient(to right bottom, #fd8369, #fc7870, #f96e78, #f56581, #ee5d8a)*/
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-radius: 8px;
   
    -webkit-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -moz-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -ms-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -o-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
}

.card__front{
  padding: 18px;
-webkit-transform: rotateY(0);
-moz-transform: rotateY(0);
}

.card__back {
  padding: 18px 0;
-webkit-transform: rotateY(-180deg);
-moz-transform: rotateY(-180deg);
}

.card__black-line {
    margin-top: 5px;
    height: 38px;
    background-color: #303030;
}

.card__logo {
    height: 16px;
}

.card__front-logo{
      position: absolute;
    top: 18px;
    right: 18px;
}
.card__square {
    border-radius: 5px;
    height: 30px;
}

.card_numer {
    display: block;
    width: 100%;
    word-spacing: 4px;
    font-size: 20px;
    letter-spacing: 2px;
    color: #fff;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
}

.card__space-75 {
    width: 75%;
    float: left;
}

.card__space-25 {
    width: 25%;
    float: left;
}

.card__label {
    font-size: 10px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}

.card__info {
    margin-bottom: 0;
    margin-top: 5px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.card__back-content {
    padding: 15px 15px 0;
}
.card__secret--last {
    color: #303030;
    text-align: right;
    margin: 0;
    font-size: 14px;
}

.card__secret {
    padding: 5px 12px;
    background-color: #fff;
    position:relative;
}

.card__secret:before{
  content:'';
  position: absolute;
top: -3px;
left: -3px;
height: calc(100% + 6px);
width: calc(100% - 42px);
border-radius: 4px;
  background: repeating-linear-gradient(45deg, #ededed, #ededed 5px, #f9f9f9 5px, #f9f9f9 10px);
}

.card__back-logo {
    position: absolute;
    bottom: 15px;
    right: 15px;
}

.card__back-square {
    position: absolute;
    bottom: 15px;
    left: 15px;
}

.card:hover .card__front {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);

}

.card:hover .card__back {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
}

.content-side:after {
  content: "";
  display: table;
  clear: both;
}

.column{
    float: left;
}

.col-md-3{
    margin-top: 15px;
}

.details{
    margin-top:15px; 
    position: absolute; 
    left: 22%; 
    top: 50%;
    width:auto !important;
}

@media (max-width: 800px) {
    .ccard{
        position:relative;
        left:7%;
    }
    
    .card-month{
        margin-top: 20px;
        width: 95%;
        margin-left: 4%;
        height: auto;
    }
    
    .details{
        position: relative; 
        top: -5%;
        left: -1%;
        margin-bottom: -7%;
    }
    
}
</style>

 <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Your Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <section id="feature_products_1" class="container container-xxl pt-lg-18 pt-14 pb-lg-21 pb-15">
    <h2 class="text-center mb-10 pb-3" data-animate="fadeInUp">Welcome {{Auth::user()->name}}</h2>
    <ul class="nav nav-tabs border-0 d-flex justify-content-center mb-14" role="tablist">
        <li class="nav-item" role="presentation" data-animate="fadeInUp">
            <h5 class="mb-0 px-sm-7 px-5 py-2">
                <button class="nav-link text-hover-underline p-0 border-0 text-body-emphasis opacity-50 active" data-bs-toggle="tab" data-bs-target="#skincare-tab-pane" type="button" role="tab" aria-controls="skincare-tab-pane" aria-selected="true">Profile</button>
            </h5>
        </li>
        <li class="nav-item" role="presentation" data-animate="fadeInUp">
            <h5 class="mb-0 px-sm-7 px-5 py-2">
                <button class="nav-link text-hover-underline p-0 border-0 text-body-emphasis opacity-50" data-bs-toggle="tab" data-bs-target="#bodycare-tab-pane" type="button" role="tab" aria-controls="bodycare-tab-pane" aria-selected="false">Orders</button>
            </h5>
        </li>
        <li class="nav-item" role="presentation" data-animate="fadeInUp">
            <h5 class="mb-0 px-sm-7 px-5 py-2">
                <a href="{{ url('/logout') }}" class="nav-link text-hover-underline p-0 border-0 text-body-emphasis opacity-50" aria-controls="haircare-tab-pane" aria-selected="false">logout</a>
            </h5>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="skincare-tab-pane" role="tabpanel" tabindex="0">
            <div class="row gy-50px">
                <section class="pt-lg-17 pb-lg-18 pt-15 pb-16">
                    <div class="container text-center mt-lg-3">
                        <div class="row">
                            <div class="col-lg-6 border-0 border-lg-end" data-animate="fadeInUp">
                                <h3 class="mx-auto fs-4 mb-6">Your Details</h3>
                                <p class="mx-auto mb-10 newletter-follow-desc">Here is your basic details of your profile</p>
                                
                                <form class=" mx-auto newletter-follow-form">
                                    <div class="input-group position-relative">
                                        <a class="btn ms-0">
                                            Name :
                                        </a>
                                        <input class="form-control bg-body rounded-left" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                     <div class=" mt-6 input-group position-relative">
                                        <a class="btn ms-0">
                                            Email :
                                        </a>
                                        <input class="form-control bg-body rounded-left" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </form>
                                
                            </div>
                            <div class="col-lg-6 mt-11 mt-lg-0" data-animate="fadeInUp">
                                <h3 class="mx-auto fs-4 mb-6">Follow Us on</h3>
                                <p class="mx-auto mb-10 newletter-follow-desc"> Shapes and proportions are for your intellect. I’ve treated the waistcoat as if it were a corset.</p>
                                <div class="socical-icon social-icon-style-1 ">
                                    <ul class="list-inline fs-5 mb-0">
                                        <li class="list-inline-item me-7 me-lg-12"><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li class="list-inline-item me-7 me-lg-12"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item me-7 me-lg-12"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="tab-pane fade" id="bodycare-tab-pane" role="tabpanel" tabindex="0">
            <div class="row gy-50px">
                   <div class="shopping-cart">
                      <h4 class="text-center fs-2 mt-12 mb-13">Your order status</h4> 
                	<form class="table-responsive-md pb-8 pb-lg-10" id="getrowlist">
                		
                	</form>
                </div>
            </div>
        </div>
    </div>
</section>

	
	



@endsection
@section('bottomScript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function copylink() {
        var copytext = $('#copy_referal_url').val();
        toastr.success('Copied!...');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(copytext).select();
        document.execCommand("copy");
        $temp.remove();
    }
    
    var pages = 0;
    function showorders() {
        $.ajax({
            url: "{{ route('user.get.orders') }}",
            data: {
                page: pages
            },
            success: function(res) {
                if (res == ''&&pages==0) {
                    $('#getrowlist').append("<div class='text-center mt-5'><h3>Empty Orders!</h3></div>");
                } else if (res == '') {
                    $('#orderloadmrebtn').remove();
                }else{
                    $('#getrowlist').append(res);
                }
            }
        });
    }
    showorders();
    function loadorders(){
        pages++;
        showorders();
    }

    $('#changemobileform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('user.change.mobile') }}",
            type: 'POST',
            data: $('#changemobileform').serialize(),
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
                    toastr.success('Successfully Updated!');
                    window.location.reload();
                } else if (obj.success == '2') {
                    toastr.error('Error', 'Password Not Matched!');
                } else {
                    toastr.error('Error', 'Please Try Again!');
                }
            }
        });
    });
    $('#changepassform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('user.change.pass') }}",
            type: 'POST',
            data: $('#changepassform').serialize(),
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
                    toastr.success('Successfully Updated!');
                    window.location.reload();
                } else if (obj.success == '2') {
                    toastr.error('Error', 'Password Not Matched!');
                } else {
                    toastr.error('Error', 'Please Try Again!');
                }
            }
        });
    });
    $('#editprofileform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('user.update.profile') }}",
            type: 'POST',
            data: $('#editprofileform').serialize(),
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
                    toastr.success('Successfully Updated!');
                    window.location.reload();
                } else {
                    toastr.error('Error', 'Please Try Again!');
                }
            }
        });
    });
</script>
@endsection

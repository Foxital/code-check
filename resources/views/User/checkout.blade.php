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
        
        #payloadpaynow {
            display:none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.56);
            z-index: 9999999;
            text-align: center;
            padding-top: 140px;
        }
        
        #overshipadd {
            display: flex;
            align-items: center;
        }
        
        #overshipadd > span {
            display: inline-block; /* Set display to inline-block */
        }
        
        .ml-auto {
            margin-left: auto; /* Move the second span to the right */
        }
        
    </style>
    
</head>
@include('User.parts.nav')

@php
$getcart = [];
$totcart = 0;
/*
if (Cookie::get('addtocart') != null) {
    $getcart = json_decode(Cookie::get('addtocart'), true);
    foreach ($getcart as $val) {
        $totcart += $val;
    }
}
*/
@endphp


@php
$amount_use = 0;
$states = \App\Models\Courier::where('status', '1')
    ->orderBy('name')
    ->get();
$addrs = [];
if(isset(Auth::user()->id)){
$addrs = \App\Models\userAddress::latest()
    ->where('status', '1')
    ->where('user_id', Auth::user()->id)
    ->limit(10)
    ->get();
}
$addresid = isset($addrs[0]['id'])?$addrs[0]['id']:0;
$stateprice = [];
$couponlive = [];
if(isset($coupon['id'])){
    $couponlive = \App\Models\Coupon::where('status', '1')
    ->where('name', $coupon['name'])
    ->first();
}
$addressjson = [];
@endphp
    
    <div id="payloadpaynow">
        <img src="{{ asset('assets/images/payment.gif') }}" class="text-center">
        <h2 style="font-size: 20px; font-weight: 500;color: #fff;position: relative;top: -30px;">Payment is in Process, Don't Reload The Page...</h2>
    </div>
    
    
<section class="z-index-2 position-relative pb-2 mb-12">
    <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a title="Shop" href="{{ url('/shop') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="container pb-14 pb-lg-19">
    <div class="text-center"><h2 class="mb-6">Check out</h2></div>

	<div class="pt-12">
		<div class="row">
			<div class="col-lg-4 pb-lg-0 pb-14 order-lg-last">
				<div class="card border-0 rounded-0 shadow">
	<div class="card-header px-0 mx-10 bg-transparent py-8" >
	    <h4 class="fs-4 mb-8">Order Summary</h4>
	        <div id="cartpage"></div>
		
		
			
				
			
		
	</div>
	
	@php
        $getuse = \App\Models\Setting::whereIn('id',[6,7])->get();
        $overshipping = 1000;
        foreach ($getuse as $key => $val) {
        if($val['id']=='6'&&isset(Auth::user()->name)){
        if($val['val']>0&&Auth::user()->wallet>0){
            $amount_use = round(($val['val']/100)*Auth::user()->wallet);
        }
            }else if($val['id']=='7'){
            $overshipping = $val['val'];
        }
            }
      @endphp
	<!--<div class="card-body px-10 py-8">
				@if (isset($couponlive['id']))
				<p class="card-text text-body-emphasis mb-8">Coupon code applied</p>
				<div class="input-group position-relative">
					<input type="text" readonly name="search-field" value="{{ $couponlive['name'] }}" required class="form-control bg-body rounded-end">
					<button onclick="removeCoupon()" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
						Remove Coupon
					</button>
				</div>
				@else
				<div class="input-group position-relative">
					<input type="text" id="applycouponval" placeholder="Gift card or discount code" class="form-control bg-body rounded-end"> 
					<button onclick="applycoupon()" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
						Apply Coupon
					</button>
				</div>
				@endif
				
	</div>-->
	<div class="card-footer bg-transparent py-5 px-0 mx-10">
		<div class="d-flex align-items-center mb-2">
			<span>Subtotal:</span>
			<span class="d-block ms-auto text-body-emphasis fw-bold">Rs. <span id="subtotal"></span></span>
		</div>
		@if (isset($couponlive['id']))
		<div class="d-flex align-items-center">
			<span>Discount:</span>
			<span class="d-block ms-auto text-body-emphasis fw-bold">-Rs. <span id="discountprice"></span></span>
		</div>
		@endif
		<div class="d-flex align-items-center">
			<span>Shipping:</span>
			<span class="d-block ms-auto text-body-emphasis fw-bold">Rs. <span id="shippingprice" ></span>
		</div>
		<div id="overshipadd" class="align-items-center custom-flex">
			<span>Shipping Over 999:</span>
			<span class="d-block ms-auto text-body-emphasis fw-bold">-Rs. <span id="shippingprice2" ></span>
		</div>
		<input type="hidden" rows="2" name="notepay" id="notepay" class="form-control"></input>
	</div>
	<div class="card-footer bg-transparent py-5 px-0 mx-10">
		<div class="d-flex align-items-center fw-bold mb-6">
			<span class="text-body-emphasis p-0">Total pricre:</span>
			<span class="d-block ms-auto text-body-emphasis fs-4 fw-bold">Rs. <span id="totpricecheckout"></span></span>
		</div>
	    </div>
    </div>
	</div>
	
	
			
			
			
			
			<div class="col-lg-8 order-lg-first pe-xl-20 pe-lg-6">
				
				@if (count($addrs) > 0)
                @endif
                
				<!--<div class="checkout mb-7">
				    @if (count($addrs) > 0)
				    <div class="mb-7">
	                    <h4 class="fs-4 mb-8 mt-12 pt-lg-1">Saved Address</h4>
	                    
	                    <div class="nav nav-tabs border-0">
	                    
	                    @if (count($addrs) > 0)
						@foreach ($addrs as $k=>$addr)
                        @php
                        $addresid = $addr['primary_addrs']=='1'?$addr['id']:$addresid;
                        $addressjson[$addr['id']]=$addr;
                        @endphp         
			
            			<input type="hidden" id="addrsoptstate_{{ $addr['id'] }}" value="{{ $addr['state'] }}" />
            			<a onclick="editaddress({{ $addr['id'] }})"  id="shipaddrsopt_{{ $addr['id'] }}" class="btn btn-payment px-12 mx-2 py-6 me-7 my-3 nav-link"
            			   data-bs-toggle="tab" data-bs-target="#paypal-tab">
            				<svg class="icon icon-paylay fs-32px text-body-emphasis">
            					<use xlink:href="#icon-box-07"></use>
            				</svg>
            				<span class="ms-3 text-body-emphasis fw-semibold fs-6">Address {{ $addr['id'] }}</span>
            			</a>
            			@endforeach
						@endif
						
		            </div>
		
	                </div>
	                @else
	                <div class="mb-7">
	                    <h4 class="fs-4 mb-8 mt-12 pt-lg-1">No Saved Address Available !</h4>
	                </div>
	                @endif
                    </div>-->
                <!--<div class="checkout">	
				    <h4 class="fs-4 pt-4 mb-7">Shipping Information</h4>
				    @if (isset(Auth::user()->name))
				    <form method="POST" id="mang_address_frm">
				        @csrf
                        <input type="hidden" name="addr_id" id="addr_id" value="0">
    				    <div class="mb-7">
                    		<label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Name *</label>
                    		<div class="row">
                    			<div class="col-md-6 mb-md-0 mb-7">
                    				<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name *" required="">
                    			</div>
                    			<div class="col-md-6">
                    				<input type="text" name="last_name"  id="last_name" class="form-control"  placeholder="Last Name *" required="">
                    			</div>
                    		</div>
                    	</div>
    
    	                <div class="mb-7">  
                    		<div class="row">
                    			<div class="col-md-8 mb-md-0 mb-7">
                    				<label for="street-address" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Street	Address *</label>
                    				<input type="text" name="address" id="address" class="form-control" required="">
                    			</div>
                    			<div class="col-md-4">
                    				<label for="apt" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">APT/Suite (Optional)</label>
                    				<input type="text" name="optional_name"  id="optional_name" class="form-control" required="">
                    			</div>
                    		</div>
                    	</div>
    
    	                <div class="mb-7">
                    		<div class="row">
                    			<div class="col-md-4 mb-md-0 mb-7">
                    				<label for="city" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">City *</label>
                    				<input type="text" name="city"  id="city" class="form-control" required="">
                    			</div>
                    			<div class="col-md-4 mb-md-0 mb-7">
                    				<label for="state" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">State</label>
                    				<select class="form-control form-select dropdown-toggle d-flex justify-content-between align-items-center text-decoration-none text-secondary p-5 position-relative d-block" id="state" name="state" required="">
                    				    @foreach ($states as $state)
                                        @php $stateprice[$state['name']]=$state['price']; @endphp
                    				    <option class="dropdown-item px-6 py-4" value="{{ $state['name'] }}">{{ $state['name'] }}</option>
                    				    @endforeach
                    				</select>    
                    			</div>
                    			<div class="col-md-4">
                    				<label for="zip" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">zip code</label>
                    				<input type="text" name="pin_code" id="pin_code" onkeypress="return onlyNumberKey(event)" maxlength="6" minlength="6" class="form-control" required="">
                    			</div>
                    		</div>
                    	</div>
                    	
    	                <div class="mb-7">
                		<div class="row">
                			<div class="col-md-6 mb-md-0 mb-7">
                				<input type="text" name="country"  id="country" class="form-control"  placeholder="Country *" value="India" readonly required="">
                			</div>
                			<div class="col-md-6">
                				<input type="text" id="mobile_num"  name="mobile_num" maxlength="10" class="form-control" placeholder="Phone number" required="">
                			</div>
                		</div>
                	</div>
    
    	                <div class="mt-6 mb-5 form-check">
                		<input type="checkbox" class="form-check-input rounded-0 me-4" name="customCheck6" id="customCheck5">
                		<label class="text-body-emphasis" for="customCheck5">
                			<span class="text-body-emphasis">Billing address is the same as shipping</span>
                		</label>
                	</div>
                	    <button type="submit" {{ !isset(Auth::user()->name) ? 'disabled' : '' }} class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11 mt-md-7 mt-4">Place Order</button>
            	    </form>
            	    @endif
                    
                    </div>-->
                
                @if (count($addrs) > 0)
				<div class="checkout mb-7" id="login-btn">
				    <div class="mb-7">
	                    <h4 class="fs-4 mb-8 mt-12 pt-lg-1">Saved Address</h4>
	                        <div class="nav nav-tabs border-0">
    					@foreach ($addrs as $k=>$addr)
                        @php
                        $addresid = $addr['primary_addrs']=='1'?$addr['id']:$addresid;
                        $addressjson[$addr['id']]=$addr;
                        @endphp
                        <input type="hidden" id="addrsoptstate_{{ $addr['id'] }}" value="{{ $addr['state'] }}" />
            			<a onclick="editaddress({{ $addr['id'] }}); changeaddress({{ $addr['id'] }})"  id="shipaddrsopt_{{ $addr['id'] }}" class="btn btn-payment px-12 mx-2 py-6 me-7 my-3 nav-link"
            			   data-bs-toggle="tab" data-bs-target="#paypal-tab">
            				<svg class="icon icon-paylay fs-32px text-body-emphasis">
            					<use xlink:href="#icon-box-07"></use>
            				</svg>
            				<span class="ms-3 text-body-emphasis fw-semibold fs-6">Address {{ $addr['id'] }}</span>
            			</a>
					@endforeach
					        </div>
					   </div>
					</div>
				@else
				<div class="checkout mb-7" id="login-btn">
					    <div class="mb-7">
					        <h4 class="fs-4 mb-8 mt-12 pt-lg-1">No Saved Address Available !</h4>
					   </div>
					 </div>
				@endif
				
				<div class="checkout">
				    
				<!--Address modal-->
                @if (isset(Auth::user()->name))
                    <div class="shipping-form" >
                        <h4 class="fs-4 pt-4 mb-7">Shipping Information</h4>
                        <form method="post" id="mang_address_frm"> 
                        @csrf
                        <input type="hidden" name="addr_id" id="addr_id" value="0">
                        
                            <div class="mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Name *</label>
                                <div class="row">
                    			    <div class="col-md-6 mb-md-0 mb-7">
    							        <input class="form-control" required type="text" name="first_name" id="first_name" placeholder="First Name *" value="">
    							     </div>
    							     <div class="col-md-6">
                        				<input class="form-control" required type="text" name="last_name"  id="last_name" placeholder="Last Name *" value="">
                        			</div>
    							 </div>    
                             </div>
                            <div class="mb-7">  
                            		<div class="row">
                            			<div class="col-md-8 mb-md-0 mb-7">
                            				<label for="street-address" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Street	Address *</label>
                            				<input class="form-control" required type="text" name="address" id="address" placeholder="Address *" value="">
                            			</div>
                            			<div class="col-md-4">
                            				<label for="apt" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">APT/Suite (Optional)</label>
                            				<input class="form-control" type="text" name="optional_name"  id="optional_name" value="">
                            			</div>
                            		</div>
                            	</div>
                            <div class="mb-7">
                            		<div class="row">
                            			<div class="col-md-4 mb-md-0 mb-7">
                            				<label for="city" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">City *</label>
                            				<input type="text" name="city"  id="city" class="form-control" required="">
                            			</div>
                            			<div class="col-md-4 mb-md-0 mb-7">
                            				<label for="state" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">State</label>
                            				<select id="state" name="state" required class="form-control form-select dropdown-toggle d-flex justify-content-between align-items-center text-decoration-none text-secondary p-5 position-relative d-block" required="">
                            				    @foreach ($states as $state)
                                                @php $stateprice[$state['name']]=$state['price']; @endphp
                            				    <option value="{{ $state['name'] }}" class="dropdown-item px-6 py-4">{{ $state['name'] }}</option>
                            				    @endforeach
                            				</select>    
                            			</div>
                            			<div class="col-md-4">
                            				<label for="zip" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">zip code</label>
                            				<input type="text" name="pin_code" id="pin_code" onkeypress="return onlyNumberKey(event)" maxlength="6" minlength="6" class="form-control" required="">
                            			</div>
                            		</div>
                            	</div>
                            <div class="mb-7">
                        		<div class="row">
                        			<div class="col-md-6 mb-md-0 mb-7">
                        			    <label for="country" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Country *</label>
                        				<input type="text" name="country"  id="country" class="form-control"  placeholder="Country *" value="India" readonly required="">
                        			</div>
                        			<div class="col-md-6">
                        			    <label for="Mobile" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Mobile *</label>
                        				<input type="text" id="mobile_num"  name="mobile_num" maxlength="10" class="form-control" placeholder="Phone number" required="">
                        			</div>
                        		</div>
                        	</div>	
                        	
                        	<button id="close-btn" type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11 mt-md-7 mt-4">Save</button>
                            
                        </form>
                    </div>
                @endif
                <!--Address modal-->
				</div>
									
				<div class="checkout mb-7">
	                <div class="mb-7">
	                    <h4 class="fs-4 mb-8 mt-12 pt-lg-1">Payment Method</h4>
	                    
	                    <div class="nav nav-tabs border-0">
			
                			<a class="btn btn-payment px-12 mx-2 py-6 me-7 my-3 nav-link active"
                			   data-bs-toggle="tab" data-bs-target="#credit-card-tab">
                				<svg class="icon icon-paylay fs-32px text-body-emphasis">
                					<use xlink:href="#icon-card"></use>
                				</svg>
                				<span class="ms-3 text-body-emphasis fw-semibold fs-6">Online Payment</span>
                			</a>
                			
                		</div>
		
	                </div>
                    	<button onclick="paynow()" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11 mt-md-7 mt-4">Place Order</button>
                    </div>
                    
                    
        		</div>
        	</div>
        </section>






	
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
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
    
     addrsbtn = document.getElementById('close-btn');
    
     document.querySelector('#login-btn').addEventListener("click", function(){
       document.querySelector("#login-box").style.display = 'block';
    });
    
    document.querySelector('#close-btn').addEventListener("click", function(){
       document.querySelector("#login-box").style.display = 'none';
    });
    
        var stateprice = JSON.parse('<?=json_encode($stateprice)?>');
        var addressjson = JSON.parse('<?=json_encode($addressjson)?>');
        var discountval = parseFloat("{{ $couponlive['offer_val'] ?? 0 }}");
        var discounttyp = parseInt("{{ $couponlive['offer_type'] ?? 1 }}");
        var amount_use = parseFloat("{{ $amount_use }}");
        var overshipping = parseInt("{{ $overshipping }}");
        
        function showcart() {
            $('#cartbody').empty();
            $.ajax({
                url: "{{ route('user.addcart.show') }}",
                success: function(res) {
                    if (res == '') {
                        $('#cartbody').append("<div class='text-center mt-5'><h3>Empty Cart!</h3></div>");
                    } else {
                        $('#cartbody').append(res);
                        totpricelist();
                    }
                }
            });
        }
        
        function checkcart() {
            $('#cartpage').empty();
            $.ajax({
                url: "{{ route('user.checkcart.show') }}",
                success: function(res) {
                    if (res == '') {
                        $('#cartpage').append("<div class='text-center mt-5'><h3>Empty Cart!</h3></div>");
                    } else {
                        $('#cartpage').append(res);
                        totpricelist();
                    }
                }
            });
        }

        function editaddress(id){
          var selected = addressjson[id];
          console.log(selected);
          $('#addr_id').val(id);
          $('#first_name').val(selected['fname']);
          $('#last_name').val(selected['lname']);
          $('#address').val(selected['address']);
          $('#optional_name').val(selected['optional_name']);
          $('#city').val(selected['city']);
          $('#country').val(selected['country']);
          $('#state').val(selected['state']);
          $('#pin_code').val(selected['pin_code']);
          $('#mobile_num').val(selected['mobile_num']);
          $('#addressmodal').modal('toggle');
          addrsbtn.textContent = 'Edit';
        }

        function closefrmaddress(){
          $('#addr_id').val(0);
          $('#mang_address_frm')[0].reset();
        }

        function getwallet(){
          // if($("#walletcheckbox").is(":checked")){
          //   alert(1);
          // }else{
          //   alert(2);
          // }
          totpricelist();
        }

        function totpricelist() {
            var getvalset = $('#pricecarttotpass').val();
            if(getvalset!=undefined&&getvalset!=''){
                var ids = getvalset.split(',');
                var totval = 0;
                ids.forEach(function(item, index) {
                    var price = parseFloat($('#pricecart_' + item).html());
                    var bag = parseInt($('#cartvalpvid_' + item).val());
                    var sing_price = price*bag;
                    $('#pricecartsingtot_'+item).empty().append(sing_price);
                    totval += sing_price;
                });
                $('#addcarttotprice').empty().append(parseFloat(totval).toFixed(2));
                $('#subtotal').empty().append(parseFloat(totval).toFixed(2));
                var tot = totval;
                if(overshipping>tot){
                  $('#overshipadd').hide();
                  tot+=parseFloat($('#shippingprice').html());
                }else{
                  $('#overshipadd').show();
                }
                var discountprice = 0;
                if(discountval>0){
                    if(discounttyp==1){
                        var discountprice = (discountval/100)*totval;
                    }else if(discounttyp==2){
                        discountprice=discountval;
                    }
                    $('#discountprice').empty().append(parseFloat(discountprice).toFixed(2));
                }
                if($("#walletcheckbox").is(":checked")){
                  tot=tot-discountprice-amount_use;
                  $('#amtuseshow').empty().append(amount_use);
                }else{
                  tot=tot-discountprice;
                  $('#amtuseshow').empty().append('0');
                }
               $('#totpricecheckout').empty().append(tot.toFixed(2));
            }
        }

        function addCart(pvid, token, type) {
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
            }
            ajaxCart(pvid, token, type, 1);
            totpricelist();
        }

        function ajaxCart(pvid, token, type, addval) {
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
                    checkcart();
                }
            });
        }

        function removeallcart() {
            $.ajax({
                url: "{{ route('user.cart.remove') }}",
                success: function(res) {}
            });
        }

        function minCart(id) {
            var namef = 'cartvalpvid_';
            var getval = $('#' + namef + id).val();
            var token = "{{ csrf_token() }}";
            if (getval > 1) {
                getval--;
                ajaxCart(id, token, 1, -1);
            }
            $('#' + namef + id).val(getval);
            totpricelist();
        }

        function adCart(id) {
            var namef = 'cartvalpvid_';
            var getval = $('#' + namef + id).val();
            var token = "{{ csrf_token() }}";
            getval++;
            ajaxCart(id, token, 1, 1);
            $('#' + namef + id).val(getval);
            totpricelist();
        }
        var addrsid = 0;
        
        function changeaddress(id) {
            addrsid = id;
            var statnam = $('#addrsoptstate_' + id).val();
            if(stateprice[statnam]!=undefined){
                $('#shippingprice').empty().append(parseFloat(stateprice[statnam]).toFixed(2));
                $('#shippingprice2').empty().append(parseFloat(stateprice[statnam]).toFixed(2));
                totpricelist();
            }
        }

        $(document).ready(function() {
            changeaddress({{ $addresid }})
        })

        $('#mang_address_frm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('user.save.address') }}",
                type: 'POST',
                data: $('#mang_address_frm').serialize(),
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
                    } else {
                        toastr.error('Error', 'Please Try again');
                    }
                }
            });
        })

        @if (isset(Auth::user()->name))
        function paynow() {
            $('#payloadpaynow').toggle();
            var totalamount = document.getElementById("totpricecheckout").textContent;
            $.ajax({
                url: "{{ route('user.pay.store') }}",
                data: {
                    addr_id: addrsid,
                    final_amount: totalamount,
                    wallet_taken: $("#walletcheckbox").is(":checked")?1:0,
                    _token: "{{ csrf_token() }}",
                    note: $('#notepay').val()
                },
                method: 'POST',
                error: function() {
                    alert("An error has occurred");
                },
                success: function(obj) {
                    $('#payloadpaynow').toggle();
                    if (obj.save == '1') {
                        var options = {
                            "key": obj.key,
                            "amount": "obj.amount", // INR 299.35
                            "name": obj.name,
                            "order_id": obj.order_id,
                            "description": obj.description,
                            "image": "{{ asset('assets/img/vlogo.png') }}",
                            "handler": function(response) {
                                $('#payloadpaynow').toggle();
                                $.ajax({
                                    url: "{{ route('user.pay.check') }}",
                                    data: {
                                        oid: response.razorpay_order_id,
                                        pid: response.razorpay_payment_id,
                                        addr_id: addrsid,
                                        final_amount: totalamount,
                                        _token: "{{ csrf_token() }}",
                                    },
                                    method: 'POST',
                                    error: function() {
                                        alert("An error has occurred");
                                    },
                                    success: function(obj) {
                                        if (obj.save == '1') {
                                            toastr.success('Payment Successful');
                                            removeallcart();
                                            window.location.href = "{{ route('user.profile') }}";
                                            $('#payloadpaynow').toggle();
                                        } else {
                                            $('#payloadpaynow').toggle();
                                            alert('Payment Error...');
                                        }

                                    }
                                });
                            },
                            "modal": {
                                "ondismiss": function() {
                                    $.ajax({
                                        url: "{{ route('user.pay.dismiss') }}",
                                        data: {
                                            oid: obj.order_id,
                                            _token: "{{ csrf_token() }}",
                                        },
                                        method: 'POST',
                                        error: function() {
                                            alert("An error has occurred");
                                        },
                                        success: function(obj) { }
                                    });
                                }
                            },
                            "prefill": {
                                "name": "{{ Auth::user()->name }}",
                                "email": "{{ Auth::user()->email }}",
                                "contact": "{{ Auth::user()->mobile }}",
                            },
                            "readonly": {
                                "email": true,
                                "contact": false
                                // "contact": {{ Auth::user()->mobile==''||Auth::user()->mobile==null?'false':'true' }},
                            },
                            "notes": {
                                "address": "note value"
                            },
                            "theme": {
                                "color": "#cf302b"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        //window.location.reload();
                    }
                    //console.log(obj);
                }
            });
        }
        @endif

        function removeCoupon(){
            $.ajax({
                url: "{{ route('user.coupon.remove') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                method: 'POST',
                success: function(res) {
                    toastr.info('Error', 'Coupon Removed!');
                    window.location.reload();
                }
            });
        }

        function applycoupon(){
            $('#applycouponval').prop('readonly', true);
            var getval = $('#applycouponval').val();
            $.ajax({
                url: "{{ route('user.coupon.check') }}",
                data: {
                    coupon: getval,
                    _token: "{{ csrf_token() }}"
                },
                method: 'POST',
                success: function(res) {
                    console.log(res);
                    if(res.success=='0'){
                        $('#applycouponval').prop('readonly', false);
                        toastr.error('Error', 'Coupon Not Exists!');
                    }else{
                        toastr.success('Success Coupon Applied','Success');
                        setTimeout(function(){
                        },1000);
                    }
                }
            });
        }
        
        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

    </script>
    
    @include('User.parts.footer')    
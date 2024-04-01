@extends('User.layouts.app')

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


@section('content')

<div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a title="Shop" href="{{ url('/shop') }}">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
        </div>
</div>
<section class="container">
    <div class="shopping-cart">
	<h2 class="text-center fs-2 mt-12 mb-13">Shopping Cart</h2>
	<form id="cartpage" class="table-responsive-md pb-8 pb-lg-10">
	    
	</form>
	<div class="row pt-8 pt-lg-11 pb-16 pb-lg-18">
		<div class="col-lg-4 pt-2">
			<h4 class="fs-24 mb-6">Coupon Discount</h4>
			<p class="mb-7">Enter you coupon code if you have one.</p>
			<form>
				<input type="text" class="form-control mb-7" placeholder="Enter coupon code here">
				<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
					Apply coupon
				</button>
			</form>
		</div>
		<div class="col-lg-4 pt-lg-2 pt-10">
			<h4 class="fs-24 mb-6">Shipping Caculator</h4>
			<form>
				<div class="d-flex mb-5">
					<div class="form-check me-6 me-lg-9">
						<input class="form-check-input form-check-input-body-emphasis" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
						<label class="form-check-label" for="flexRadioDefault1">
							Free shipping
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input form-check-input-body-emphasis" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
							   checked>
						<label class="form-check-label" for="flexRadioDefault2">
							Flat rate: $75
						</label>
					</div>
				</div>
				<div class="dropdown bg-body-secondary rounded mb-7">
					<a href="#"
					   class="form-select text-body-emphasis dropdown-toggle d-flex justify-content-between align-items-center text-decoration-none text-secondary position-relative d-block"
					   role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Viet Nam
					</a>
					<div class="dropdown-menu w-100 px-0 py-4">
						
						<a class="dropdown-item px-6 py-4" href="#">Andorra</a>
						
						<a class="dropdown-item px-6 py-4" href="#">San Marino</a>
						
						<a class="dropdown-item px-6 py-4" href="#">Tunisia</a>
						
						<a class="dropdown-item px-6 py-4" href="#">Micronesia</a>
						
						<a class="dropdown-item px-6 py-4" href="#">Solomon Islands</a>
						
						<a class="dropdown-item px-6 py-4" href="#">Macedonia</a>
						
					</div>
				</div>
				<input type="text" class="form-control mb-7" placeholder="State / County" required="">
				<input type="text" class="form-control mb-7" placeholder="City" required="">
				<input type="text" class="form-control mb-7" placeholder="Postcode / Zip">
				<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
					Update total
				</button>
			</form>
		</div>
		<div class="col-lg-4 pt-lg-0 pt-11">
			<div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
				<div class="card-body px-9 pt-6">
					<div class="d-flex align-items-center justify-content-between mb-5">
						<span>Subtotal:</span>
						<span class="d-block ml-auto text-body-emphasis fw-bold">$99.00</span>
					</div>
					<div class="d-flex align-items-center justify-content-between">
						<span>Shipping:</span>
						<span class="d-block ml-auto text-body-emphasis fw-bold">$0</span>
					</div>
				</div>
				<div class="card-footer bg-transparent px-0 pt-5 pb-7 mx-9">
					<div class="d-flex align-items-center justify-content-between fw-bold mb-7">
						<span class="text-secondary text-body-emphasis">Total pricre:</span>
						<span class="d-block ml-auto text-body-emphasis fs-4 fw-bold">$99.00</span>
					</div>
					<a href="../shop/checkout.html"
					   class="btn w-100 btn-dark btn-hover-bg-primary btn-hover-border-primary"
					   title="Check Out">Check Out</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>





	<script>
        var stateprice = JSON.parse('<?=json_encode($stateprice)?>');
        var addressjson = JSON.parse('<?=json_encode($addressjson)?>');
        var discountval = parseFloat("{{ $couponlive['offer_val'] ?? 0 }}");
        var discounttyp = parseInt("{{ $couponlive['offer_type'] ?? 1 }}");
        var amount_use = parseFloat("{{ $amount_use }}");
        {{--var overshipping = parseInt("{{ $overshipping }}");--}}
        
        function cartpage() {
            $('#cartpage').empty();
            $.ajax({
                url: "{{ route('user.cart.show') }}",
                success: function(res) {
                    if (res == '') {
                        $('#cartpage').append("<p class='fw-500 text-body-emphasis'>Cart is empty !</p>");
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
                var tot = totval;
                if(overshipping>tot){
                  $('.overshipadd').hide();
                  tot+=parseFloat($('#shippingprice').html());
                }else{
                  $('.overshipadd').show();
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
                success: function(res) {}
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
            cartpage();
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
                        window.location.reload();
                    } else {
                        toastr.error('Error', 'Please Try again');
                    }
                }
            });
        })

        @if (isset(Auth::user()->name))
        function paynow() {
            $('#payloadpaynow').toggle();
            $.ajax({
                url: "{{ route('user.pay.store') }}",
                data: {
                    addr_id: addrsid,
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
                            "amount": obj.amount, // INR 299.35
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
                                        _token: "{{ csrf_token() }}",
                                    },
                                    method: 'POST',
                                    error: function() {
                                        alert("An error has occurred");
                                    },
                                    success: function(obj) {
                                        if (obj.save == '1') {
                                            toastr.success('Payment Successfully');
                                            removeallcart();
                                            window.location.href = "{{ route('user.profile.orders') }}";
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
                            window.location.reload();
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
@endsection

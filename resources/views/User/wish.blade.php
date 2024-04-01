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

<body onload="cartmenu(1)">
    
    <section class="z-index-2 position-relative pb-2 mb-12">
    
    <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="../index.html">Home</a></li>
                            <li class="breadcrumb-item"><a title="Shop" href="../shop/shop-layout-v2.html">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="container container-xxl mb-13 mb-lg-15">
    <div class="text-center" >
        <h2 class="mb-13">Wishlist</h2>
    </div>

    <form id="cartwisebody" class="table-responsive-md" >
	
    </form>

</section>
    
</body>

<script>
        var stateprice = JSON.parse('<?=json_encode($stateprice)?>');
        var addressjson = JSON.parse('<?=json_encode($addressjson)?>');
        var discountval = parseFloat("{{ $couponlive['offer_val'] ?? 0 }}");
        var discounttyp = parseInt("{{ $couponlive['offer_type'] ?? 1 }}");
        var amount_use = parseFloat("{{ $amount_use }}");
        {{--var overshipping = parseInt("{{ $overshipping }}");--}}

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
        
        function showwiselist(){
            $('#cartdivopen').show();
            $('#cartwisebody').empty();
            $.ajax({
                url: "{{ route('user.wiselist.show') }}",
                success: function(res) {
                    if (res == '') {
                        $('#cartwisebody').append("<h4 class='text-center mb-13'>You have not added anything to wishlist !</h4>");
                    } else {
                        $('#cartwisebody').append(res);
                    }
                }
            });
        }
        
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
        
         $(document).ready(function() {
            cartmenu(1);
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

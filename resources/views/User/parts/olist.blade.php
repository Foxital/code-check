@php
$page = $res['page']*10;
$orders = \App\Models\Orders::latest()->where('user_id',Auth::user()->id)
         ->offset($page)
         ->limit(10)->get();
@endphp

<style>
     /*-----For mobile: ---------------*/    
@media (max-width: 480px) {
    .fw-500, .card-text {
        visibility:hidden;
    }
}

/*-----For tablets: ---------------*/
@media (min-width: 481px) and (max-width: 1024px) {
    .fw-500, .card-text {
        visibility:hidden;
    }
}

</style>
@foreach ($orders as $order)
  <section class="container container-xxl mb-13 mb-lg-15">
    <div class="text-center" ><h4 class="mb-13">Order id - #F9-{{$order['id']}}</h4></div>
    
    <form class="table-responsive-md">
    <input id="orderID" type="hidden" value="{{$order['id']}}">    
	<table class="table" style="min-width: 710px">
		<tbody>
            
            @php
                $prods = json_decode($order['product_order_list'],true);
            @endphp
            @foreach ($prods as $k=>$prod)
			<tr class="border">
				<th scope="row" class=" ps-xl-10 py-6 d-flex align-items-center border-0">
					<div class="d-flex align-items-center">
						<div class="ms-6 me-7">
							<img src="{{ asset('uploads/Product/' . $prod['image']) }}" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="img-fluid lazy-image" height="100" width="75" alt="">
						</div>
						<div>
							<p class=" text-body-emphasis fw-semibold mb-5">{{ $prod['name'] }}</p>
							<p class="fw-bold fs-14px mb-4 text-body-emphasis">
								@if($prod['discount']>0)
								 @php
							       $prod['discount'] = $prod['price'] - $prod['discount']
							    @endphp
								<span class=" fw-normal fs-13px text-decoration-line-through text-secondary pe-3">Rs. {{ $prod['price'] }}</span>
								<span>Rs. {{ $prod['discount'] }}</span>
								@else
								<span>Rs. {{ $prod['price'] }}</span>
								@endif
							</p>
							@if($prod['discount']>0)
								 @php
							       $prod['price'] = $prod['price'] - $prod['discount']
							    @endphp
							    <p class=" mb-0 text-secondary fw-normal"><span class=" fw-normal fs-13px text-secondary pe-3">Rs. {{ $prod['discount'] }} x {{ $prod['qty'] }} = Rs. {{ $prod['paid_price'] }}<span></span></p>
                                @else
                                <p class=" mb-0 text-secondary fw-normal"><span class=" fw-normal fs-13px text-secondary pe-3">Rs. {{ $prod['discount'] }} x {{ $prod['qty'] }} = Rs. {{ $prod['paid_price'] }}<span></span></p>
                                @endif
						</div>
					</div>
				</th>
			</tr>
			@endforeach
			<tr class="border">
			  <th>
			      <p class=" text-body-emphasis fw-semibold mb-5">Total : Rs. {{ $order['total_amount'] }}</p>
			  </th>  	
			</tr>
			
			<tr>
    			<td class="border-0 py-8 px-0">
    				<a onclick="track()" class="btn px-9 btn-outline-dark" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Track
    				</a>
    			</td>
			
			   <td class=" align-middle text-end pe-10">
					<span class="me-6">Payment Status</span>
					@if($order['paid']=='1')
					<button type="button" class="btn btn-primary position-relative">
                        Paid
                    </button>
                    @else
                    <button type="button" class="btn btn-primary position-relative">
                        Payment Failed
                        <span class="position-absolute top-0 start-100 translate-middle p-4 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </button>
                    @endif
				</td>
				
			   <td class=" align-middle text-end pe-10">@if($order['paid']=='1')
					<span class="me-6">Order Status</span>
					@if ($order['status']=='1')
    					<button type="button" class="btn btn-primary position-relative">
                            Accepted
                        </button>
                    @elseif ($order['status']=='2')
                        <button type="button" class="btn btn-primary position-relative">
                            Shipped
                        </button>
                    @elseif ($order['status']=='3')
                        <button type="button" class="btn btn-primary position-relative">
                            Delivered
                        </button>
                    @else
                        <button type="button" class="btn btn-primary position-relative">
                            Cancelled
                            <span class="position-absolute top-0 start-100 translate-middle p-4 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>
                    @endif
                    @else
                    <span class="me-6">Order Status</span>
                    <button type="button" class="btn btn-primary position-relative">
                            Cancelled
                            <span class="position-absolute top-0 start-100 translate-middle p-4 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>
                    @endif
				</td>
				
				<td>
				  
        		</div>
        	</div>   
				     
				</td>
				
		    </tr>
		</tbody>
	</table>
		<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
    		<div class="pt-8 pb-3">
    		    <table class="table" style="min-width: 710px">
		            <tbody>
			            <tr class="border">
                			  <th>
                			      <p class=" text-body-emphasis fw-semibold mb-5">Total : Rs. {{ $order['total_amount'] }}</p>
                			  </th>  	
			            </tr>
		            </tbody>
	            </table>
        	</div>
        </div>
    </form>

</section>
     @endforeach
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
					
<script>

    function track() {
    var orderId = document.getElementById("orderID").value;
    $.ajax({
                url: "{{ route('user.order.track') }}",
                data: {
                    id: orderId,
                },
                success: function(res) {
                    alert(res);
                }
            });
}
</script>

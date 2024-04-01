@if ($layout=='1')
  <input type="hidden" id="pricecarttotpass" value="{{ implode(',', array_keys($cart)) }}"/>
@endif


<table class="table border">
			<thead class="bg-body-secondary">
			<tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
				<th scope="col" class="fw-semibold border-1 ps-11">products</th>
				<th scope="col" class="fw-semibold border-1">quantity</th>
				<th colspan="2" class="fw-semibold border-1">Price</th>
			</tr>
			</thead>
			<tbody>
			
            @foreach ($prods as $prod)
			<tr class="position-relative" id="cart{{$layout!='1'?'wise':''}}listpvid_{{ $prod['pvid'] }}">
				<th scope="row" class="pe-5 ps-8 py-7 shop-product">
					<div class="d-flex align-items-center">
						<div class="ms-6 me-7">
							<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="lazy-image" width="75" height="100"
								 alt="{{ Str::limit($prod['name'], 26) }}">
						</div>
						<div class="">
							<p class="fw-500 mb-1 text-body-emphasis">{{{ $prod['name'] }}</p>
							<p class="card-text">
							    @if($prod['discount']>0)
								<span class="fs-13px fw-500 text-decoration-line-through pe-3">{{ $prod['price'] }}</span>
								<span class="fs-15px fw-bold text-body-emphasis">Rs. {{ $prod['discount'] }}</span>
								@else
								<span class="fs-15px fw-bold text-body-emphasis">{{ $prod['price'] }}</span>
								@endif
								
							</p>
						</div>
					</div>
					
				</th>
				@if ($layout=='1')
				<td class="align-middle">
					<div class="input-group position-relative shop-quantity">
						<a onclick="minCart({{ $prod['pvid'] }})" class="shop-down position-absolute z-index-2"><i class="far fa-minus"></i></a>
						
						<input id="abhi" value="{{ $cart[$prod['pvid']] ?? 1 }}"  type="text" readonly class="form-control form-control-sm px-10 py-4 fs-6 text-center border-0"></input>
						
						<a onclick="adCart({{ $prod['pvid'] }})" class="shop-up position-absolute z-index-2"><i class="far fa-plus"></i></a>
					</div>
				</td>
				<td class="align-middle">
					<p id="pricecartsingtot_{{ $prod['pvid'] }}"  class="mb-0 text-body-emphasis fw-bold mr-xl-11">Rs. {{ $prod['price']*$cart[$prod['pvid']]??1 }}</p>
				</td>
				@endif
				<td class="align-middle text-end pe-8">
					<a @if ($layout=='1') onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',2)" @else onclick="saveprod({{ $prod['pvid'] }})" @endif class="d-block text-secondary">
						<i class="fa fa-times"></i>
					</a>
				</td>
				
			</tr>
			@endforeach
			
			</tbody>
		</table>
    
    <script>
        function qtyCount(){
            
            $('#cartvalpvid_{{ $prod['pvid'] }}').empty().append(res);
          
        }
    </script>


                              


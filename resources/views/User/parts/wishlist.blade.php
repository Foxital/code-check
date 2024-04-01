@if ($layout=='1')
  <input type="hidden" id="pricecarttotpass" value="{{ implode(',', array_keys($cart)) }}"/>
@endif
@foreach ($prods as $prod)      


<table id="cart{{$layout!='2'?'wise':''}}listpvid_{{ $prod['pvid'] }}" class="table" style="min-width: 710px">
		<tbody>
        
			<tr class="border">
				<th scope="row" class=" ps-xl-10 py-6 d-flex align-items-center border-0">
					<a @if ($layout=='1') onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',2)" @else onclick="saveprod({{ $prod['pvid'] }})" @endif class=" d-block text-muted fw-lighter"><i class="fas fa-times"></i></a>
					<div class="d-flex align-items-center">
						<div class="ms-6 me-7">
							<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="img-fluid lazy-image" height="100" width="75" alt="">
						</div>
						<div>
							<p class=" text-body-emphasis fw-semibold mb-5" id="prod-name">{{ Str::limit($prod['name'], 26) }}</p>
							<p class="fw-bold fs-14px mb-4 text-body-emphasis">
							@if($prod['discount']>0)
							<span class=" fw-normal fs-13px text-decoration-line-through text-secondary pe-3">Rs. {{ $prod['price'] }}</span>
							<span>Rs. {{ $prod['discount'] }}</span>
							@else
							<span>Rs. {{ $prod['price'] }}</span>
							@endif
							</p>
						</div>
					</div>
				</th>
				<td class=" align-middle text-end pe-10">
					<span class="me-6">In stock</span>
					<a onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',1)" class="btn fs-15px px-9 lh-sm btn-outline-dark">Add To Cart</a>
				</td>
			</tr>
			
		</tbody>
	</table>

@endforeach                              


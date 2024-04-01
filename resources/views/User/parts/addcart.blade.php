@if ($layout=='1')
  <input type="hidden" id="pricecarttotpass" value="{{ implode(',', array_keys($cart)) }}"/>
@endif
@foreach ($prods as $prod)    

<!--Cart Outer-->
            <table class="table table-borderless" id="cart{{$layout!='1'?'wise':''}}listpvid_{{ $prod['pvid'] }}">
				<thead>
					<tr class="fw-500">
						<td colspan="3" class="pb-6"></td>
					</tr>
				</thead>
				<tbody >
				        <tr class="position-relative" id="cart{{$layout!='1'?'wise':''}}listpvid_{{ $prod['pvid'] }}">
							<td class="align-middle text-center">
								<a  @if ($layout=='1') onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',2)" @else onclick="saveprod({{ $prod['pvid'] }})" @endif class="d-block clear-product">
									<i class="far fa-times"></i>
								</a>
							</td>
							<td class="shop-product">
								<div class="d-flex align-items-center">
									<div class="me-6">
										<img src="{{ asset('uploads/Product/' . $prod['image']) }}" width="60" height="80" alt="{{ Str::limit($prod['name'], 26) }}">
									</div>
									<div class="">
										<p class="card-text mb-1">
										    @if($prod['discount']>0)
										    @php
										       $prod['price'] = $prod['price'] - $prod['discount']
										    @endphp
										    <span class="fs-13px fw-500 text-decoration-line-through pe-3">Rs. {{ $prod['price']+$prod['discount'] }}</span>
											<span class="fs-15px fw-bold text-body-emphasis">Rs. {{ $prod['price'] }}</span>
											<span @if ($layout=='1') style="display:none" @endif><del style="display:none">Rs. {{ $prod['discount'] }}</del> <span class="ml-2" style="display:none">Rs. <span @if ($layout=='1') id="pricecart_{{ $prod['pvid'] }}" @endif style="display:none">{{ $prod['price'] }}</span></span></span>
											@else
											<span @if ($layout=='1') style="display:none" @endif><delstyle="display:none">Rs. {{ $prod['discount'] }}</del> <span class="ml-2"style="display:none">Rs. <span @if ($layout=='1') id="pricecart_{{ $prod['pvid'] }}" @endif style="display:none">{{ $prod['price'] }}</span></span></span>
											<span class="fs-15px fw-bold text-body-emphasis">Rs. {{ $prod['price'] }}</span>
											@endif
										</p>
										<p class="fw-500 text-body-emphasis" id="prod-name">{{ Str::limit($prod['name'], 26) }}</p>
									</div>
								</div>
							</td>
							<td class="align-middle p-0">
								<div class="input-group position-relative shop-quantity">
								    @if ($layout=='1')
									<a onclick="minCart({{ $prod['pvid'] }})" class="shop-down position-absolute z-index-2"><i class="far fa-minus"></i></a>
									<input id="cartvalpvid_{{ $prod['pvid'] }}" readonly name="number[]" type="number" class="form-control form-control-sm px-6 py-4 fs-6 text-center border-0" value="{{ $cart[$prod['pvid']] ?? 1 }}">
									<a onclick="adCart({{ $prod['pvid'] }})" class="shop-up position-absolute z-index-2"><i class="far fa-plus"></i>
									</a>
									@endif
								</div>
							</td>
						</tr>
				</tbody>
			</table>
@endforeach                              


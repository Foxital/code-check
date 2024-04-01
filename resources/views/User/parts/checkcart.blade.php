@if ($layout=='1')
  <input type="hidden" id="pricecarttotpass" value="{{ implode(',', array_keys($cart)) }}"/>
@endif
@foreach ($prods as $prod)    

<div class="d-flex w-100 mb-7" id="cart{{$layout!='1'?'wise':''}}listpvid_{{ $prod['pvid'] }}">
					<div class="me-6">
						<img src="{{ asset('uploads/Product/'.$prod['image']) }}" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="lazy-image" width="60" height="80" alt="{{ Str::limit($prod['name'], 26) }}">
					</div>
					<div class="d-flex flex-grow-1">
						<div class="pe-6">
							<a href="#" class="" id="prod-name">{{ Str::limit($prod['name'], 26) }}<span class="text-body" id="cartvalpvid_{{ $prod['pvid'] }}"> x{{ $cart[$prod['pvid']] ?? 1 }}</span></a>
							
							
						</div>
						<div class="ms-auto">
						    @if($prod['discount']>0)
								@php
							       $prod['price'] = $prod['price'] - $prod['discount']
							    @endphp
										    
							 
							    <p class="fs-14px text-body-emphasis mb-0 fw-bold">Rs.{{$prod['price']}}</p>
						      @else
						        <p class="fs-14px text-body-emphasis mb-0 fw-bold">Rs.{{$prod['price']}}</p>
						      @endif  
						</div>
					</div>
                </div>



@endforeach                              


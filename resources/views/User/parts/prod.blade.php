<div class="card card-product grid-1 bg-transparent border-0" data-animate="fadeInUp">
	   <figure class="card-img-top position-relative mb-7 overflow-hidden " >
		   <a class="hover-zoom-in d-block" title="Shield Conditioner">
                <img src="#" data-src="{{ asset('uploads/Product/'.$prod['image']) }}" class="img-fluid lazy-image w-100" alt="Shield Conditioner" width="330" height="440">
            </a>
            
            <div class="position-absolute product-flash z-index-2 "></div>
		        <div class="position-absolute d-flex z-index-2 product-actions  horizontal">
		            <a onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',1)" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
                		<svg class="icon icon-shopping-bag-open-light">
                			<use xlink:href="#icon-shopping-bag-open-light"></use>
                		</svg>
	                 </a>
	                 <!--<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
	   href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quick View">
		<span data-bs-toggle="modal" data-bs-target="#quickViewModal" class="d-flex align-items-center justify-content-center">
			<svg class="icon icon-eye-light">
				<use xlink:href="#icon-eye-light"></use>
			</svg>
		</span>
	</a>-->
	                <a onclick="saveprod({{ $prod['id'] }})"  id="wishlistbtn_{{ $prod['id'] }}" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Wishlist">
                		<svg class="icon icon-star-light">
                			<use xlink:href="#icon-star-light"></use>
                		</svg>
                	</a>
                	<!--<a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare" href="./shop/compare.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Compare">
		<svg class="icon icon-arrows-left-right-light">
			<use xlink:href="#icon-arrows-left-right-light"></use>
		</svg>
	</a>-->
	        </div>
	   </figure>
	   <div class="card-body text-center p-0">
	       <span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
	           @if($prod['discount']>0)
	           <del class=" text-body fw-500 me-4 fs-13px">Rs. {{ $prod['price'] }}</del>
	           <ins class="text-decoration-none">Rs. {{ $prod['price'] - $prod['discount'] }}</ins></span>
	           @else
	           <ins class="text-decoration-none">Rs. {{ $prod['price'] }}</ins></span>
	           @endif
	           <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"><a class="text-decoration-none text-reset" href="{{ url('/product/'.$prod['link_code']) }}">{{ Str::limit($prod['name'], 26) }}</a></h4>
		   <!--<div class="d-flex align-items-center fs-12px justify-content-center">
	
	</div>-->
	   </div>
</div>

				

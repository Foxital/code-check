<div class="col-sm-6  col-lg-4 col-xl-3">
            <div class="card card-product grid-1 bg-transparent border-0" >
                <figure class="card-img-top position-relative mb-7 overflow-hidden " >
        		   <a href="{{ url('/product/'.$prod['link_code']) }}" class="hover-zoom-in d-block" title="{{ Str::limit($prod['name'], 26) }}">
                        <img src="#" data-src="{{ asset('uploads/Product/'.$prod['image']) }}" class="img-fluid lazy-image w-100" alt="{{ Str::limit($prod['name'], 26) }}" width="330" height="440">
                    </a>
		   
    <div class="position-absolute product-flash z-index-2 ">
        
    </div>
		   <div class="position-absolute d-flex z-index-2 product-actions  horizontal">
		       <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
		<svg class="icon icon-shopping-bag-open-light">
			<use xlink:href="#icon-shopping-bag-open-light"></use>
		</svg>
	</a><a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
	   href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quick View">
		<span data-bs-toggle="modal" data-bs-target="#quickViewModal" class="d-flex align-items-center justify-content-center">
			<svg class="icon icon-eye-light">
				<use xlink:href="#icon-eye-light"></use>
			</svg>
		</span>
	</a>
    <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Wishlist">
		<svg class="icon icon-star-light">
			<use xlink:href="#icon-star-light"></use>
		</svg>
	</a>
    <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare" href="../shop/compare.html" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Compare">
		<svg class="icon icon-arrows-left-right-light">
			<use xlink:href="#icon-arrows-left-right-light"></use>
		</svg>
	</a>
</div>
	   </figure>
	   <div class="card-body text-center p-0">
		   





<span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
        <del class=" text-body fw-500 me-4 fs-13px">$40.00</del>
        <ins class="text-decoration-none">$30.00</ins></span>

		   <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"><a class="text-decoration-none text-reset" href="../shop/product-details-v1.html">{{ Str::limit($prod['name'], 26) }}</a></h4>
		   <div class="d-flex align-items-center fs-12px justify-content-center">
	<div class="rating">
		<div class="empty-stars">
			<span class="star">
				<svg class="icon star-o">
					<use xlink:href="#star-o"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star-o">
					<use xlink:href="#star-o"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star-o">
					<use xlink:href="#star-o"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star-o">
					<use xlink:href="#star-o"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star-o">
					<use xlink:href="#star-o"></use>
				</svg>
			</span>
		</div>
		<div class="filled-stars"
			 style="width: 80%">
			<span class="star">
				<svg class="icon star text-primary">
					<use xlink:href="#star"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star text-primary">
					<use xlink:href="#star"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star text-primary">
					<use xlink:href="#star"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star text-primary">
					<use xlink:href="#star"></use>
				</svg>
			</span>
			<span class="star">
				<svg class="icon star text-primary">
					<use xlink:href="#star"></use>
				</svg>
			</span>
		</div>
	</div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span></div>
	   </div>
</div>
            </div>
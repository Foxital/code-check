@php
$page = 12*$data['pages'];
$sortby = explode('_', $data['sortby']);
$ptype = isset($data['page_type'])?$data['page_type']:1;
$catg = isset($data['catg'])?$data['catg']:'';
$scatg = isset($data['scatg'])?$data['scatg']:'';

$prods = \App\Models\Product::select('products.id', 'category_id', 'sub_category_id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount','product_varient.id as pvid')
    ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
    ->where('products.status', '1')
    ->where('product_varient.status', '1')
    ->when($catg, function ($query, $catg) {
        return $query->whereIn('category_id',$catg);
    })
    ->when($scatg, function ($query, $scatg) {
        return $query->whereIn('sub_category_id',$scatg);
    })
    ->orderBy($sortby[0],$sortby[1])
    ->offset($page)
    ->limit(12)
    ->get();
@endphp
@foreach ($prods as $prod)
    @if ($ptype==1)
        <div class="col-sm-6  col-lg-4 col-xl-3">
            <div class="card card-product grid-1 bg-transparent border-0" data-animate="fadeInUp">
                <figure class="card-img-top position-relative mb-7 overflow-hidden " >
        		   <a class="hover-zoom-in d-block" title="{{ Str::limit($prod['name'], 26) }}">
                        <img src="" data-src="{{ asset('uploads/Product/'.$prod['image']) }}" class="img-fluid lazy-image w-100" alt="{{ Str::limit($prod['name'], 26) }}" width="330" height="440">
                    </a>
		   
    <div class="position-absolute product-flash z-index-2 ">
        
    </div>
		   <div class="position-absolute d-flex z-index-2 product-actions  horizontal">
		       <a onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',1)" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
            		<svg class="icon icon-shopping-bag-open-light">
            			<use xlink:href="#icon-shopping-bag-open-light"></use>
            		</svg>
            	</a>
                <a onclick="saveprod({{ $prod['id'] }})"  id="wishlistbtn_{{ $prod['id'] }}" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Wishlist">
            		<svg class="icon icon-star-light">
            			<use xlink:href="#icon-star-light"></use>
            		</svg>
            	</a>
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
		   <div class="d-flex align-items-center fs-12px justify-content-center">
	    </div>
	   </div>
</div>
            </div>
    @else
        <div class="col-sm-6  col-lg-4 col-xl-3">
            <div class="card card-product grid-1 bg-transparent border-0" >
                <figure class="card-img-top position-relative mb-7 overflow-hidden " >
        		   <a class="hover-zoom-in d-block" title="{{ Str::limit($prod['name'], 26) }}">
                        <img src="#" data-src="{{ asset('uploads/Product/'.$prod['image']) }}" class="img-fluid lazy-image w-100" alt="{{ Str::limit($prod['name'], 26) }}" width="330" height="440">
                    </a>
		   
    <div class="position-absolute product-flash z-index-2 ">
        
    </div>
		   <div class="position-absolute d-flex z-index-2 product-actions  horizontal">
		       <a onclick="addCart({{ $prod['pvid'] }},'{{ csrf_token() }}',1)" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">
            		<svg class="icon icon-shopping-bag-open-light">
            			<use xlink:href="#icon-shopping-bag-open-light"></use>
            		</svg>
            	</a>
                <a onclick="saveprod({{ $prod['id'] }})"  id="wishlistbtn_{{ $prod['id'] }}" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Wishlist">
            		<svg class="icon icon-star-light">
            			<use xlink:href="#icon-star-light"></use>
            		</svg>
            	</a>
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
		   <div class="d-flex align-items-center fs-12px justify-content-center">
	    </div>
	   </div>
</div>
            </div>
    @endif
@endforeach

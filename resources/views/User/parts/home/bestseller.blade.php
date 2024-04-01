	@php
    $prods = \App\Models\Product::select('products.id','name','link_code','image','image1','label','price','discount','product_varient.id as pvid')
    ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
    ->leftJoin('wishlists', 'wishlists.product_id', '=', 'products.id')
    ->where('products.status','1')
    ->where('bestseller','1')
    ->where('product_varient.status','1')
    ->orderBy('id')
    ->limit(4)
    ->get();
@endphp

	<!-- Products Section -->
	<section id="because_you_need_time_for_yourself_1" class="container mt-4 mt-lg-12 py-4 mb-15 mb-lg-18" >
	    <div class="mb-13 text-center pb-3" data-animate="fadeInUp">
	        <img data-src="./assets/images/shop/image-box-01.png" width="150" height="158" class="mb-4 img-fluid lazy-image d-inline-block" alt="..." src="#">
		    <h2 class="h3 mb-0 mx-auto" style="max-width: 610px">Because You Need Time for Yourself. Blend Comfort in You</h2>
	    </div>
	    
	    <div class="row gy-50px">
	         @foreach ($prods as $prod)
	        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
	        @include('User.parts.prod',['prod' => $prod])
	        </div>
	        @endforeach
		</div>
		
	<div class="text-center mt-12" data-animate="fadeInUp">
		<a href="{{ url('/shop') }}" class="btn btn-outline-dark">
			Shop All Product
		</a>
	</div>
</section>
	<!-- End Products Section -->
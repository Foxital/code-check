@extends('User.layouts.app')
@section('content')

@php
$prodvarient = $prod->ProductVarient[0];
$i=1;
@endphp

	<!-- Shop Detail Section -->
	<section class="z-index-2 position-relative pb-2 mb-12">
    
    <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a title="Shop" href="{{ url('/shop') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $prod['name'] }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

            <section class="container container-xxl pt-6 pb-13 pb-lg-20">
                	<div class="row ">
                		<div class="col-md-6 pe-lg-13">
                			<div class="position-sticky top-0">
                				<div class="row">
                	<div class="col-xl-2 pe-xl-0 order-1 order-xl-0 mt-5 mt-xl-0">
                		<div id="slide-thumb-5" class="slick-slider slick-slider-thumb ps-1 ms-n3 me-n4 mx-xl-0" data-slick-options='{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slide-5&#34;,&#34;dots&#34;:false,&#34;focusOnSelect&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1260,&#34;settings&#34;:{&#34;vertical&#34;:false}}],&#34;slidesToShow&#34;:4,&#34;vertical&#34;:true}'>
                				<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="cursor-pointer lazy-image h-auto mx-3 mx-xl-0 px-0 mb-xl-7" width="540" height="720" alt="">
                				<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image1']) }}" class="cursor-pointer lazy-image h-auto mx-3 mx-xl-0 px-0 mb-xl-7" width="540" height="720" alt="">
                				<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image2']) }}" class="cursor-pointer lazy-image h-auto mx-3 mx-xl-0 px-0 mb-xl-7" width="540" height="720" alt="">
                				<img src="#" data-src="{{ asset('uploads/Product/' . $prod['image3']) }}" class="cursor-pointer lazy-image h-auto mx-3 mx-xl-0 px-0 mb-xl-7" width="540" height="720" alt="">
                		</div>
                	</div>
                	<div class="col-xl-10 ps-xl-8 pe-xl-0 order-0 order-xl-1">
                		<div class="position-relative">
                            <div class="position-absolute z-index-2 w-100 d-flex justify-content-end">
                                
                            </div>
                		</div>
                		<div id="slide-5" class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0" data-slick-options='{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slide-thumb-5&#34;,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1,&#34;vertical&#34;:true}'>
                				<a href="{{ asset('uploads/Product/' . $prod['image']) }}" data-gallery="gallery5"><img src="#" data-src="{{ asset('uploads/Product/' . $prod['image']) }}" class="h-auto lazy-image" width="540" height="720" alt=""></a>
                				<a href="{{ asset('uploads/Product/' . $prod['image1']) }}" data-gallery="gallery5"><img src="#" data-src="{{ asset('uploads/Product/' . $prod['image1']) }}" class="h-auto lazy-image" width="540" height="720" alt=""></a>
                				<a href="{{ asset('uploads/Product/' . $prod['image2']) }}" data-gallery="gallery5"><img src="#" data-src="{{ asset('uploads/Product/' . $prod['image2']) }}" class="h-auto lazy-image" width="540" height="720" alt=""></a>
                				<a href="{{ asset('uploads/Product/' . $prod['image3']) }}" data-gallery="gallery5"><img src="#" data-src="{{ asset('uploads/Product/' . $prod['image3']) }}" class="h-auto lazy-image" width="540" height="720" alt=""></a>
                		</div>
                	</div>
                </div>
			</div>
		</div>
		<div class="col-md-6 pt-md-0 pt-10">
            <p class="d-flex align-items-center mb-6">
                @if($prodvarient['discount']>0)
    			<span class="text-decoration-line-through">Rs. {{ $prodvarient['price'] }}</span>
    		    <span class="fs-18px text-body-emphasis ps-6 fw-bold">Rs. {{ $prodvarient['price']-$prodvarient['discount'] }}</span>
    		    @else
    		    <span class="fs-18px text-body-emphasis ps-6 fw-bold">Rs. {{ $prodvarient['price'] }}</span>
    		    @endif
            </p>
            
	        <h1 class="mb-4 pb-2 fs-4">{{ $prod['name'] }}</h1>
	        
	        <p class="fs-15px">{{ $prod['meta_descp'] }}</p>

            <div class="pb-8">
            
                <div class="row align-items-end">
            	<div class="form-group col-sm-4">
            		<label class=" text-body-emphasis fw-semibold fs-15px pb-6" for="number">Quantity: </label>
            		<div class="input-group position-relative w-100 input-group-lg">
            			<a class="shop-down position-absolute translate-middle-y top-50 start-0 ps-7 product-info-2-minus"><i class="far fa-minus"></i></a>
            			<input name="number" type="number"  id="cartvalmainpvid" class="product-info-2-quantity form-control w-100 px-6 text-center" value="{{ $cookies[$prodvarient['id']] ?? 1 }}" readonly>
            			<a class="shop-up position-absolute translate-middle-y top-50 end-0 pe-7 product-info-2-plus"><i class="far fa-plus"></i>
            			</a>
            		</div>
            	</div>
            	<div class="col-sm-8 pt-9 mt-2 mt-sm-0 pt-sm-0">
            		<button onclick="addtocartmain(0)" class="btn-hover-bg-primary btn-hover-border-primary btn btn-lg btn-dark w-100">Add To Bag
            		</button>
            	</div>
            </div>
        </div>
        
        <div class="d-flex align-items-center flex-wrap">
        		<a onclick="saveprod({{ $prod['id'] }})"  id="wishlistbtn_{{ $prod['id'] }}" class="text-decoration-none fw-semibold fs-6 me-9 pe-2 d-flex align-items-center">
        			<svg class="icon fs-5">
        				<use xlink:href="#icon-star-light"></use>
        			</svg>
        			<span class="ms-4 ps-2">Add to wishlist</span>
        		</a>
        		<a href="https://api.whatsapp.com/send?text=%0a{{ url('/product/'.$prod['link_code']) }}" class="text-decoration-none fw-semibold fs-6 me-9 pe-2 d-flex align-items-center">
        			<svg class="icon fs-5">
        				<use xlink:href="#icon-ShareNetwork"></use>
        			</svg>
        			<span class="ms-4 ps-2">Share</span>
        		</a>
        </div>
        
        <ul class="single-product-meta list-unstyled border-top pt-7 mt-7">
        		<li class="d-flex mb-4 pb-2 align-items-center">
        			<span class="text-body-emphasis fw-semibold fs-14px">Sku:</span>
        			<span class="ps-4">SF09281</span>
        		</li>
        		<li class="d-flex mb-4 pb-2 align-items-center">
        			<span class="text-body-emphasis fw-semibold fs-14px">Categories:</span>
        			<span class="ps-4">{{ $prod->ProdCatg['name'] }}</span>
        		</li>
        </ul>

<div class="mt-13">
    <div class="accordion accordion-flush" id="accordionFlushExample">
	<div class="accordion-item pb-4">
		<h2 class="accordion-header" id="flush-headingOne">
			<a class="product-info-accordion text-decoration-none" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
				<span class="fs-4">Product Detail</span>
			</a>
		</h2>
	</div>
	<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
		<div class="pt-8 pb-3">
			<!--<p class="fw-semibold text-body-emphasis mb-2 pb-4">For Normal, Oily, Combination Skin Types</p>-->
			<p class="mb-2 pb-4">
			    {!! $prod['description'] !!}
			</p>
		</div>
	</div>
	<div class="accordion-item pb-4 mt-7">
		<h2 class="accordion-header" id="flush-headingTwo">
			<a class="product-info-accordion collapsed text-decoration-none" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
				<span class="fs-4">How To Use</span>
			</a>
		</h2>
	</div>
	<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
		<div class="pt-8 pb-3">
			<!--<p class="fw-semibold text-body-emphasis mb-2 pb-4">Follow these safety guidelines when
				using cosmetics products of any type:</p>-->
			<p class="mb-2 pb-4">
			    {!! $prod['how_to_use'] !!}
			</p>
		</div>
	</div>
</div>
</div>		
</div>
</div>
</section>

<div class="border-top w-100"></div>
<section class="container pt-15 pb-15 pt-lg-17 pb-lg-20">
	<div class="text-center" ><h3 class="mb-12">Customer Reviews</h3></div>

	<div class="mb-11">
		<div class=" d-md-flex justify-content-between align-items-center">
	<div class=" d-flex align-items-center">
	    <h4 class="fs-1 me-9 mb-0">{{$average}}</h4>
		<div class="p-0">
		<div class="d-flex align-items-center fs-6 ls-0 mb-4">
		    @if($average==1)
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
        			 style="width: 20%">
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
	</div>
	        @elseif($average>1 && $average < 2)
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
        			 style="width: 30%">
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
	</div>
	        @elseif($average==2)
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
        			 style="width: 40%">
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
	</div>
	        @elseif($average>2 && $average< 3)
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
        			 style="width:50%">
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
    	</div>
	        @elseif($average==3)
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
        			 style="width: 60%">
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
	</div>
	        @elseif($average>3 && $average< 4)
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
        			 style="width: 71%">
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
	</div>
	        @elseif($average==4)
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
	</div>
	        @elseif($average>4 && $average< 5)
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
        			 style="width: 92%">
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
	</div>
	        @elseif($average==5)
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
        			 style="width: 100%">
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
	</div>
	        @endif
	    </div>
	<p class="mb-0">{{$count}} Reviews</p>
		</div>
	</div>
	<div class="text-md-end mt-md-0 mt-7">
		<a href="#customer-review" class="btn btn-outline-dark" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="customer-review"><svg class="icon">
				<use xlink:href="#icon-Pencil"></use>
			</svg>
			Wire A Review
		</a>
	</div>
</div>

	</div>
	<div class="collapse mb-14" id="customer-review">
	<form id="reviewform" class="product-review-form">
	    @csrf
	    <input id="linkcode" class="form-control" type="hidden" name="linkcode" value="{{$prod['link_code']}}" required>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group mb-7">
					<label class="mb-4 fs-6 fw-semibold text-body-emphasis" for="reviewName">Name</label>
					<input id="reviewName" class="form-control" type="text" name="name" required>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group mb-4">
					<label class="mb-4 fs-6 fw-semibold text-body-emphasis" for="reviewEmail">Email</label>
					<input id="reviewEmail" type="email" name="email" class="form-control" required>
				</div>
			</div>
		</div>
		<div>
			<p class="mt-4 mb-5 fs-6 fw-semibold text-body-emphasis">Your Rating*</p>
			<div class="form-group mb-6 d-flex justify-content-start">
				<div class="rate-input">
					<input type="radio" id="star5" name="rate" value="5" style="" required>
					<label for="star5" title="text" class="mb-0 mr-1 lh-1">
						<i class="far fa-star"></i>
					</label>
					<input type="radio" id="star4" name="rate" value="4" style="" required>
					<label for="star4" title="text" class="mb-0 mr-1 lh-1">
						<i class="far fa-star"></i>
					</label>
					<input type="radio" id="star3" name="rate" value="3" style="" required>
					<label for="star3" title="text" class="mb-0 mr-1 lh-1">
						<i class="far fa-star"></i>
					</label>
					<input type="radio" id="star2" name="rate" value="2" style="" required>
					<label for="star2" title="text" class="mb-0 mr-1 lh-1">
						<i class="far fa-star"></i>
					</label>
					<input type="radio" id="star1" name="rate" value="1" style="" required>
					<label for="star1" title="text" class="mb-0 mr-1 lh-1">
						<i class="far fa-star"></i>
					</label>
				</div>
			</div>
		</div>
		<div class="form-group mb-10">
			<label class="mb-4 fs-6 fw-semibold text-body-emphasis" for="reviewMessage">How was your overall experience?</label>
			<textarea id="reviewMessage" class="form-control" name="message" rows="5" required></textarea>
		</div>
		<div class="d-flex">
		    <button type="submit" id="review-btn" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary fw-semibold">Submit Now</button>
		</div>
	</form>
</div>

	<div class=" mt-12">
	@if($count>0)    
	<h3 class="fs-5">{{$count}} Reviews</h3>
	 @foreach ($review as $rev)
	<div class="border-bottom pb-7 pt-10">
	    <div class="d-flex align-items-center mb-6">
	        @if($rev['rate']==1)
		    <div class="d-flex align-items-center fs-15px ls-0">
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
            			 style="width: 100%">
            			<span class="star">
            				<svg class="icon star text-primary">
            					<use xlink:href="#star"></use>
            				</svg>
            			</span>
            		</div>
            	</div>
	        </div>
	        @elseif($rev['rate']==2)
	        <div class="d-flex align-items-center fs-15px ls-0">
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
            			 style="width: 100%">
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
            	</div>
	        </div>
	        @elseif($rev['rate']==3)
	        <div class="d-flex align-items-center fs-15px ls-0">
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
            			 style="width: 100%">
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
            	</div>
	        </div>
	        @elseif($rev['rate']==4)
	        <div class="d-flex align-items-center fs-15px ls-0">
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
            			 style="width: 100%">
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
            	</div>
	        </div>
	        @elseif($rev['rate']==5)
	        <div class="d-flex align-items-center fs-15px ls-0">
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
            			 style="width: 100%">
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
            	</div>
	        </div>
	        @endif
		</div>
		<div class="d-flex justify-content-start align-items-center mb-5">
			<img src="{{ asset('assets/images/avatar/' . $rev['image'])}}" data-src="{{ asset('assets/images/avatar/' . $rev['image'])}}" class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar">
			<div class="">
				<h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">{!! $rev['name'] !!}</h5>
			</div>
		</div>
		<p class="mb-10 fs-6">{!! $rev['message'] !!}</p>
	</div>
	@endforeach
	@else
	<h3 class="fs-5">No Reviews</h3>
	@endif
</div>


	<!--<nav class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination" >
    <ul class="pagination m-0">
        <li class="page-item">
            <a class="page-link rounded-circle d-flex align-items-center justify-content-center" href="#" aria-label="Previous">
                <svg class="icon">
                    <use xlink:href="#icon-angle-double-left"></use>
                </svg>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="#">6</a></li>
        <li class="page-item">
            <a class="page-link rounded-circle d-flex align-items-center justify-content-center" href="#" aria-label="Next">
                <svg class="icon">
                    <use xlink:href="#icon-angle-double-right"></use>
                </svg>
            </a>
        </li>
    </ul>
</nav>-->
</section>

	<!-- End Shop Page Section -->
	@php
$prods = \App\Models\Product::select('products.id', 'name', 'link_code', 'image', 'image1', 'label', 'price', 'discount')
->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
->where('products.status', '1')
->where('product_varient.status', '1')
->where('products.featured', '1')
->orderBy('id')
->limit(4)
->get();
@endphp

	<!-- Products Section Six -->
	<section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
    	<div class="text-center" ><h2 class="mb-12">You may also like</h2></div>
    
    	<div class="slick-slider" data-slick-options="{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}">
    		@foreach ($prods as $prod)
    		<div class="mb-6">
    			<div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="{{ asset('uploads/Product/'.$prod['image']) }}" class="hover-zoom-in d-block" title="{{ $prod['name'] }}">
                            <img src="#" data-src="{{ asset('uploads/Product/'.$prod['image']) }}" class="img-fluid lazy-image w-100" alt="{{ $prod['name'] }}" width="330" height="440">
                        </a>
                        
                    <div class="position-absolute product-flash z-index-2 ">
                        <!--<span class="badge badge-product-flash on-sale bg-primary">-25%</span>-->
                    </div>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical">
                            <a onclick="saveprod({{ $prod['id'] }})" id="wishlistbtn_{{ $prod['id'] }}" class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Add To Wishlist">
                        		<svg class="icon icon-star-light">
                        			<use xlink:href="#icon-star-light"></use>
                        		</svg>
                        	</a>
                        </div>
                            <a onclick="addCart({{ $prod['id'] }},'{{ csrf_token() }}',1)" class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add To Cart</a>
                    </figure>
                    
                    <div class="card-body text-center p-0">
                    <span class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                            @if($prod['discount']>0)
                            <del class=" text-body fw-500 me-4 fs-13px">Rs. {{ $prod['price'] }}</del>
                            <ins class="text-decoration-none">Rs. {{ $prod['price'] - $prod['discount'] }}</span>
                            @else
                            <ins class="text-decoration-none">Rs. {{ $prod['price'] }}</span>
                            @endif
                    
                            <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                <a class="text-decoration-none text-reset" href="{{ url('/product/'.$prod['link_code']) }}">{{ $prod['name'] }}</a>
                            </h4>
                            
                        </div>
                    </div>
    
    		</div>
    		@endforeach
    	</div>
    </section>
	
	<!-- End Products Section Six -->

@endsection
@section('bottomScript')
<script>
    var cookies = JSON.parse('<?=json_encode($cookies)?>');
    
    
 
     
         $('#reviewform').submit(function(e) {
            e.preventDefault();
                $.ajax({
                url: "{{ route('user.save.review') }}",
                type: 'POST',
                data: $('#reviewform').serialize(),
                error: function(err) {
                    @if (isset(Auth::user()->name))
                       toastr.error('Error', 'Please try again after sometime');
                    @else
                        toastr.error('Error', 'Please login to add review');
                        
                    @endif    
                },
                success: function(res) {
                    toastr.clear();
                    if (res.success == '1') {
                        toastr.success('Success','Your review will be published after review');
                        $('#reviewform')[0].reset();
                    } else {
                        toastr.error('Error', 'Please Try again');
                    }
                }
            });
        })
  
        
  

    function minCartmain() {
        var getval = $('#cartvalmainpvid').val();
        if (getval > 1) {
            getval--;
        }
        $('#cartvalmainpvid').val(getval);
    }

    function adCartmain() {
        var getval = $('#cartvalmainpvid').val();
        getval++;
        $('#cartvalmainpvid').val(getval);
    }
    var pvid = parseInt('{{ $prodvarient['id'] }}');

    function addtocartmain(stype) {
        var addval = $('#cartvalmainpvid').val();
        var token = "{{ csrf_token() }}";
        var type = 3;
        $.ajax({
            url: "{{ route('user.addtocart') }}",
            method: 'POST',
            data: {
                id: pvid,
                type: type,
                _token: token,
                addval: addval
            },
            success: function(res) {
                if(stype=='1'){
                    window.location.href = "{{ url('/checkout') }}";
                }else if(stype=='0'){
                    cartCount();
                    showcart();
                }
                cartCount();
            }
        });
    }

    function activeprod(id) {
        pvid = id;
        var getval = typeof cookies[id] !== 'undefined' ? cookies[id] : 1;
        $('#cartvalmainpvid').val(getval);
        $('.custom-swatch').removeClass('active');
        $('#custom_swatch_' + id).addClass('active');
    }

    imageZoom("prod_target","prod_target_viewer");
    
    function imageZoom(imgID, resultID) {
      var img, lens, result, cx, cy;
      img = document.getElementById(imgID);
      result = document.getElementById(resultID);
      /*create lens:*/
      lens = document.createElement("DIV");
      lens.setAttribute("class", "img-zoom-lens");
      /*insert lens:*/
      img.parentElement.insertBefore(lens, img);
      /*calculate the ratio between result DIV and lens:*/
      cx = result.offsetWidth / lens.offsetWidth;
      cy = result.offsetHeight / lens.offsetHeight;
      /*set background properties for the result DIV:*/
      result.style.backgroundImage = "url('" + img.src + "')";
      result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
      /*execute a function when someone moves the cursor over the image, or the lens:*/
      lens.addEventListener("mousemove", moveLens);
      img.addEventListener("mousemove", moveLens);
      /*and also for touch screens:*/
      lens.addEventListener("touchmove", moveLens);
      img.addEventListener("touchmove", moveLens);
      function moveLens(e) {
        var pos, x, y;
        /*prevent any other actions that may occur when moving over the image:*/
        e.preventDefault();
        /*get the cursor's x and y positions:*/
        pos = getCursorPos(e);
        /*calculate the position of the lens:*/
        x = pos.x - (lens.offsetWidth / 2);
        y = pos.y - (lens.offsetHeight / 2);
        /*prevent the lens from being positioned outside the image:*/
        if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
        if (x < 0) {x = 0;}
        if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
        if (y < 0) {y = 0;}
        /*set the position of the lens:*/
        lens.style.left = x + "px";
        lens.style.top = y + "px";
        /*display what the lens "sees":*/
        result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
      }
      function getCursorPos(e) {
        var a, x = 0, y = 0;
        e = e || window.event;
        /*get the x and y positions of the image:*/
        a = img.getBoundingClientRect();
        /*calculate the cursor's x and y coordinates, relative to the image:*/
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        /*consider any page scrolling:*/
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return {x : x, y : y};
      }
    }
    
    function setmainimg(url){
        $('#prod_target').attr("src",url);
        $('.img-zoom-lens').remove();
        imageZoom("prod_target","prod_target_viewer");
    }
    
</script>
@endsection

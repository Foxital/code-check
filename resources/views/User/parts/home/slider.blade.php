@php
    $sliders = \App\Models\Banner::select('id','name','image','image1','link_code')->where('status','=','1')->orderBy('lineup')->limit(10)->get();
@endphp


<main id="content" class="wrapper layout-page">
    <section>
        <div class="slick-slider hero hero-header-05 slick-slider-dots-inside" data-slick-options='{&#34;arrows&#34;:false,&#34;autoplay&#34;:true,&#34;cssEase&#34;:&#34;ease-in-out&#34;,&#34;dots&#34;:false,&#34;fade&#34;:true,&#34;infinite&#34;:true,&#34;slidesToShow&#34;:1,&#34;speed&#34;:600}'>
            @foreach ($sliders as $k=>$slider)
            <div class="vh-100 d-flex align-items-center">
				<div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
				    <!--<div class="hero-content text-start">
				        <div data-animate="fadeInDown">
				            <p class="text-primary mb-8 fw-semibold fs-4">New Collection</p><h1 class="mb-11 text-body-emphasis hero-title-5">Get The Skin<br>You Want To Feel</h1>
	                    </div>
	                    <a href="{{ $slider['link_code'] }}" data-animate="fadeInUp" class="pb-2 bg-transparent fw-semibold text-decoration-none hero-link p-0 fs-6 text-body-emphasis">
                    		Discover Now
                    		<svg class="icon">
                    			<use xlink:href="#icon-arrow-right"></use>
                    		</svg>
                    	</a>
                    </div>-->
				</div>
                <div class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100   light-mode-img" data-bg-src="{{ asset('uploads/Banner/'.$slider['image']) }}"></div>
                <div class="lazy-bg bg-overlay dark-mode-img position-absolute z-index-1 w-100 h-100" data-bg-src="{{ asset('uploads/Banner/'.$slider['image']) }}">
                </div></div>
            @endforeach    
        </div>
    </section>
    
</main>    
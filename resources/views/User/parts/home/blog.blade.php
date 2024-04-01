@php
$blogs = \App\Models\Blog::select('id','name','link_code','image','meta_descp','created_at')
->where('status','1')
->orderByRaw('created_at DESC')
->limit(3)
->get();
@endphp

<!-- News Section -->
<section id="from_our_blog">
    
    <div class="pt-14 pb-15 py-lg-18 mb-3 mt-1">
        <div class="container">
            <div class="text-center"  data-animate="fadeInUp"><h2 class="mb-6">From Our Blog</h2>
		<p class="fs-18px mb-0 mw-xl-50 mw-lg-75 ms-auto me-auto">Our bundles were designed to conveniently package your tanning essentials while saving you money.</p></div>

        </div>
        <div class="container container-xxl mt-12 pt-3">
            <div class="slick-slider" data-slick-options='{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;dots&#34;:true,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:768,&#34;settings&#34;:{&#34;dots&#34;:true,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:3}'>
                    @foreach ($blogs as $blog)
                    <div>
                        <article class="card card-post-grid-3 bg-transparent border-0" data-animate="fadeInUp">
                        	<figure class="card-img-top mb-8 position-relative">
                        	    <a href="#" class="hover-shine hover-zoom-in d-block" title="{{ $blog['name'] }}">
                        	        <img data-src="{{ $blog['image'] != '' && $blog['image'] != null ? asset('uploads/Blog/' . $blog['image']) : asset('uploads/dummy.jpg') }}" class="img-fluid lazy-image w-100" alt="{{ $blog['name'] }}" width="450" height="290" src="#">
                                </a>
                            </figure>
                        	<div class="card-body p-0">
                        		<ul class="post-meta list-inline lh-1 d-flex flex-wrap fs-13px text-uppercase ls-1 fw-semibold m-0">
                        		     <li class="border-start ps-5 ms-5 list-inline-item">{{ $blog['created_at'] }}</li>
                        		</ul>
                        		<h4 class="card-title lh-base mt-5 pt-2 mb-0">
                        			<a class="text-decoration-none" href="{{'/blog/'.$blog['link_code'] }}" title="{{ $blog['name'] }}">{{ $blog['name'] }}</a>
                        		</h4>
                        	</div>
                        </article>
                    </div>
                    @endforeach
                </div>
            <div class="text-center pt-2" data-animate="fadeInUp">
                <a href="#" class="mt-12 btn btn-outline-dark">View All Posts</a>
            </div>
        </div>
    </div>
</section>
<!-- End News Section -->
	 

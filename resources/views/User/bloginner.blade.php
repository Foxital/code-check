@extends('User.layouts.app')
@php
						$currenturl = url()->full();
                       
                        @endphp
@section('content')

<section class="z-index-2 position-relative pb-2 mb-12">
    <div class="bg-body-secondary mb-3">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1 mb-0">
                    <li class="breadcrumb-item"><a title="Home" href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog updates</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<section class="pt-10 pb-16 pb-lg-18 container">
	<div class="px-lg-25 px-0">
		<div class=" text-center mb-13">
	<a href="#" class="btn btn-light btn-hover-bg-dark btn-hover-border-dark btn-hover-text-light shadow-none py-0 px-6 mb-6">
		{{ $blogcatgs[$data['category_id']-1]->name }}
	</a>
	<h2 class=" px-6 text-body-emphasis border-0 fw-500 mb-4 fs-3 ">
		{{ $data['name'] }}
	</h2>
	<ul class="list-inline fs-15px fw-semibold letter-spacing-01 d-flex justify-content-center align-items-center">
		<li class="border-end px-6 text-body-emphasis border-0 text-body">
			By
			<a href="#">Admin</a>
		</li>
		<li class="list-inline-item px-6">{{ $data['created_at'] }}</li>
	</ul>
</div>
	</div>
	<div class="">
	<div class="px-lg-25 px-0">
		<p class=" mb-6">{{ $data['meta_descp'] }}</p>
	</div>
	<img  data-src="{{ $data['image'] != '' && $data['image'] != null ? asset('uploads/Blog/' . $data['image']) : asset('uploads/dummy.jpg') }}" width="1170" height="700" alt="" class="lazy-image mb-13 img-fluid mt-10" src="#">
	<div class="px-lg-25 px-0">
		<p class=" mb-6">{!! $data['description'] !!}</p>
	</div>
</div>
	<div class="px-lg-25 px-0">
	    <div class="row no-gutters pt-11 justify-content-sm-between">
	<div class="col-sm-6 mb-4 mb-sm-0">
		
	</div>
	<div class="col-sm-6 d-flex justify-content-sm-end">
		<label class="text-secondary fw-semibold me-7 mb-0">Share:</label>
		<ul class="list-inline mb-0 lh-1"><li class="list-inline-item me-7">
				<a href="https://twitter.com/intent/tweet?text={{$currenturl}}" class="fs-18px lh-14 fw-normal">
					<i class="fa-brands fa-twitter"></i>
				</a>
			</li><li class="list-inline-item me-7">
				<a href="https://www.facebook.com/sharer/sharer.php?u={{$currenturl}}" class="fs-18px lh-14 fw-normal">
					<i class="fa-brands fa-facebook-f"></i>
				</a>
			</li><li class="list-inline-item me-7">
				<a href="https://www.linkedin.com/shareArticle?mini=true&url={{$currenturl}}" class="fs-18px lh-14 fw-normal">
					<i class="fa-brands fa-linkedin"></i>
				</a>
			</li><li class="list-inline-item me-7">
				<a href="https://api.whatsapp.com/send?text=%0a{{$currenturl}}" class="fs-18px lh-14 fw-normal">
					<i class="fa-brands fa-whatsapp"></i>
				</a>
			</li></ul>
	</div>
	<div class="col-12 mt-5 mb-7">
		<div class="border-bottom"></div>
	</div>
</div>
	</div>
	<div class="px-lg-25 px-0">
		<div class="pt-14 pb-13 pb-lg-15 pt-lg-18 mx-n5" id="post_related">
	<div class="container">
		<div class="text-center" ><h2 class="mb-6 fs-3">Related Posts</h2></div>
	</div>
	<div class="container container-xxl mt-10 pt-3">
		<div class="slick-slider" data-slick-options='{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;dots&#34;:true,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:768,&#34;settings&#34;:{&#34;dots&#34;:true,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:3}'>
		    @foreach ($blogs as $blog)
		    <div>
					<article class="card card-post-grid-3 bg-transparent border-0" data-animate="fadeInUp">
	<figure class="card-img-top mb-8 position-relative">
	    <a href="{{'/blog/'.$blog['link_code'] }}" class="hover-shine hover-zoom-in d-block" title="{{ $blog['name'] }}">
    <img data-src="{{ $blog['image'] != '' && $blog['image'] != null ? asset('uploads/Blog/' . $blog['image']) : asset('uploads/dummy.jpg') }}" class="img-fluid lazy-image w-100" alt="{{ $blog['name'] }}" width="237" height="288" src="#">
</a></figure>
	<div class="card-body p-0">
		<ul class="post-meta list-inline lh-1 d-flex flex-wrap fs-13px text-uppercase ls-1 fw-semibold m-0">
			<li class="list-inline-item"><a
						class="text-reset text-decoration-none text-primary-hover" href="#"
						title="Videos">{{ $blogcatgs[$blog['category_id']-1]->name }}</a></li></ul>
		<h4 class="card-title fs-6 lh-base mt-5 pt-2 mb-0">
			<a class="text-decoration-none" href="{{'/blog/'.$blog['link_code'] }}" title="{{ $blog['name'] }}">{{ $blog['name'] }}</a>
		</h4>
	</div>
</article>
				</div>
			@endforeach	
				
		</div>
</div>

 </div>
</section>


@endsection

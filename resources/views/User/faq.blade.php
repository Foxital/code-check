@extends('User.layouts.app')
@php
$faqslists = \App\Models\Faq::where('status', '1')
->where('link_code', Request::path())
->orderBy('lineup')
->get();
@endphp
@section('content')
<style>
    .textdescript ul {
        padding: 0;
    }
    .textdescript ul li {
        list-style: none;
        padding: 5px;
        font-size: 20px;
        cursor: pointer;
    }

     .page-title{
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/faq-desk.jpg?updatedAt=1691814757824);
    }
        
    
/*-----For mobile: ---------------*/    
@media (max-width: 480px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/mob.jpg?updatedAt=1692028778073);
    }
}

/*-----For tablets: ---------------*/
@media (min-width: 481px) and (max-width: 1024px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/mob.jpg?updatedAt=1692028778073);
    }
}
/*-----For Desktops: ---------------*/
@media (min-width: 1025px) {
    .page-title {
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/faq-desk.jpg?updatedAt=1691814757824);
   }
}

.sticky{
    flex-grow: 1;
  flex-basis: 300px;
  position: sticky;
  top: 6rem;

}
</style>
<!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
			<h2 style="color:#254e58;">FAQ</h2>
			<ul class="bread-crumb clearfix">
				<li><a style="color:#254e58;">We have answered your questions</a></li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->

          <div class="business-box" style="margin: 50px">
									<div class="row clearfix">
										<!-- Column -->
										<div class="column col-lg-6 col-md-6 col-sm-12">
											<div class="image-two" style="margin-bottom: 20px">
												<img src="{{asset('assets/images/resources/faq.png')}}" alt="" />
											</div>
										</div>
										<div class="column col-lg-6 col-md-6 col-sm-12">
							
											<!-- Accordion Box -->
											<ul class="accordion-box style-three">
															
												<!--Block-->
												@foreach ($faqslists as $key => $val)
												<li class="accordion block">
													<div class="acc-btn"><div class="icon-outer"><span class="icon icon-plus fa fa-plus"></span> <span class="icon icon-minus fa fa-minus"></span></div>{{ $val['question'] }}</div>
													<div class="acc-content">
														<div class="content">
															<div class="text">{!! $val['answer'] !!}</div>
														</div>
													</div>
												</li>
												@endforeach
											</ul>
											
										</div>
									</div>
								</div>


@endsection

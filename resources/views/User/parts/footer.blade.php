<footer class="pt-16 pt-lg-19 pb-16 footer">
	<div class="container container-xxl pt-4">
		<div class="row">
			<div class="col-lg-5 col-12 mb-11 mb-lg-0">
                
<h3 class="mb-6 text-primary">Care for Your Skin, <br> Care for Your Beauty</h3>
<p >Give your inbox some love with new products, tips, &amp; more.</p>
				

<form method="POST" id="cusnewsletterform" class="pt-6 pe-xl-8 form-border-transparent">
    @csrf
	<div class="input-group position-relative">
		<input id="cusnewsletterformemail" name="email" type="email" class="form-control rounded pe-15 lh-1 py-7" placeholder="Your email">
		<button type="submit" class="btn fs-28px bg-transparent text-secondary position-absolute btn-custom px-8 z-index-5 h-100 lh-0">
			<svg class="icon icon-long-arrow-right">
				<use xlink:href="#icon-long-arrow-right"></use>
			</svg>
		</button>
	</div>
</form>
			</div>
			<div class="col-md col-12 mb-11 mb-lg-0 offset-lg-2">
                <h3 class="fs-5 mb-6 ">About us</h3>
                
	<ul class="list-unstyled mb-0 fw-medium ">
		
			<li class="pt-3 mb-4">
				<a href="#" title="About us" class="text-body">About us</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Careers" class="text-body">Careers</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Store Locations" class="text-body">Store Locations</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Our Blog" class="text-body">Our Blog</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Reviews" class="text-body">Reviews</a>
			</li>
		
	</ul>

			</div>
			<div class="col-md col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6 ">Information</h3>
                
	<ul class="list-unstyled mb-0 fw-medium ">
		
			<li class="pt-3 mb-4">
				<a href="#" title="Start a Return" class="text-body">Start a Return</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Contact Us" class="text-body">Contact Us</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Shipping FAQ" class="text-body">Shipping FAQ</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Terms &amp; Conditions" class="text-body">Terms &amp; Conditions</a>
			</li>
		
			<li class="pt-3 mb-4">
				<a href="#" title="Privacy Policy" class="text-body">Privacy Policy</a>
			</li>
		
	</ul>

			</div>
		</div>
		<div class="row align-items-center mt-0 mt-lg-20 pt-lg-4">
	<div class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-center order-2 order-lg-1 fs-6 mt-7 mt-md-11 mt-lg-0">
		<p class="mb-0">© Femi9 2024</p>
		<ul class="list-inline fs-18px ms-6 mb-0">
			<li class="list-inline-item me-8">
				<a href="#"><i class="fab fa-twitter"></i></a>
			</li>
			<li class="list-inline-item me-8">
				<a href="#"><i class="fab fa-facebook-f"></i></a>
			</li>
			<li class="list-inline-item me-8">
				<a href="#"><i class="fab fa-instagram"></i></a>
			</li>
			<li class="list-inline-item">
				<a href="#"><i class="fab fa-youtube"></i></a>
			</li>
		</ul>
	</div>
	<div class="col-sm-12 col-lg-4 text-md-center order-1 order-lg-2 ">
		<a class="d-inline-block" href="./">
			

<img class="lazy-image img-fluid light-mode-img" src="#" data-src="{{ asset('assets/images/others/logo.png') }}" width="106" height="37" alt="Glowing - Bootstrap 5 HTML Templates">
<img class="lazy-image dark-mode-img img-fluid" src="#" data-src="{{ asset('assets/images/others/logo.png') }}" width="106" height="37" alt="Glowing - Bootstrap 5 HTML Templates">
		</a>
    </div>
	<div class="col-sm-12 col-md-6 col-lg-4 order-3 text-sm-start text-lg-end mt-7 mt-md-11 mt-lg-0">
		<img src="#" data-src="{{ asset('assets/images/footer/img_1.png') }}" width="313" height="28" alt="Paypal" class="img-fluid lazy-image">
	</div>
</div>

	</div>
</footer>

 <!-- From Old -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/toastr.min.js?v=1.1') }}" crossorigin="anonymous"></script>
<!-- From Old -->



<script>
$('#cusnewsletterform').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('user.save.subscribe') }}",
        type: 'POST',
        data: $('#cusnewsletterform').serialize(),
        error: function(err) {
            var geterr = err.responseJSON.errors;
            var erromg = '<ul>';
            for (var prop in geterr) {
                erromg += '<li>' + geterr[prop][0] + '</li>'
            }
            erromg += '</ul>';
            toastr.error(erromg);
        },
        success: function(obj) {
            toastr.clear();
            if (obj.success == '1') {
                toastr.success('Success, Our newsletters will reach you on time');
                $('#cusnewsletterform')[0].reset();
            } else {
                toastr.error('Error', 'Please Try Again!');
            }
        }
    });
});

@php
    $rfid = Request::get('referral_id');
@endphp
    
@if($rfid!=''&&$rfid!=null)
    $.ajax({
        url: "{{ route('user.save.setreferalid') }}",
        type: 'POST',
        data: {
            referral_id: '{{ $rfid }}',
            _token: '{{ csrf_token() }}'
        },
        error: function(err) {

        },
        success: function(obj) {

        }
    });
@endif
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2557313646899968"
crossorigin="anonymous"></script>
@extends('User.layouts.app',['date'=>$data])

@section('content')



<section >
	<div class="bg-body-secondary py-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
				<li class="breadcrumb-item"><a class="text-decoration-none text-body" href="{{ url('/') }}">Home</a>
				</li>
				<li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Contact Us</li>
			</ol>
		</nav>
	</div>
	<div class="container">
       <div class="text-center pt-13 mb-13 mb-lg-15">
           <div class="text-center" ><h2 class="fs-36px mb-7">Keep In Touch with Us</h2>
		   <p class="fs-18px mb-0 w-lg-60 w-xl-50 mx-md-13 mx-lg-auto">We’re talking about clean beauty gift sets, of course – and we’ve got a bouquet of beauties for yourself or someone you love.</p></div>
	    </div>
	</div>
</section>
<section class="py-15 py-lg-18">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h2 class="mb-11 fs-3">Send A Message</h2>
                <form class="contact-form" action="https://formsubmit.co/support@femi9.in" method="POST">
                	<div class="row mb-8 mb-md-10">
                		<div class="col-md-6 col-12 mb-8 mb-md-0">
                			<input type="text" name="name" id="form1" placeholder="Enter Your name*" required="" class="form-control input-focus">
                		</div>
                		<div class="col-md-6 col-12">
                			<input type="email" name="email" id="email" placeholder="Enter Email Address*" required="" class="form-control input-focus">
                		</div>
                	</div>
                	<textarea name="message" id="textAreaExample" placeholder="Enter Your Messege here*" required="" class="form-control mb-6 input-focus" rows="7"></textarea>
                		<button type="submit" class=" btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11">Submit</button>
                </form>

			</div>
			<div class="col-lg-5 ps-lg-18 ps-xl-21 mt-13 mt-lg-0">
            <div class="d-flex align-items-start mb-11 me-15">
        	<div class="d-none">
        		<svg class="icon fs-2">
        			<use xlink:href="#"></use>
        		</svg>
        	</div>
    	    <div>
    			<h3 class="fs-5 mb-6">Address</h3>
    			<div class="fs-6">
                    <p class="mb-5 fs-6">222/1, Pavizham Nagar, Thindal,<br> Erode, Tamil Nadu 638012 </p>
    			</div>
    			    <a href="https://maps.app.goo.gl/apgChLZdyEzWbWW76" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6">Get Direction</a>
    		    </div>
            </div>

                <div class="d-flex align-items-start">
                	<div class="d-none">
                		<svg class="icon fs-2">
                			<use xlink:href="#"></use>
                		</svg>
                	</div>
                	<div>
                		<h3 class="fs-5 mb-6">Contact</h3>
                		<div class="fs-6">
                			 <p class="mb-3 fs-6">Mobile:<span class="text-body-emphasis"><a href="tel:9042916499">+91 90429 16499</a></span></p><p class="mb-0 fs-6">E-mail:<span class="text-body-emphasis"><a href="mailto:info@femi9.in">info@femi9.in</a></span></p>
                		</div>
                	</div>
                </div>
			</div>
		</div>
	</div>
</section>



@include('User.parts.home.newsletter');
@endsection

@section('bottomScript')
  <script>
  $('#cuscontactusform').submit(function(e) {
      e.preventDefault();
      $.ajax({
          url: "{{ route('user.save.contactus') }}",
          type: 'POST',
          data: $('#cuscontactusform').serialize(),
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
                  toastr.success('Support Team will Contact You Soon!','Success');
                  $('#cuscontactusform')[0].reset();
              } else {
                  toastr.error('Error', 'Please Try Again!');
              }
          }
      });
  });
  </script>
@endsection

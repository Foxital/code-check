@extends('User.layouts.app',['date'=>$data])

@section('content')

<style>
     .page-title{
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/wff.jpg?updatedAt=1695909716363);
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
        background-image: url(https://ik.imagekit.io/reyo/reyo%20new%20website%20page%20banners/contact-desk.jpg?updatedAt=1691746700054);
   }
}

.cart-table tbody tr{
	border-bottom:1px solid #000 !important;	
}
</style>
<!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
			<h2 style="color:#254e58;">Reyo's WFF</h2>
			<p style="font-size:18px;color:#254e58;">(Women's Financial Freedom)</p>
        </div>
    </section>
    <!-- End Page Title -->
    
    <!-- Contact Page Section -->
    <div class="contact-page-section">
    	<div class="auto-container">
        	
			
			<!-- Contact Boxed -->
			<div>
			 <h1 class="mt-2" style="font-size:28px">Women’s Financial Freedom (WFF)</h1>
			<p style="font-size:18px">The role of Women in our society has changed drastically in the past few years. Women are now occupying the most important positions. The gender stereotypes which were more prevalent in society decades ago are breaking slowly.</p>
			<p style="font-size:18px">Today’s women entrepreneurs do not come from established business families or the higher–income sections of the population, they come from all walks of life and all parts of the country. They create new jobs for themselves and others by being different management solutions. In today's Indian scenario when India is training to be an economic powerhouse the recent financial crisis which has affected countries has had its impact on the minds of women as they have understood the need to earn more.</p>
			<p style="font-size:18px">Reyo’s WFF program (Women’s financial freedom) provides a forum for women entrepreneurs to grow professionally in establishing a business that could sustain market pressures and competition. This support system is also extended towards women entrepreneurs who are planning to upscale their existing businesses. Our Women Entrepreneurs will have separate well-knowledge Mentors who share their legal and financial knowledge about how to successfully run businesses to achieve their dreams. We curated this program mainly for Women’s Financial Freedom.</p>
			<p style="font-size:18px"><b>Reyo’s WFF Plan</b><br> &ensp;1) Angel Distributor<br> &ensp;2) Queen Distributor</p>
			<p style="font-size:18px;color:#000;"><b>Angel Distributor</b></p>
			
			
	       	<div class="auto-container">
			<div class="row clearfix">
				
				<!-- Cart Column -->
				<div class="cart-column col-lg-8 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!--Cart Outer-->
						
								<table class="cart-table table-bordered">
									<thead class="cart-header">
										<tr>
											<th class="prod-column" style="text-align:centre;">Pack</th>
											<th>MRP</th>
											<th>Distributor Price</th>
										</tr>
									</thead>
									
									<tbody>
									
										<tr>
										    <td class="price">Economy Pack(All sizes)</td>
											<td class="price">299</td>
											<td class="price">249</td>
										
										</tr>
										<tr>
										    <td class="price">Monthly Pack(All sizes)</td>
											<td class="price">249</td>
											<td class="price">199</td>
										
										</tr>
										<tr>
										    <td class="price">Genderless Pantyliner</td>
											<td class="price">249</td>
											<td class="price">199</td>
										
										</tr>
										<tr>
										    <td class="price">Hair Color (120ml)</td>
											<td class="price">360</td>
											<td class="price">310</td>
										
										</tr>
										<tr>
										    <td class="price">Hair Color (476ml)</td>
											<td class="price">600</td>
											<td class="price">550</td>
										
										</tr>
										<tr>
										    <td class="price">Sexual Wellness</td>
											<td class="price">249</td>
											<td class="price">199</td>
										
										</tr>
										
									</tbody>
								</table>
							
						
					</div>
				</div>
				
			</div>
		</div>
		
		    <p style="font-size:18px; margin-top:10px;">• We offer training for marketing with proper product knowledge.</p>
	        <p style="font-size:18px">•	We allocate our company staff for every distributor to assist daily and they will help for current marketing tricks. </p>
	        <p style="font-size:18px">•	We are responsible for your growth and to achieve your financial freedom. </p>
	        <p style="font-size:18px">•	Minimum purchase value should be 5,000/- </p>
	        <p style="font-size:18px">•	No time limit and target. </p>
	        
	        <p style="font-size:18px; color:#000;"><b>Queen Distributor</b></p>
 
            <div class="auto-container">
			<div class="row clearfix">
				
				<!-- Cart Column -->
				<div class="cart-column col-lg-8 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!--Cart Outer-->
						
								<table class="cart-table table-bordered">
									<thead class="cart-header">
										<tr>
											<th class="prod-column" style="text-align:centre;">Pack</th>
											<th>MRP</th>
											<th>Distributor Price</th>
										</tr>
									</thead>
									
									<tbody>
									
										<tr>
										    <td class="price">Economy Pack(All sizes)</td>
											<td class="price">299</td>
											<td class="price">209</td>
										
										</tr>
										<tr>
										    <td class="price">Monthly Pack(All sizes)</td>
											<td class="price">249</td>
											<td class="price">159</td>
										
										</tr>
										<tr>
										    <td class="price">Genderless Pantyliner</td>
											<td class="price">249</td>
											<td class="price">159</td>
										
										</tr>
										<tr>
										    <td class="price">Hair Color (120ml)</td>
											<td class="price">360</td>
											<td class="price">270</td>
										
										</tr>
										<tr>
										    <td class="price">Hair Color (476ml)</td>
											<td class="price">600</td>
											<td class="price">510</td>
										
										</tr>
										<tr>
										    <td class="price">Sexual Wellness</td>
											<td class="price">249</td>
											<td class="price">159</td>
										
										</tr>
										
									</tbody>
								</table>
							
						
					</div>
				</div>
				
			</div>
		</div>
		
		    <p style="font-size:18px; margin-top:10px;">• We offer training for marketing with proper product knowledge.</p>
	        <p style="font-size:18px">•	We allocate our company staff for every distributor to assist daily and they will help for current marketing tricks. </p>
	        <p style="font-size:18px">•	We are responsible for your growth and to achieve your financial freedom. </p>
	        <p style="font-size:18px">•	Minimum purchase value should be 20,000/- </p>
	        <p style="font-size:18px">•	No time limit and target. </p>
                                
                            
			</div>
			<!-- End Contact Boxed -->
			
		</div>
	</div>
	<!-- End Contact Page Section -->
  
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

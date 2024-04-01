@extends('User.layouts.app')

@section('content')

<style>
    .sidebar-side{
        z-index: 10;
    }
</style>


<!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
			<h2>Hello {{ Auth::user()->name }}</h2>
			<ul class="bread-crumb clearfix">
				<li>Status of your orders</li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->
    
     <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">
				
				
				
				<!-- Sidebar Side -->
                <div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12 left-sidebar">
                	<aside class="sidebar sticky-top">
						<div class="sidebar-inner">
							<!-- Services Widget -->
							<div class="sidebar-widget-two services-widget">
								<!-- Sidebar Title -->
								<div class="sidebar-title-two">
									<h5>Menu</h5>
								</div>
								<div class="widget-content">
									
									<!-- Category List Two -->
									<ul class="category-list-two">
										<li><a href="{{ route('user.profile') }}"><span class="icon flaticon-user-3"></span> Profile</a></li>
										<!--<li><a href="#"><span class="icon flaticon-heart"></span> Wishlist </a></li>-->
										<li><a href="{{ route('user.profile.orders') }}"><span class="icon flaticon-document"></span> Orders</a></li>
										<li><a href="{{ route('admin.logout') }}"><span class="icon flaticon-settings"></span> Logout </a></li>									
									</ul>
								</div>
							</div>
						</div>
					</aside>
				</div>
				<!-- Sidebar Side -->
				<!-- Cart Column -->
					<div class="cart-column col-lg-8 col-md-12 col-sm-12">
					<div class="inner-column" id="getrowlist">
						
					
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
   
@endsection
@section('bottomScript')
<script>
    var pages = 0;
    function showorders() {
        $.ajax({
            url: "{{ route('user.get.orders') }}",
            data: {
                page: pages
            },
            success: function(res) {
                if (res == ''&&pages==0) {
                    $('#getrowlist').append("<div class='text-center mt-5'><h3>Empty Orders!</h3></div>");
                } else if (res == '') {
                    $('#orderloadmrebtn').remove();
                }else{
                    $('#getrowlist').append(res);
                }
            }
        });
    }
    showorders();
    function loadorders(){
        pages++;
        showorders();
    }
</script>
@endsection

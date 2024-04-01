@extends('User.layouts.app')

@section('content')
  <!-- Page Title -->
    <section class="page-title">
        <div class="auto-container">
            @if (isset($catg['id']))
			<h2>{{ $catg['name'] }}</h2>
			 @elseif (isset($subcatg['id']))
			 <h2>{{ $subcatg['name'] }}</h2>
			 @endif
		</div>
    </section>
    <!-- End Page Title -->

    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">
				
				<!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
					<!-- Filter Box -->
					<div class="filter-box">
						<div class="d-flex justify-content-between align-items-center flex-wrap">
							<!-- Left Box -->
							<div class="left-box d-flex align-items-center">
								<div class="results">Showing results</div>
							</div>
							<!-- Right Box -->
							<div class="right-box d-flex">
								<div class="form-group">
									<select name="sortby" id="sortby" class="custom-select-box">
										 <option value="id_asc" selected="selected">Latest</option>
                                         <option value="featured_asc">Featured</option>
                                         <option value="name_asc">Alphabetically, A-Z</option>
                                         <option value="name_desc">Alphabetically, Z-A</option>
                                         <option value="price_asc">Price, low to high</option>
                                         <option value="price_desc">Price, high to low</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- End Filter Box -->
					
					<div class="shops-outer">
						<div id="shoplistprod" class="row clearfix">
						    
						</div>
					
					</div>
					
				</div>
				<!-- Sidebar Side -->
                <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                	<aside class="sidebar sticky-top">
						
						<!-- Category Widget -->
						<div class="sidebar-widget category-widget">
							<div class="widget-content">
								<!-- Sidebar Title -->
								<div class="sidebar-title">
									<h6>Product Catagories</h6>
								</div>
								<!-- Category List -->
								<ul class="category-list">
									<li><a href="#">Accessories <span>(8)</span></a></li>
									<li><a href="#">Air Filter <span>(5)</span></a></li>
									<li><a href="#">Body Engine <span>(5)</span></a></li>
									<li><a href="#">Brake Parts names <span>(7)</span></a></li>
									<li><a href="#">Computer <span>(1)</span></a></li>
									<li><a href="#">Cosmetics <span>(6)</span></a></li>
									<li><a href="#">Covid-19 <span>(2)</span></a></li>
									<li><a href="#">Electornics <span>(8)</span></a></li>
									<li><a href="#">Frame Sunglasses <span>(10)</span></a></li>
									<li><a href="#">Furniture <span>(7)</span></a></li>
								</ul>
								
							</div>
						</div>
						
						<!-- Colors Widget -->
						<div class="sidebar-widget colors-widget">
							<div class="widget-content">
								<!-- Sidebar Title -->
								<div class="sidebar-title">
									<h6>Colors</h6>
								</div>
								<div class="sel-colors">
									<div class="color-box"><input type="radio" name="colors" checked id="color-one"><label style="background-color:#c4c4c4;" for="color-one"></label></div>
									<div class="color-box"><input type="radio" name="colors" id="color-two"><label style="background-color:#0b5fb5;" for="color-two"></label></div>
									<div class="color-box"><input type="radio" name="colors" id="color-three"><label style="background-color:#00a651;" for="color-three"></label></div>
									<div class="color-box"><input type="radio" name="colors" id="color-four"><label style="background-color:#fee496;" for="color-four"></label></div>
									<div class="color-box"><input type="radio" name="colors" id="color-five"><label style="background-color:#bc25bf;" for="color-five"></label></div>
									<div class="color-box"><input type="radio" name="colors" id="color-six"><label style="background-color:#000000;" for="color-six"></label></div>
								</div>
							</div>
						</div>
						
						<!-- Brands Widget -->
						<div class="sidebar-widget brands-widget">
							<div class="widget-content">
								<!-- Sidebar Title -->
								<div class="sidebar-title">
									<h6>brands</h6>
								</div>
								
								<!-- Brands List -->
								<div class="brands-list">
									<form method="post" action="contact.html">
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-1">
												<label for="type-1">Samsung</label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-2">
												<label for="type-2">Oppo</label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-3">
												<label for="type-3">hewaui Galaxy</label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-4">
												<label for="type-4">Ryzen 3600</label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-5">
												<label for="type-5">intel</label>
											</div>
										</div>
										
										<div class="form-group">
											<div class="check-box">
												<input type="checkbox" name="remember-password" id="type-6">
												<label for="type-6">Mobile Handset</label>
											</div>
										</div>
										
									</form>
								</div>
								
							</div>
						</div>
						
						<!-- Trending Widget -->
						<div class="sidebar-widget trending-widget">
							<div class="widget-content">
								<div class="content">
									<div class="vector-icon" style="background-image: url(images/icons/vector-3.png)"></div>
									<div class="title">Trending</div>
									<h4>2022 <span>Laptop</span> <br> Collection</h4>
									<a class="buy-btn theme-btn" href="#">Buy Now</a>
									<div class="icon">
										<img src="images/resource/lamp-4.png" alt="" />
									</div>
								</div>
							</div>
						</div>
						
						<!-- Tags Widget -->
						<div class="sidebar-widget-two tags-widget">
							<div class="widget-content">
								<!-- Sidebar Title -->
								<div class="sidebar-title">
									<h6>Tags</h6>
								</div>
								<ul class="tag-list">
									<li><a href="#">symphony</a></li>
									<li><a href="#">nokia</a></li>
									<li><a href="#">samsung</a></li>
									<li><a href="#">Alcatel</a></li>
									<li><a href="#">landing</a></li>
									<li><a href="#">Oppos</a></li>
									<li><a href="#">I phone Pro 12</a></li>
									<li><a href="#">poco X3</a></li>
								</ul>
							</div>
						</div>
						
					</aside>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('bottomScript')

    <script type="text/javascript">
        var page = 0;

        function getProd() {
            var getval = []; // convert form to array
            getval.push({name: "pages", value: page});
            getval.push({name: "page_type", value: '2'});
            getval.push({name: "sortby", value: $('#sortby').val()});
            @if (isset($catg['id']))
                getval.push({name: "catg[]", value: "{{ $catg['id'] }}"});
            @elseif (isset($subcatg['id']))
                getval.push({name: "catg[]", value: "{{ $subcatg->Catgs['id'] }}"});
                getval.push({name: "scatg[]", value: "{{ $subcatg['id'] }}"});
            @endif
            console.log(getval);
            $.ajax({
                url: "{{ route('user.prod.show') }}",
                data: $.param(getval),
                success: function(res) {
                    if (res == '') {
                        $('#loadmorebtndiv').hide();
                    } else {
                        $('#shoplistprod').append(res);
                        $('#loadmorebtndiv').show();
                    }
                }
            });
        }
        $(document).ready(function() {
            getProd();
        });

        function loadmore() {
            page++;
            getProd();
        }

        function getfliter(){
            page = 0;
            $('#shoplistprod').empty();
            $('#loadmorebtndiv').show();
            getProd();
        }
    </script>

@endsection

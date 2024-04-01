@extends('User.layouts.app')

@section('content')
    
    @php
    $catgs = \App\Models\Category::select('id', 'name', 'link_code', 'image')
        ->where('status', '1')
        ->orderBy('lineup')
        ->get();
    @endphp
    
		<section class="page-title z-index-2 position-relative">
    
    <div class="bg-body-secondary">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Femi9 Shop</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="text-center py-13">
        <div class="container">
            <h2 class="mb-0">Our Collections</h2></div>
    </div>
</section>
<section class="container container-xxl">
    <div class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex">
        <div class="tool-bar-left mb-6 mb-lg-0 fs-18px"></div>
        <div class="tool-bar-right align-items-center d-lg-flex">
            <ul class="list-unstyled d-flex align-items-center list-inline me-lg-7 me-0 mb-6 mb-lg-0">
                
                
                <!--<li class="list-inline-item d-lg-none ms-auto">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" class="btn btn-hover-border-primary btn-hover-bg-primary btn-hover-text-light btn-dark"><svg class="icon icon-SlidersHorizontal fs-4 me-4">
                            <use xlink:href="#icon-SlidersHorizontal"></use>
                        </svg> Filter</a>
                </li>-->
            </ul>
            <ul class="list-unstyled d-flex align-items-center list-inline mb-0">
                <li class="list-inline-item me-0 w-100 w-lg-auto">
                                    <select class="form-select w-100 w-lg-auto" name="sortby" id="sortby">
										 <option value="id_asc" selected="selected">Latest</option>
                                         <option value="featured_asc">Featured</option>
                                         <option value="name_asc">Alphabetically, A-Z</option>
                                         <option value="name_desc">Alphabetically, Z-A</option>
                                         <option value="price_asc">Price, low to high</option>
                                         <option value="price_desc">Price, high to low</option>
									</select>
                </li>
                <!--<li class="list-inline-item d-none d-lg-block ms-7">
                    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" class="btn btn-hover-border-primary btn-hover-bg-primary btn-hover-text-light btn-dark"><svg class="icon icon-SlidersHorizontal fs-4 me-4">
                            <use xlink:href="#icon-SlidersHorizontal"></use>
                        </svg> Filter</a>
                </li>-->
            </ul>
        </div>
    </div>
</section>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fs-3" id="offcanvasExampleLabel">Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <aside class="primary-sidebar ">
	<div class="widget widget-product-category">
     <h4 class="widget-title fs-5 mb-6">Category</h4>
        <ul class="navbar-nav navbar-nav-cate">
            @foreach ($catgs as $catg)
            <div class="nav-item">
                    <input onclick="getfliter()" name="catg[]" value="{{ $catg['id'] }}" id="catg_{{ $catg['id'] }}" type="checkbox" class="form-check-input rounded-0 me-3">
                    <span class="text-hover-underline">{{ $catg['name'] }}</span>
            </div>
            @endforeach
        </ul>
    </div>
</aside>
    </div>
</div>

<div class="container container-xxl pb-16 pb-lg-18 mb-lg-3">
    <div id="shoplistprod" class="row gy-50px">
        
        
    </div>
</div>
 
 
@endsection


@section('bottomScript')

    <script type="text/javascript">
        var page = 0;

        function getProd() {
            var getval = $('#formfliter').serializeArray(); // convert form to array
            getval.push({name: "pages", value: page});
            getval.push({name: "page_type", value: '1'});
            getval.push({name: "sortby", value: $('#sortby').val()});

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

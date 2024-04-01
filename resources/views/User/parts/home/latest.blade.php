@php
    $prods = \App\Models\Product::select('products.id','name','link_code','image','image1','label','price','discount','product_varient.id as pvid')
    ->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
    ->where('products.status','1')
    ->where('products.category_id','2')
    ->where('product_varient.status','1')
    ->orderBy('products.id', 'asc')
    ->get();
@endphp
<!-- New Launches Start -->
<section class="py-md-5 py-3 panel-bg-2">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                {{-- <small class="text-primary mb-2">THE Products</small> --}}
                <h1 class="mb-2 kaint">REYO - New Launches</h1>
            </div>
        </div>
        <div class="row mt-4 gx-3 d-flex align-items-center justify-content-center">
            <div class="col-md-12">
                <div id="newseller" class="slider slickcard4">
                    @foreach ($prods as $prod)
                    <div class="p-2">
                        @include('User.parts.prod',['prod' => $prod])
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- New Launches End -->

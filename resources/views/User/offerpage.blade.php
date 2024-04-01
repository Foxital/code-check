@extends('User.layouts.app')

@php
$prods = \App\Models\Product::select('products.id','name','link_code','image','image1','label','price','discount','product_varient.id as pvid')
->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
->where('products.status','1')
->where('featured','2')
->where('product_varient.status','1')
->orderBy('id')
->limit(3)
->get();
@endphp

@section('content')
    <section class="pt-3 pb-5 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-12 trending">
                    <div class="row">
                        <div class="col-12 border-radius-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Festival Offers</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="shoplistprod" class="row mt-3 gx-4 d-flex align-items-start justify-content-start">
                      @foreach ($prods as $prod)
                      <div class="col-md-3">
                          @include('User.parts.prod',['prod' => $prod])
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

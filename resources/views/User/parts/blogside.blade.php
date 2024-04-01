@php
$recent_posts = \App\Models\Blog::latest()
    ->where('status', '1')
    ->limit(10)
    ->get();
$prods = \App\Models\Product::select('products.id','name','link_code','image','image1','label','price','discount','product_varient.id as pvid')
->leftJoin('product_varient', 'product_varient.product_id', '=', 'products.id')
->where('products.status','1')
->where('featured','2')
->where('product_varient.status','1')
->orderBy('id')
->limit(3)
->get();

@endphp
<div class="row">
  <div class="col-md-12">
      <div id="bestseller" class="Prodview">
          @foreach ($prods as $prod)
          <div class="p-2">
              @include('User.parts.prod',['prod' => $prod])
          </div>
          @endforeach
      </div>
  </div>
    <div class="col-md-12 footer">
        <div class="row pt-3 pb-0 px-2">
            <div class="col-12">
                <h2 style="font-size:18px;margin:0;line-height: 5px;">Recent Posts</h2>
                <span style="border:1px solid #62c48c;display:inline-block;width:25%;"></span>
            </div>
        </div>
        <div class="text-start">
            <ul>
              @foreach ($recent_posts as $post)
                <li><a href="{{ env('APP_URL').'blog/'.$post['link_code'] }}" ><i class="fas fa-angle-right"></i> {{ $post['name'] }}</a></li>
              @endforeach
            </ul>
        </div>
    </div>
</div>

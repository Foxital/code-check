@extends('User.layouts.app')

@section('content')

<section class="page-title z-index-2 position-relative">
    <div class="bg-body-secondary">
        <div class="container">
            <nav class="py-4 lh-30px" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center py-1">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog Updates</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="text-center py-13">
        <div class="container">
            <h2 class="mb-0">Blog Updates</h2></div>
    </div>
</section>

<div class="container mb-lg-18 mb-15 pb-3">
    <div class="row gy-50px">
        @foreach ($blogs as $blog)
        <div class="col-md-6 col-lg-4">
                <article class="card card-post-grid-2 bg-transparent border-0" data-animate="fadeInUp">
                    <figure class="card-img-top mb-7 position-relative">
                        <a href="{{'/blog/'.$blog['link_code'] }}" class="hover-shine hover-zoom-in d-block" title="{{ $blog['name'] }}">
                            <img data-src="{{ $blog['image'] != '' && $blog['image'] != null ? asset('uploads/Blog/' . $blog['image']) : asset('uploads/dummy.jpg') }}" class="img-fluid lazy-image w-100" alt="{{ $blog['name'] }}" width="330" height="440" src="#">
                        </a>
                    </figure>
                    <div class="card-body p-0">
                        <ul class="post-meta list-inline lh-1 d-flex flex-wrap fs-13px text-uppercase ls-1 fw-semibold m-0">
                            <li class="list-inline-item border-end pe-5 me-5"><a
                                        class="text-reset text-decoration-none text-primary-hover" href="#"
                                        title="Life style">{{ $blogcatgs[$blog['category_id']-1]->name }}</a></li>
                            <li class="list-inline-item">{{ $blog['created_at'] }}</li>
                        </ul>
                        <h4 class="card-title fs-5 lh-base mt-5 pt-2 mb-0">
                            <a class="text-decoration-none" href="{{'/blog/'.$blog['link_code'] }}" title="{{ $blog['name'] }}">{{ $blog['name'] }}</a>
                        </h4>
                    </div>
                </article>
            </div>
        @endforeach    
    </div>
</div>


@endsection

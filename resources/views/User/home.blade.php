@extends('User.layouts.app',['date'=>$data])

    @section('content')
    
    <style>
        .gallery-section{
            display: inline-flex;
        }
    </style>

    @include('User.parts.home.slider')

   @include('User.parts.home.video')
   
   @include('User.parts.home.bestseller') 
   
   @include('User.parts.home.fcatg') 
     
   @include('User.parts.home.sreview')
   
   @include('User.parts.home.review') 

   @include('User.parts.home.blog')
   
  @include('User.parts.home.insta') 

<!--

    <section class="py-3 newslatter-inner pbackcolor">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="main-title text-center mb-4">
                    <h2 class="text-center">Find Us On Instagram</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="card bg-white text-white">
                        <a href="https://www.instagram.com/reyoofficial/" target="_blank">
                            <img src="{{ asset('assets/img/instg/1.jpg') }}" class="card-img" alt="..." />
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-white text-white">
                        <a href="https://www.instagram.com/reyoofficial/" target="_blank">
                        <img src="{{ asset('assets/img/instg/2.jpg') }}" class="card-img" />
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-white text-white">
                        <a href="https://www.instagram.com/reyoofficial/" target="_blank">
                        <img src="{{ asset('assets/img/instg/3.jpg') }}" class="card-img" />
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-white text-white">
                        <a href="https://www.instagram.com/reyoofficial/" target="_blank">
                        <img src="{{ asset('assets/img/instg/4.jpg') }}" class="card-img" />
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-white text-white">
                        <a href="https://www.instagram.com/reyoofficial/" target="_blank">
                        <img src="{{ asset('assets/img/instg/5.jpg') }}" class="card-img" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
    @endsection

    @section('bottomScript')
    <!-- Custom scripts -->
    <script type="text/javascript">
        $(".slickcard4").slick({
            dots: false,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: false,
            arrows: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false,
                    }
                }
            ]
        });
        $(".slickcard3").slick({
            dots: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: false,
            arrows: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false,
                    }
                }
            ]
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2557313646899968"
     crossorigin="anonymous"></script>
    @endsection

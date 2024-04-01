@extends('User.layouts.app',['date'=>$data])

@section('content')

<section class="pt-5">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-7">
                <h1 class="mt-2">VISION</h1>
                <p style="font-size: 18px;">Our Vision is to be a Monopoly of Personal Care, Beauty Care, and Home Care Products in the Foremost Quality and Want to be as Trustworthy for the Customers.</p>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-4" style="height: 270px;background-size: cover;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/mnw.png') }}')">
<!--                <img class="img-fluid" src="{{ asset('assets/img/mnw.png') }}" />-->
            </div>
        </div>
    </div>
</section>

<section class="pt-5" >
    <div class="container py-3">
        <div class="row flex-column-reverse flex-sm-row">
            <div class="col-md-4" style="height: 280px;background-size: cover;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/vnw.png') }}')">
<!--                <img class="img-fluid" src="{{ asset('assets/img/vnw.png') }}" />-->
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-7 text-right">
                <h1 class="mt-2">MISSION</h1>
                <p style="font-size: 18px;">Our Mission is to Provide New Superior Quality Products which Satisfy the Needs of Customers at an Affordable Price. To be Trustworthy and Innovative Globally.</p>
            </div>
            
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h1>8 DIMENSIONS OF WELLNESS</h1>
                <p>Besides the physiological concepts, some dimensions of women need to be addressed.</p>
            </div>
            
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Mental.png') }}" />
                        <h5 class="m-0">Mental</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Emotional.png') }}" />
                        <h5 class="m-0">Emotional</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Social.png') }}" />
                        <h5 class="m-0">Social</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Environmental.png') }}" />
                        <h5 class="m-0">Environmental</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Intellectual.png') }}" />
                        <h5 class="m-0">Intellectual</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Occupational.png') }}" />
                        <h5 class="m-0">Occupational</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Physical.png') }}" />
                        <h5 class="m-0">Physical</h5>
                    </div>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="{{ asset('assets/img/dimnew/Spiritual.png') }}" />
                        <h5 class="m-0">Spiritual</h5>
                    </div>
                </div>
            </div>
<!--

                <p>We are conducting various Awareness Programs in Schools &amp; Colleges starting from our hometown Erode, Tamilnadu. It’s been a heartiest welcome from everybody and we have started to engage the same with all cities one by one.</p>
-->
            </div>
    </div>
</section>

@endsection

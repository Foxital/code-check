@extends('User.layouts.app',['date'=>$data])

@section('content')

<section class="py-5" >
    <div class="container py-1">
        <div class="row">
            <div class="col-md-7">
                <h1 class="mt-2">HISTORY</h1>
                <p style="font-size:18px">We travelled to several countries in search of “Superior Quality Products” in the era of Personal Care, Beauty Care and Home Care Segment and our main focus were on “Sanitary Napkins” in 2010. As we are aware that there was very Low Penetration (Less than 20%) in India at that time about the usage of Menstrual Hygienic Products and even now it continues. We brought a few and tested with our family members and got impressed with the feedback from them saying – “It was the best product they had ever used”.</p>
                <p style="font-size:18px">Since that very moment, our research started and wants to be a pioneer in that. We took almost 6 years trying various different research methodologies and introduced our Brand “REYO” in 2017 with 5-in-1 Technologies (Anion, FAR – IR, Magnetic, Nano-Silver &amp; Chitin) first time in India. Our main objective is to create health awareness about the usage of Hygienic Sanitary Napkins and their benefits.</p>
            </div>
            <div class="col-md-5" style="background-size: cover;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hnw.png') }}')">
<!--                <img src="{{ asset('assets/img/hnw.png') }}" class="img-fluid" />-->
            </div>
        </div>
    </div>
</section>


@endsection

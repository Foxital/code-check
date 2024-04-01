@extends('User.layouts.app',['date'=>$data])

@section('content')

<section class="py-5">
    <div class="container py-1">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('assets/img/why/1.jpg') }}" class="img-fluid" />
                <img src="{{ asset('assets/img/why/2.jpg') }}" class="img-fluid" />
                <img src="{{ asset('assets/img/why/3.jpg') }}" class="img-fluid" />
                <img src="{{ asset('assets/img/why/4.jpg') }}" class="img-fluid" />
            </div>
        </div>
    </div>
</section>


@endsection

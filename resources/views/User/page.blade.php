@extends('User.layouts.app')

@section('content')
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 textdescript">
                            <h1>{{ $data['name'] }}</h1>
                            <div class="context">
                              {!! $data['description'] !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        @include('User.parts.faqlist')
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('User.layouts.app')

@section('content')
    @php
    $blogs = \App\Models\Blog::latest()
        ->where('status', '1')
        ->get();
    @endphp
{{--
    <section class="py-3 bg-grey">
        <div class="container mt-1">
            <div class="row">
                <div class="col-md-6">
                    @if (isset($mainpost['id']))
                      <a href="{{ env('APP_URL').'blog/'.$mainpost['link_code'] }}" >
                        <div class="card mt-0 bg-dark text-white">
                            <img src="{{ $mainpost['image'] != '' && $mainpost['image'] != null ? asset('uploads/Blog/' . $mainpost['image']) : asset('uploads/dummy.jpg') }}"
                                class="card-img" alt="..." />
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $mainpost['name'] }}</h5>
                                {{-- <p class="card-text">By Dr. Vaishali Joshi</p> --}}
                                <p class="card-text"><small
                                        class="text-muted">{{ date_format(date_create($mainpost['updated_at']), 'd M, Y') }}</small>
                                </p>
                            </div>
                        </div>
                      </a>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        @foreach ($blogs as $k=>$blog)
                          @if($k<=4)
                            <div class="col-md-6 mb-3">
                                <a href="{{ env('APP_URL').'blog/'.$blog['link_code'] }}" >
                                <div class="card mt-0 bg-dark text-white">
                                    <img src="{{ $blog['image'] != '' && $blog['image'] != null ? asset('uploads/Blog/' . $blog['image']) : asset('uploads/dummy.jpg') }}"
                                        class="card-img" alt="..." />
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">{{ $blog['name'] }}</h5>
                                        {{-- <p class="card-text">By Dr. Vaishali Joshi</p> --}}
                                        <p class="card-text"><small
                                                class="text-muted">{{ date_format(date_create($blog['updated_at']), 'd M, Y') }}</small>
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                          @php
                            unset($blogs[$k]);
                          @endphp
                          @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
--}}
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row py-3 px-2">
                        <div class="col-12">
                            <h2 style="font-size:18px;margin:0;line-height: 5px;">Recent Posts</h2>
                            <span style="border:1px solid #62c48c;display:inline-block;width:25%;"></span>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <a href="{{ env('APP_URL').'blog/'.$blog['link_code'] }}" >
                        <div class="col-12 my-2 py-1 border-bottom">
                            <div class="row ">
                                <div class="col-md-9">
                                    <div class="card-body p-2">
                                        <h5 class="card-title">{{ $blog['name'] }}</h5>
                                        <p class="card-text m-0">{{ $blog['meta_descp'] }}</p>
                                        <p class="card-text"><small class="text-muted">{{ date_format(date_create($blog['updated_at']), 'd M, Y') }}</small></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img style="border-radius:8px;"
                                    src="{{ $blog['image'] != '' && $blog['image'] != null ? asset('uploads/Blog/' . $blog['image']) : asset('uploads/dummy.jpg') }}" alt="..."
                                        class="img-fluid" />
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                  @include('User.parts.blogside')
                </div>
            </div>
        </div>
    </section>
@endsection

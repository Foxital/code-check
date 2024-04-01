@extends('Admin.layouts.app')

@section('content')
    <style>
        body {
            background: aliceblue;
        }

    </style>
    <div class="container">
        <div class="row algin-item-center justify-content-center">
            <div class="col-md-4 pt-5 mt-5">
                <div class="text-center my-3">
                    <img src={{ asset('admin-assets/logo/hlogo-min.png') }} width="180px" class="margin-auto" />
                </div>
                <div>
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('admin.usercheck') }}" autocomplete="off">
                    @csrf
                    <div class="card mt-1">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body pt-2">


                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">

                            </div>

                        </div>
                        <div class="card-footer border-top bg-white">
                            <div class="row">
                                <div class="col-md-8">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-block btn-success">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

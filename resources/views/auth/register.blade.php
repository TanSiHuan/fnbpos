@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4">Sign up your account</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
{{--        restaurant info--}}
        <h4 class="text-left mb-4">Restaurant Info</h4>
        <div class="form-group">
            <label for="res-name"><strong>Restaurant Name</strong></label>
            <input id="res-name" type="text" required class="form-control @error('res_name') is-invalid @enderror" required  placeholder="ABC Cafe" value="{{ old('res_name') }}" name="res_name">
            @error('res_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="res-contact"><strong>Restaurant Contact Number</strong></label>
            <input id="res-contact" type="text" required class="form-control @error('res_contact') is-invalid @enderror" maxlength="11" placeholder="0752361516" name="res_contact" value="{{ old('res_contact') }}">
            @error('res_contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="res-address"><strong>Restaurant Address</strong></label>
            <input id="res-address" type="text" required class="form-control @error('res_address') is-invalid @enderror" required value="{{ old('res_address') }}" name="res_address">
            @error('res_address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="res-email"><strong>Restaurant Email</strong></label>
            <input id="res-email" type="email" required class="form-control @error('res_email') is-invalid @enderror" required  placeholder="hello@example.com" value="{{ old('res_email') }}" name="res_email">
            @error('res_email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <br>
{{--        end restaurant info--}}
{{--        user info--}}
        <hr>
        <br>
        <h4 class="text-left mb-4">User Info</h4>
        <div class="form-group">
            <label for="admin_name"><strong>Name</strong></label>
            <input id="admin_name" type="text" class="form-control required @error('admin_name') is-invalid @enderror" value="{{old('admin_name')}}" placeholder="username" name="admin_name">
            @error('admin_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email"><strong>Email</strong></label>
            <input id="email" type="email" class="form-control required @error('email') is-invalid @enderror"  value="{{old('email')}}" placeholder="hello@example.com" name="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label><strong>Contact Number</strong></label>
            <input type="tel" class="form-control required @error('admin_contact') is-invalid @enderror" value="{{old('admin_contact')}}" maxlength="11" placeholder="0123456789" name="admin_contact">
            @error('admin_contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password"><strong>Password</strong></label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm"><strong>Confirm Password</strong></label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
        </div>
    </form>
    <div class="new-account mt-3">
        <p>Already have an account? <a class="text-primary" href="{{route('login')}}">Sign in</a></p>
    </div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection

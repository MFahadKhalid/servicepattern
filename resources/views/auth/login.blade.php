@extends('layouts.auth-scaffold')
@push('titles')
    Login
@endpush
@section('content')
<div class="bg-light min-vh-100 d-flex flex-row align-items-center dark:bg-transparent">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Sign In to your account</p>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3"><span class="input-group-text">
                        <i class="fa fa-user"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <i class="fa fa-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                      <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Login</button>
                      </div>
                      <div class="col-6 text-end">
                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <div class="card col-md-5 text-white bg-primary py-5">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mt-3">Register Now!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

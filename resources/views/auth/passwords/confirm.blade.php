@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<main class="main">
    <div class="container">
        <section class="wrapper">
      


            <div class="heading">
                <h3 class="text  ml-3 ">Confirm passwordt</h3>
                </p>
            </div>




            <form method="POST" action="{{ route('password.confirm') }}" class="form">
                @csrf
                <div class="input-control">


                    <input id="password" type="password" class="input-field password  @error('password') is-invalid @enderror"
                        name="password"  required autocomplete="current-password" autofocus
                        placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback ml-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="input-control spacer-between">

                    @if (Route::has('password.request'))
                    <a class="text text-links forget-password" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                   @endif

                    <input type="submit" name="submit" class="input-submit" value="Confirm password">
                </div>
            </form>
        </section>
    </div>
</main>

@endsection

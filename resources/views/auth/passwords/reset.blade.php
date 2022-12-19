@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <section class="wrapper">
                <div class="heading">
                    <h3 class="text  ml-3 ">Reset password</h3>
                    </p>
                </div>
                <form method="POST" action="{{ route('password.update') }}" class="form">
                    @csrf
                    <div class="input-control">
                        <input type = "hidden" name = "token" value = "{{ $token }}">


                        <input id="email" type="email" class="input-field  @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email Address">
                        @error('email')
                            <span class="invalid-feedback ml-3" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="input-control">


                        <input id="password" type="password"
                            class="input-field password @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Password">
                        <i class="fa fa-eye password-icon" onclick="changePassword('password')"></i>

                        @error('password')
                            <span class="invalid-feedback ml-3" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-control">


                        <input id="password-confirmation" type="password" class="input-field password-confirmation"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Password confirmation">
                        <i class="fa fa-eye password-icon" onclick="changePassword('password-confirmation')"></i>
                    </div>

                    <div class="input-control">
                        <input type="submit" name="submit" class="input-submit" value="Reset password">
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection

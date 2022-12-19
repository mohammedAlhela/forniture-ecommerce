@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <section class="wrapper">
                <div class="heading">
                    <h3 class="text  ml-3 ">Sign In</h3>
                    </p>
                </div>
                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf
                    <div class="input-control">


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
                        <a href="{{ route('password.request') }}" class="text text-links forget-password">Forgot
                            Password</a>
                        <input type="submit" name="submit" class="input-submit" value="Sign In">
                    </div>
                </form>
                {{-- <div class="striped">
				<span class="striped-line"></span>
				<span class="striped-text">Or</span>
				<span class="striped-line"></span>
			</div> --}}
                {{-- <div class="method">
				<div class="method-control">
					<a href="{{ url('login/google') }}" class="method-action">
                        <i class="fa fa-google-plus mr-2"></i>
						<span> Sign in with Google</span>
					</a>
				</div>
				<div class="method-control">
					<a href="#" class="method-action">
						<i class="fa fa-facebook mr-2"></i>
						<span>Sign in with Facebook</span>
					</a>
				</div>
			</div> --}}
            </section>
        </div>
    </main>
@endsection

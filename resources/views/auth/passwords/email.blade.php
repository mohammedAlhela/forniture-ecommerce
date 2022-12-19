@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <section class="wrapper">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="heading">
                    <h3 class="text  ml-3 ">Password reset</h3>
                    </p>
                </div>




                <form method="POST" action="{{ route('password.email') }}" class="form">
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
                        <input type="submit" name="submit" class="input-submit" value="Send reset password link">
                    </div>
                </form>
            </section>
        </div>
    </main>
@endsection

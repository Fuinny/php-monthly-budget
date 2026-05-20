@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <h2>{{__('Prisijungimas')}}</h2>
                    <h5 class="text-muted">{{__('Prisijunkite prie savo paskyros')}}</h5>
                </div>
                <div class="card border-0 p-4 shadow-sm bg-white">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email"
                                       class="form-label fw-bold small text-uppercase text-muted">
                                    {{ __('El. pašto adresas') }}
                                </label>
                                <input id="email"
                                       type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autocomplete="email"
                                       autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password"
                                       class="form-label fw-bold small text-uppercase text-muted">
                                    {{ __('Slaptažodis') }}
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit"
                                        class="btn btn-dark w-100 py-2 text-uppercase font-weight-bold small">
                                    {{ __('Prisijungti') }}
                                </button>
                            </div>
                        </form>
                        @if (Route::has('register'))
                             <div class="text-center mt-3">
                                 <span class="text-muted small">{{ __('Neturite paskyros?') }}</span>
                                    <a href="{{ route('register') }}"
                                       class="small font-weight-bold text-dark text-decoration-none">
                                         {{ __('Užsiregistruokite') }}
                                     </a>
                             </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<html>
    <head>
    <script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://unpkg.com/react/umd/react.production.min.js" crossorigin></script>

<script
    src="https://unpkg.com/react-dom/umd/react-dom.production.min.js"
    crossorigin></script>

<script
    src="https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js"
    crossorigin></script>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
/>
</head>
<body>
<div class="container">

<div class="container-fluid h-100" method="POST" action="{{ route('register') }}">
    @csrf
			<div class="row bg-primary full_height">
				<div class="col bg-white rounded-end justify-content-center d-flex align-items-center">
					<div class="my-5 w-75">
						<div class="mx-5 px-5">
							<h3 class="display-5 fw-bold">Sign Up to get started</h3>
							<div class="mt-2">
								<p>Enter your details to proceed further</p>
							</div>
              <div class="mt-3">
                <div>
                  <label for="fullName" class="form-label fw-semibold">Company Name</label>
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      id="companyName"
                      class="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="eg. John Smith Industries"
                      aria-label="Enter Company Name"
                    />
                    <span class="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i class="bi-building"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="fullName" class="form-label fw-semibold">Role</label>
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      id="fullName"
                      class="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="eg. Managing Director"
                      aria-label="Enter role"
                    />
                    <span class="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i class="bi-file-earmark-person"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="loginEmail" class="form-label fw-semibold">Email address</label>
                  <div class="input-group mb-3">
                    <input
                      type="email"
                      id="loginEmail"
                      class="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="someone@example.com"
                      aria-label="Enter email"
                    />
                    <span class="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                    <i class="bi-person"></i>
                    </span>
                  </div>
                </div>
                <div>
                  <label for="loginPassword" class="form-label fw-semibold">Password</label>
                  <div class="input-group mb-3">
                    <input
                      id="loginPassword"
                      type="password"
                      class="form-control rounded-0 border-top-0 border-start-0 border-end-0"
                      placeholder="***********"
                      aria-label="Enter password"
                    />
                    <span class="input-group-text rounded-0 bg-white border border-top-0 border-end-0 border-start-0" id="basic-addon2">
                      <i class="bi-lock"></i>
                    </span>
                  </div>
                </div>
                <div class="form-check my-4">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                  <label class="form-check-label" for="flexCheckDefault">
                    I Agree to the terms and conditions
                  </label>
                </div>
                <div class="d-flex justify-content-between">
                  <Link to="/business/dashboard">
                    <button type="button" class="btn btn-primary btn-lg px-4" method="POST" action="{{ route('register') }}">Sign Up</button>
                  </Link>
                  <Link to="/login">
                    <button type="button" class="btn btn-link">Sign In</button>
                  </Link>
                </div>
                <div class="text-center mt-3">
                  <Link to="/">
                    <button type="button" class="btn btn-link">Back to Homepage</button>
                  </Link>
                </div>
              </div>
						</div>
					</div>
				</div>
				<div class="col">
          <div class="h-100 d-flex justify-content-center align-items-center">
            <img src="{{url('/assets/images/login_bg.png')}}" height="500" />
          </div>
        </div>
			</div>
		</div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</div>
</body>
</html>
@endsection

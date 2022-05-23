<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trust</title>

        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
         <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

          <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <style>
            /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            } */

            /* .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            } */

            /* .position-ref {
                position: relative;
            } */

             .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            /* .content {
                text-align: center;
            }  */
/* 
            .title {
                font-size: 84px;
            } */

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .hero_img {
  position: relative;
  animation: moveUpAndDown 2.5s ease alternate infinite;
}

@keyframes moveUpAndDown {
  from {
    left: 0px;
    top: 0px;
  }
  to {
    left: 0px;
    top: 30px;
  }
}

body {
  margin: 0;
  font-family: 'Open Sans', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.full_height {
  height: 100vh;
}

            /* .m-b-md {
                margin-bottom: 30px;
            } */
        </style> 
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id="homenavbar">
                <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{url('/assets/images/hero.png')}}" class="d-block mx-lg-auto img-fluid hero_img" alt="trust logo" width="800" height="800" loading="lazy" />
          </div>
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">Welcome to Trust!</h1>
            <p class="fs-5">Real-time Investing and Payment for Businesses and Employees</p>
            <p class="fs-5">Sign up and join the new world of finance</p>
            <div class="d-grid gap-4 d-md-flex justify-content-md-start mt-5">
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Business</button>
            </a>
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-primary btn-lg px-4">Personal</button>
            </a>
            </div>
          </div>
        </div>
      </div>
                </div>
            </div>
        </div>      
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html> 
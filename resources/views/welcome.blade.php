<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- @if(\Session::has('download.in.the.next.request'))
             <!--<meta http-equiv="refresh" content="5;url=http://informatica.ieszaidinvergeles.org:9040/CongrePHP/public/asistant">-->
         @endif --}}
        <title>Online Congress</title>
        <link rel="icon" href="{{ url('assets/css/') }}/favicon.ico" type="image/x-icon" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Bootstrap -->
        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet"> 
        <link href="{{ url('assets/css/jumbotron.css') }}" rel="stylesheet">
        <link href="{{ url('assets/css/own.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!-- Styles -->
        <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
        
        <!-- Compiled and minified CSS -->
        <!--<link-->
        <!--  rel="stylesheet"-->
        <!--  href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"-->
        <!--/>-->
    
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
        <link
          rel="stylesheet"
          type="text/css"
          href="{{ url('assets/css/slick-master/slick/slick.css') }}"
        />
        <link
          rel="stylesheet"
          type="text/css"
          href="{{ url('assets/css/slick-master/slick/slick-theme.css') }}"
        />
    </head>
     <nav>
        @if (Route::has('login'))
            <div class="top-left links">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                        style="background-color: transparent; letter-spacing: 0.1vh">
                            {{ __('LOGOUT') }}
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                    <a href="{{url('presentation')}}"> View Presentations </a>
                @endauth
            </div>
        @endif
        @auth
            <a class="menu__btn" style="margin:0 !important;padding:0 !important;" href=""><i class="fa fa-cog" style="font-size:2.5rem" aria-hidden="true"></i> </a>
        @endauth
    </nav>
    
    <div class="menu" style="list-style:none; margin:0 !important;padding:0 !important;">
       <div class="menu__container" style="list-style:none; margin:0 !important;padding:0 !important;">
         <li class="nav-item" style="list-style:none; margin:0 !important;padding:0 !important;">
                <ul class="dropdown">
                    <li class="dropdown-item">
                         <a class="color" href="{{ url('profile') }}">Profile</a>
                    </li>
                    @auth
                        @if(Auth::user()->type == 'Admin')
                            <li class="dropdown-item">
                                 <a class="color" href="{{ url('dashboard') }}">Dashboard</a>
                            </li>
                        @elseif(Auth::user()->type == 'Speaker')
                            <li class="dropdown-item">
                                 <a class="color" href="{{ url('speaker') }}">Add presentation</a>
                            </li>
                            <li class="dropdown-item">
                                 <a class="color" href="{{ url('presentation') }}">View presentations</a>
                            </li>
                        @elseif(Auth::user()->type == 'Asistant')
                            <li class="dropdown-item">
                                 <a class="color" href="{{ url('asistant') }}">View presentations</a>
                            </li>
                        @endif
                    @endauth
                    <li class="dropdown-item">
                         <a class="color" href="{{ url('/') }}">Back</a>
                    </li>
                </ul>
            </li>
       </div>
    </div>
     
    <body>
        <div class="flex-center position-ref full-height ">
            
            @isset($alertMessage)
                @include('include.alert')
            @endisset
            @if (session('status'))
                <div class="alert alert-success alert2" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            @if(!\Request::is('speakers'))
                <div class="title m-b-md">
                    ONLINE <i class="fas fa-play"></i> CONGRESS
                </div>
            @endif
            
            <!--<div class="title m-b-md">-->
            <!--    <small style="font-size:15px"> <i class="fas fa-play"></i>  Wellcome!, click here if you want presentation availables! <a href="{{url('presentation')}}"> View future! </a> </small>-->
            <!--</div>-->
            
            @yield('content')
            
        </div>
    </body>
    
    <script
      src="https://kit.fontawesome.com/345d6c30a6.js"
      crossorigin="anonymous"
    ></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ url('assets/js/jquery-3.3.1.slim.min.js') }}"><\/script>')</script>
    <!-- PROBLEMA -->
    <script src="{{ url('assets/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script
      src="https://code.jquery.com/jquery-2.2.0.min.js"
      type="text/javascript"
    ></script>
    <script
      src="{{ url('assets/css/slick-master/slick/slick.min.js') }}"
      type="text/javascript"
      charset="utf-8"
    ></script>
    <script type="text/javascript">
        $(document).on("ready", function () {
            $(".variable").slick({
                dots: true,
                infinite: true,
                variableWidth: true,
            });
        });
    </script>
</html>


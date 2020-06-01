<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" type="text/css" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @isset($alertMessage)
                @include('include.alert')
            @endisset
            <div class="title m-b-md">
                USERS
            </div>
            
            @yield('content')
            
        </div>
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ url('assets/js/app.js') }}"></script>
    </body>
</html>
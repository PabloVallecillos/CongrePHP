@extends('welcome')

@section('content')

    <div class="jjflex">
        
        <a class="jjflex1" href="{{ url('users') }}">
            <h1><i class="fas fa-user">&nbsp;</i> Users</h1>
        </a>
        <a class="jjflex2" href="{{ url('speakers') }}">
            <h1><i class="fas fa-play" aria-hidden="true">&nbsp;</i> Presentations</h1>
        </a>
        <a class="jjflex3" href="{{ url('pays') }}">
            <h1><i class="fas fa-money-check-alt">&nbsp;</i> Pays</h1>
        </a>
        
    </div>

@endsection
@extends('welcome')

@section('content')
      
    <section class="variable slider">
     @foreach($presentations as $key => $presentation)
          <div>
            <div class="row">
              <div class="col s12 m7">
                <div class="card" style="width: 350px;">
                  <div class="card-image">
                    <img class="imgborder" src="{{ url('assets/img/uploadPresentation') }}/{{$presentation->miniature}}" />
                    <span class="card-title bckcard">{{$presentation->tittle}} &nbsp; | &nbsp;  <i class="fas fa-user">&nbsp;</i> {{ $usernames[$key]->name }} </span>
                  </div>
                  <div class="card-content">
                    <p class="sepatationne">
                      {{$presentation->description}}
                    </p>
                    <p class="sepatationne3">
                      
                    </p>
                    <div class="btnsbtn">
                      @auth
                        @if($presentation->iduser === \Auth::user()->id)
                          <a href="{{ url('modify', $presentation->id) }}" class="btn btn-succes btnmiobtn spk2"><i class="fas fa-hand-pointer">&nbsp;</i> Modify</a>
                          <a href="{{ url('unsubscribe', $presentation->id) }}" class="btn btn-alert btnmiobtn spk3"><i class="fas fa-times">&nbsp;</i> Delete</a>
                        @endif
                      @endauth
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      @endforeach
    </section>
    
@endsection


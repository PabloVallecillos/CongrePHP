@extends('welcome')

@section('content')

    <section class="variable slider">
      @foreach($userPresentations as $key => $userPresentation)
          <div>
            
            <div class="row">
              <div class="col s12 m7">
                <div class="card" style="width: 350px;">
                  <div class="card-image">
                    
                    <img class="imgborder" src="{{ url('assets/img/uploadPresentation') }}/{{$userPresentation->miniature}}" />
                    <span class="card-title bckcard">{{$userPresentation->tittle}}</span>
                  </div>
                  <div class="card-content">
                    <p class="sepatationne">
                      {{$userPresentation->description}}
                    </p>
                    <div class="btnsbtn">
                       
                       @foreach($payCongress as $payCongres)
                          
                           @if($payCongres->check === 1 && $payCongres->idpresentation  == $userPresentation->id && \Auth::user()->id == $payCongres->iduser) 
                            <a href="{{ url('video', $userPresentation->id) }}" type="button" class="btn btn-primary btnmiobtn2">
                              <i class="fas fa-eye">&nbsp;</i> view !
                            </a>
                           @endif 
                           @if($payCongres->check === 0 && \Auth::user()->id == $payCongres->iduser && $payCongres->idpresentation  == $userPresentation->id )
                               <a onclick="function(e){e.preventDefault();}" type="button" class="btn btn-primary btnmiobtn">
                                  <i class="fas fa-eye"> &nbsp;</i> wait !
                                </a>
                           @endif
                           {{--@if($payCongres->check === 0 && \Auth::user()->id == $payCongres->iduser && $payCongres->idpresentation  !== $userPresentation->id)  --}}
                            
                           {{--@endif--}}
                       @endforeach
                          <a href="{{ url('subscribe',$userPresentation->id) }}" type="button" class="btn btn-primary btnmiobtn">
                                <i class="fas fa-hand-pointer">&nbsp;</i> subscribe !
                              </a>  
                     
                       @if(\Session::get('download.in.the.next.request')) 
                         @if(\Session::get('idpresentation') == $userPresentation->id) 
                                    
                           <form  method="POST"
                                  action="{{ action('AsistantController@uploadPay', $userPresentation->id) }}"
                                  enctype="multipart/form-data">
                             @csrf
                             <input type="file" name="file" />
                             <input type="submit" value="submit">
                           </form>
                           
                            <form method="post" action="{{ action('AsistantController@pdfOtherPage') }}">
                              @csrf
                             <button id="infoei" onclick="alert('If you want to see conference, Wait for confirmation')" style="margin-left:1em" type="submit" class="btn btn-primary btnmiobtn">
                               <i class="fas fa-hand-pointer">&nbsp;</i> download !
                             </button>
                            </form> 
                         @endif  
                       @endif  
                       
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
      @endforeach
    </section>
@endsection
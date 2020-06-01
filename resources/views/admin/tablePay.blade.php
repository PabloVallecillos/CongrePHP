@extends('welcome')

@section('content')

    <table class="table table-striped">
      <thead>
        <tr>
          
          <th scope="col">User Pay Presentation</th>
          <th scope="col">Presentation</th>
          <th scope="col">Date</th>
          <th scope="col">Check Pay</th>
          <th scope="col"><a href="#" class="btn btn-success">Add</a></th>
        </tr>
      </thead>
      <tbody>
   
          
          @foreach($payCongress as $key => $payCongres)
            <tr>
            
                <td>{{$payCongres->user->name}}</td>
                <td> {{$payCongres->presentation->tittle}}</td>
                <td>{{$payCongres->created_at}}</td>
                <td>
                {{--  @if($pay->pay == 1) --}}
                    <!--<input type="checkbox" name="pay" checked disabled>-->
                {{--  @elseif($pay->pay == 2) --}}
                    <!--<input type="checkbox" name="pay" disabled>-->
                {{--  @elseif($pay->pay == 3) --}}
                    
                      <a href="{{url('assets/pdf/'. $payCongres->iduser .'/'.$payCongres->document)}}" target="_blank"> {{$payCongres->document}}</a> @if($payCongres->check === 1) (checked)@endif
                    
                  {{--@endif --}}
                </td>
                <td>
                  <form  method="POST"
                          action="{{ action('AdminController@checkPay', $payCongres->id) }}"
                          enctype="multipart/form-data"
                          style="display: inline-block !important;"
                  >
                     @csrf
                     <input type="submit" value="Check" class="btnuser btn btn-warning btnuser">
                  </form>
                  
                  <form  method="POST"
                          action="{{ action('AdminController@checkNoPay', $payCongres->id) }}"
                          enctype="multipart/form-data"
                          style="display: inline-block !important;"
                  >
                     @csrf
                     <input type="submit" value="UnCheck" class="btnuser btn btn-danger btnuser" >
                  </form>
                  
                  
                  <a href="{{ url('/editPay',  $payCongres->id) }}" class="btn btn-info btnuser">Edit</button>
                  <a href="{{ url('deletePay/ $payCongres->presentation->iduser') }}" class="btn btn-danger">Delete</button>
                </td>
            </tr>
          @endforeach
      </tbody>
      <div class="pagination">
        
          {{ $payCongress->links('pagination') }}
      </div>
    </table>

@endsection
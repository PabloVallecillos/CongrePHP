@extends('welcome')

@section('content')

    <div class="flexymio">
      
      @foreach($presentations as $presentation)
          <div class="card" style="width: 350px;">
            <div class="card-image">
              
              <img class="imgjeje" src="{{ url('assets/img/uploadPresentation') }}/{{$presentation->miniature}}" />
              <span class="card-title blacky">{{$presentation->tittle}}</span>
            </div>
            <div class="card-content centertext">
              <p class="sepatationne2">
                {{$presentation->description}}
              </p>
              
            </div>
          </div>
      @endforeach
      
      <div class="item2">
        <div class="contentItem2">
          <h3 class="mio11" style="text-align: center">
          To subscribe to this presentation you must pay it, please enter the required data in the form below:
          </h3>
          <div class="mio22">
            
            <form  class="formroew" method="post" action="{{ url('pdf',$presentation->id) }}" class="form2">
            {{csrf_field()}}
      
              <div class="left">
                <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input required type="text" class="form-control marginpdf" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                   @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                </div>
                <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input required type="text" class="form-control marginpdf"  name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                  @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                  <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-send"></i></span>
                  <input required class="form-control marginpdf" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
      
              <div class="right">
                <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                  <input required class="form-control marginpdf" type="tel" name="phone" placeholder="Phone" value="{{old('phone')}}">
                  @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
      
                <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                  <input required class="form-control marginpdf" type="number" name="card" placeholder="Credit Card" value="{{old('phone')}}">
                  @error('card')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                 
                
                <div class="margin">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-print"></i></span>
                  
                  <button class="form-control" type="submit"> Submit PDF</button> 
                </div>
                 
                  
              </div>
             </form>
             
          </div>
          
        </div>
      </div>
      
    </div>
    

@endsection
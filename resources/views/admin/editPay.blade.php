@extends('welcome')

@section('content')

    <form method="post" action="{{ action('PayResourceController@updatePay', $data2->id) }}">
      @csrf
      
      <div style="margin-top: 1em;" id="type2" class="form-group">
        <label class="control-label col-md-4 typere">Select User </label>
    
        <select name="typeUser" class="form-control miojeje col-md-12">
            @foreach($data as $key =>  $dat)
              <option @if($data2->user->name == $dat->user->name) selected @endif> {{ $dat->user->name }}  </option>
            @endforeach
        </select>
        
      </div>
      
      <div style="margin-top: 1em;" id="type2" class="form-group">
        <label class="control-label col-md-4 ">Select Presentation </label>
       
        <select name="typePresentation" class="form-control miojeje col-md-12">
            @foreach($data as $key => $dat)
              <option @if($data2->presentation->tittle == $dat->presentation->tittle) selected @endif > {{ $dat->presentation->tittle }} </option>
            @endforeach
        </select>
      </div>
      
        
        <input type="hidden" name="hidden_id" id="hidden_id" />
         <input
          type="submit"
          name="action_button"
          id="action_button"
          class="btn btn-success"
          value="Update pay"
        />
    </form>

@endsection
@extends('admin.index')

@section('content')

   <form method="post" id="colormioform" action="{{ action('UserController@update', $data->id) }}">
      @csrf
      <div class="form-group">
        <label class="labelico control-label col-md-2">Name </label>
        <div class="col-md-12">
          <input
            type="text"
            name="name"
            id="name2"
            class="form-control miojeje"
            value="{{$data->name}}"
          />
        </div>
      </div>
    
      <div style="margin-top: 1em;" id="type2" class="form-group">
        <label class="control-label col-md-2 typere">Type </label>
    
        <select name="type" class="form-control miojeje col-md-12">
          <!-- <option value="{{ $data->type }}">{{ $data->type }}</option> -->
          <option value="Asistant" @if($data->type === 'Asistant') selected @endif > Asistant</option>
          <option value="Speaker" @if($data->type === 'Speaker') selected @endif > Speaker</option>
          <option value="Comite" @if($data->type === 'Comite') selected @endif > Comite</option>
          <option value="Admin" @if($data->type === 'Admin') selected @endif > Admin</option>
        </select>
      </div>
    
      <div style="margin-top: 1em;" class="form-group">
        <label class="labelico control-label col-md-2">Email </label>
        <div class="col-md-12">
          <input
            type="email"
            name="email"
            class="form-control miojeje"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            value="{{$data->email}}"
          />
        </div>
      </div>
      <br />
    
      <input type="hidden" name="action" id="action" value="Add" />
      <input type="hidden" name="hidden_id" id="hidden_id" />
      <input type="submit" name="action_button" class="btn btn-info" value="Edit" />
    </form>




@endsection
@extends('admin.index')

@section('content')

   <form method="post" id="sample_form" action="{{ action('UserController@store') }}">
      @csrf
          <div class="form-group miojeje miofrom">
              <label class="labelico control-label col-md-2">Name </label>
                <div class="col-md-12">
                  <input type="text" name="name" id="name2" class="form-control" />
                </div>
          </div>
        
       <div style="margin-top: 1em;" id="type2" class="form-group miojeje">
          <label class="labelico control-label col-md-2">Type </label>
          <select name="type" class="form-control col-md-12">
              <option value="0">Select Type</option>
              <option value="Asistant">Asistant</option>
              <option value="Speaker">Speaker</option>
              <option value="Comite">Comite</option>
              <option value="Admin">Admin</option>
          </select>
        </div>
     
      <div style="margin-top: 1em;" class="form-group miojeje">
        <label class="labelico control-label col-md-2">Email </label>
        <div class="col-md-12">
            <input type="email"  name="email" class="form-control" id="email2" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
      </div>
      <br />
      
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
         <input
          type="submit"
          name="action_button"
          id="action_button"
          class="btn btn-success"
          value="Add"
        />
    </form>

@endsection
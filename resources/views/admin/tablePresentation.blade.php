@extends('welcome')

@section('content')
    <div class="mie">
       <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Miniature</th>
            <th scope="col">Description</th>
            <th scope="col"><a href="{{ url('speaker') }}" class="btn btn-success">Add</a></th>
          </tr>
        </thead>
        <tbody>
            @foreach($presentations as $presentation)
              <tr>
                    <td>
                      <a href="http://www.youtube.com/embed/{{$presentation->video}}" target="_blank">{{$presentation->tittle}}</a>
                    </td>
                    <td>
                      <img src="{{url('assets/img/uploadPresentation')}}/{{$presentation->miniature}}" width="200px" ></img>
                    </td>
                    <td>{{$presentation->description}}</td>
                    <td>
                          <a href="{{ url('modify', $presentation->id) }}" class="btn btn-info btnuser">Edit</button>
                          <a href="{{ url('unsubscribe', $presentation->id) }}" class="btn btn-danger">Delete</button>
                    </td>
              </tr>
            @endforeach
        </tbody>
        <div class="pagination">
            {{ $presentations->links('pagination') }}
        </div>
      </table>
    </div>
   
@endsection
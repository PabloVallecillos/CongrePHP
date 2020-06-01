@extends('welcome')

@section('content')

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Type</th>
          <th scope="col">Email</th>
          <th scope="col"><a href="{{ url('add') }}" class="btn btn-success">Add</a></th>
        </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
            <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->type}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                        <a href="edit/{{$user->id}}" class="btn btn-info btnuser">Edit</button>
                        <a href="destroy/{{$user->id}}" class="btn btn-danger">Delete</button>
                  </td>
            </tr>
          @endforeach
      </tbody>
      <div class="pagination">
        
          {{ $users->links('pagination') }}
      </div>
    </table>

@endsection
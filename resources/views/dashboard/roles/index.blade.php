@extends('dashboard.layout')

@section('header')
    <h3> role   </h3>
    <h3> <a href="{{route('role.create')}}"> Create role </a>    </h3>
@endsection


@section('body')


<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">permissions</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$role->name}}</td>

            <td>
                @foreach ($role->permissions as $permission)
                    {{$permission->name}}
                @endforeach
            </td>

            <td><a href="{{route('role.edit',$role->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('role.destroy',$role->id)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete">
                </form>

            </td>
          </tr>
        @endforeach


    </tbody>
  </table>

@endsection



@section('footer')
    <h3> footer of role </h3>
@endsection

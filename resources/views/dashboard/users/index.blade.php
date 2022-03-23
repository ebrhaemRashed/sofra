@extends('dashboard.layout')

@section('header')
    <h3> users   </h3>
    <h3> <a href="{{route('user.create')}}"> Create user </a>    </h3>
@endsection


@section('body')
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">role</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>

            <td>{{$user->name}}</td>

            <td>
                @foreach ($user->roles as $role)
                    {{$role->name}}
                @endforeach
            </td>


            <td><a href="{{route('user.edit',$user->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('user.destroy',$user->id)}}">
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
    <h3> footer of users page </h3>
@endsection

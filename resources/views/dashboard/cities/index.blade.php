@extends('dashboard.layout')

@section('header')
    <h3> Cities   </h3>
    <h3> <a href="{{route('city.create')}}"> Create City </a>    </h3>
@endsection


@section('body')
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$city->name}}</td>
            <td><a href="{{route('city.edit',$city->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('city.destroy',$city->id)}}">
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
    <h3> footer of cities page </h3>
@endsection

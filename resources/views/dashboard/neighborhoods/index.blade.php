@extends('dashboard.layout')

@section('header')
    <h3> neighborhoods   </h3>
    <h3> <a href="{{route('neighborhood.create')}}"> Create neighborhood </a>    </h3>
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
        @foreach ($neighborhoods as $neighborhood)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$neighborhood->name}}</td>
            <td><a href="{{route('neighborhood.edit',$neighborhood->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('neighborhood.destroy',$neighborhood->id)}}">
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
    <h3> footer of neighborhood </h3>
@endsection

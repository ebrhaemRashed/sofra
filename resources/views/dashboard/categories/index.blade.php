@extends('dashboard.layout')

@section('header')
    <h3> Categories   </h3>
    <h3> <a href="{{route('category.create')}}"> Create category </a>    </h3>
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
        @foreach ($categories as $category)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$category->name}}</td>
            <td><a href="{{route('category.edit',$category->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('category.destroy',$category->id)}}">
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
    <h3> footer of category </h3>
@endsection

@extends('dashboard.layout')

@section('header')
    <h3> resturant   </h3>
@endsection


@section('body')

<form action =""  method="get">
    @csrf
    @inject('neighborhoods','App\Models\Neighborhood' )
    <select name="neighborhood_id">
        <optgroup label="neighborhoods">
         <option selected disabled>choose neighborhood </option>
            @foreach ($neighborhoods->all() as $neighborhood)
                <option value="{{$neighborhood->id}}"> {{$neighborhood->name}} </option>
            @endforeach
        </optgroup>
    </select>
    <input type="submit" value="search">
</form>

<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">show</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($resturants as $resturant)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$resturant->name}}</td>
            <td><a href="{{route('resturant.show',$resturant->id)}}">show </a></td>
            <td>
                <form method="post" action = "{{route('resturant.destroy',$resturant->id)}}">
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
    <h3> footer of resturant </h3>
@endsection

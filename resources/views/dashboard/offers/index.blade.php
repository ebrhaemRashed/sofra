@extends('dashboard.layout')

@section('header')
    <h3> offer   </h3>
    <h3> <a href="{{route('offer.create')}}"> Create offer </a>    </h3>
@endsection


@section('body')

<form action =""  method="get">
    @csrf
    @inject('meals','App\Models\Meal' )
    <select name="meal">
        <optgroup label="Meals">
         <option selected disabled>choose meal </option>
        @foreach ($meals->all() as $meal)
            <option value="{{$meal->id}}"> {{$meal->name}} </option>
        @endforeach
        </optgroup>
    </select>

    @inject('resturants','App\Models\Resturant' )
    <select name="resturant">
        <optgroup label="Resturants">
        <option selected disabled>choose resturant </option>
        @foreach ($resturants->all() as $resturant)
            <option value="{{$resturant->id}}"> {{$resturant->name}} </option>
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
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($offers as $offer)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$offer->name}}</td>
            <td><a href="{{route('offer.edit',$offer->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('offer.destroy',$offer->id)}}">
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
    <h3> footer of offer </h3>
@endsection

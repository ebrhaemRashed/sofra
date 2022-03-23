@extends('dashboard.layout')

@section('header')
    <h3> Create offer </h3>
@endsection


@section('body')
    <form method="post" action="{{route('offer.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <label for="offer">offer Name</label>
        <input type="text" class="form-control" id="offer" name="offer">

        @inject('resturants', 'App\Models\Resturant')
        <select name='resturant'>
            @foreach ($resturants->all() as $resturant )
            <option selected value="{{$resturant->id}}"> {{$resturant->name}}  </option>
            @endforeach
        </select>

        @inject('meals', 'App\Models\Meal')
        <select name='meal'>
            @foreach ($meals->all() as $meal )
                <option value="{{$meal->id}}"> {{$meal->name}}  </option>
            @endforeach
        </select>

        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create offer </h3>
@endsection

@extends('dashboard.layout')

@section('header')
    <h3> Edit offer </h3>
@endsection

@section('body')
    <form method="post" action="{{route('offer.update',$offer->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
        <label for="offer">offer Name</label>
        <input type="text" class="form-control" id="offer" name="offer" value="{{$offer->name}}">

        @inject('resturants', 'App\Models\Resturant')
        <select name="resturant">
            @foreach ($resturants->all() as $resturant)
                <option
                    @if($offer->resturant_id == $resturant->id)
                    selected
                    @endif
                value="{{$resturant->id}}" > {{$resturant->name}} </option>
            @endforeach
        </select>

        @inject('meals', 'App\Models\Meal')
            <select name='meal'>
                @foreach ($meals->all() as $meal )
                    <option
                        @if($offer->meal_id == $meal->id)
                        selected
                        @endif
                    value="{{$meal->id}}"> {{$meal->name}}  </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection



@section('footer')
    <h3> footer of Edit offer </h3>
@endsection

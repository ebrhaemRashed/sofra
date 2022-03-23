@extends('dashboard.layout')

@section('header')
    <h3> Edit neighborhood </h3>
@endsection

@section('body')
    <form method="post" action="{{route('neighborhood.update',$neighborhood->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
        <label for="neighborhood">neighborhood Name</label>
        <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{$neighborhood->name}}">
        <select name="city">
            @inject('cities', 'App\Models\City')
            @foreach ($cities->all() as $city)
                <option
                @if($neighborhood->city_id == $city->id)
                selected
                @endif
                value="{{$city->id}}" > {{$city->name}} </option>
            @endforeach
        </div>
        </select>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection



@section('footer')
    <h3> footer of Edit neighborhood </h3>
@endsection

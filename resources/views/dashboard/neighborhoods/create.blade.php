@extends('dashboard.layout')

@section('header')
    <h3> Create neighborhood </h3>
@endsection


@section('body')
    <form method="post" action="{{route('neighborhood.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <label for="neighborhood">neighborhood Name</label>
        <input type="text" class="form-control" id="neighborhood" name="neighborhood">

        @inject('cities', 'App\Models\City')
        <select name='city'>
            @foreach ($cities->all() as $city )
            <option value="{{$city->id}}"> {{$city->name}}  </option>
            @endforeach
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create neighborhood </h3>
@endsection

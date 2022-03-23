@extends('dashboard.layout')

@section('header')
    <h3> Edit City </h3>
@endsection


@section('body')
    <form method="post" action="{{route('city.update',$city->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
        <label for="city">City Name</label>
        <input type="text" class="form-control" id="city" name="city" value="{{$city->name}}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Edit City </h3>
@endsection

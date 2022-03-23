@extends('dashboard.layout')

@section('header')
    <h3> Create City </h3>
@endsection


@section('body')
    <form method="post" action="{{route('city.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <label for="city">City Name</label>
        <input type="text" class="form-control" id="city" name="city">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create City </h3>
@endsection

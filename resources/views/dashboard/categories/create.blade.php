@extends('dashboard.layout')

@section('header')
    <h3> Create category </h3>
@endsection


@section('body')
    <form method="post" action="{{route('category.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <label for="category">category Name</label>
        <input type="text" class="form-control" id="category" name="category">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create category </h3>
@endsection

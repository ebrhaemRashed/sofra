@extends('dashboard.layout')

@section('header')
    <h3> Create user </h3>
@endsection


@section('body')
    <form method="post" action="{{route('user.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
            <input type="text" class="form-control"  name="name" placeholder="name">
            <input type="text" class="form-control"  name="email" placeholder="email">

            @foreach ($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->id}}" > {{$role->name}} <br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create user </h3>
@endsection

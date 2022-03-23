@extends('dashboard.layout')

@section('header')
    <h3> Create role </h3>
@endsection


@section('body')
    <form method="post" action="{{route('role.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <input type="text" class="form-control"  name="name">

            @foreach ($permissions as  $permission)
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" > {{$permission->name}} <br>
            @endforeach

        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create role </h3>
@endsection

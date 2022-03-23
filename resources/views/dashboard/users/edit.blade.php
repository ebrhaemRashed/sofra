@extends('dashboard.layout')

@section('header')
    <h3> Edit user </h3>
@endsection


@section('body')
    <form method="post" action="{{route('user.update',$user->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
            <input type="text" class="form-control" name="email" value="{{$user->email}}">

            @foreach ($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                    @if ($user->hasRole($role->name))
                        Checked
                    @endif
                > {{$role->name}} <br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Edit user </h3>
@endsection

@extends('dashboard.layout')

@section('header')
    <h3> Edit role </h3>
@endsection

@section('body')
    <form method="post" action="{{route('role.update',$role->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
        <input type="text" class="form-control"  name="name" value="{{$role->name}}">

        @foreach ($permissions as $permission)
            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @if($role->hasPermissionTo($permission->name))
                    Checked
                @endif
            > {{$permission->name}}
        @endforeach



        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection



@section('footer')
    <h3> footer of Edit role </h3>
@endsection

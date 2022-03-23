@extends('dashboard.layout')

@section('header')
    <h3> Edit setting </h3>
@endsection

@section('body')
    <form method="post" action="{{route('setting.update',$setting->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
            <input type="text" class="form-control"  name="phone" value="{{$setting->phone}}" placeholder="phone">
            <input type="text" class="form-control"  name="email" value="{{$setting->email}}" placeholder="email">
            <input type="text" class="form-control"  name="fb_link" value="{{$setting->fb_link}}" placeholder="fb_link">
            <input type="text" class="form-control"  name="tw_link" value="{{$setting->tw_link}}" placeholder="tw_link">
            <input type="text" class="form-control"  name="inst_link" value="{{$setting->inst_link}}" placeholder="inst_link">
        </div>
        </select>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection



@section('footer')
    <h3> footer of Edit setting </h3>
@endsection

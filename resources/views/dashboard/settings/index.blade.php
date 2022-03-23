@extends('dashboard.layout')

@section('header')
    <h3> setting   </h3>
@endsection


@section('body')
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">fb_link</th>
        <th scope="col">tw_link</th>
        <th scope="col">inst_link</th>
        <th scope="col">Edit</th>

      </tr>
    </thead>
    <tbody>
        @foreach ($settings as $setting)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$setting->email}}</td>
            <td>{{$setting->phone}}</td>
            <td>{{$setting->fb_link}}</td>
            <td>{{$setting->tw_link}}</td>
            <td>{{$setting->inst_link}}</td>
            <td><a href="{{route('setting.edit',$setting->id)}}">Edit </a></td>
          </tr>
        @endforeach


    </tbody>
  </table>

@endsection



@section('footer')
    <h3> footer of setting </h3>
@endsection

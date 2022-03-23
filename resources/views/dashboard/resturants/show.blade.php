@extends('dashboard.layout')

@section('header')
    <h3> Show resturant   </h3>
@endsection


@section('body')


<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">phone</th>
        <th scope="col">min_charge</th>
        <th scope="col">is_opened</th>
      </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{$resturant->name}}</td>
            <td>{{$resturant->email}}</td>
            <td>{{$resturant->phone}}</td>
            <td>{{$resturant->min_charge}}</td>
            <td>{{$resturant->is_opened}}</td>
          </tr>
    </tbody>
  </table>


@endsection



@section('footer')
    <h3> footer of resturant </h3>
@endsection

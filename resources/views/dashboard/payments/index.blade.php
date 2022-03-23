@extends('dashboard.layout')

@section('header')
    <h3> payment   </h3>
    <h3> <a href="{{route('payment.create')}}"> Create payment </a>    </h3>
@endsection


@section('body')
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$payment->name}}</td>
            <td><a href="{{route('payment.edit',$payment->id)}}">Edit </a></td>
            <td>
                <form method="post" action = "{{route('payment.destroy',$payment->id)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete">
                </form>

            </td>
          </tr>
        @endforeach


    </tbody>
  </table>

@endsection



@section('footer')
    <h3> footer of payment </h3>
@endsection

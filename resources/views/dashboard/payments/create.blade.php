@extends('dashboard.layout')

@section('header')
    <h3> Create payment </h3>
@endsection


@section('body')
    <form method="post" action="{{route('payment.store')}}">
    @csrf
    @include('partial.validation')
        <div class="form-group">
        <label for="payment">payment Name</label>
        <input type="text" class="form-control" id="payment" name="payment">

        @inject('resturants', 'App\Models\Resturant')
        <select name='resturant'>
            @foreach ($resturants->all() as $resturant )
            <option selected value="{{$resturant->id}}"> {{$resturant->name}}  </option>
            @endforeach
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
  </form>

@endsection



@section('footer')
    <h3> footer of Create payment </h3>
@endsection

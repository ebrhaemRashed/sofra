@extends('dashboard.layout')

@section('header')
    <h3> Edit payment </h3>
@endsection

@section('body')
    <form method="post" action="{{route('payment.update',$payment->id)}}">
    @csrf
    @method('put')
    @include('partial.validation')
        <div class="form-group">
        <label for="payment">payment Name</label>
        <input type="text" class="form-control" id="payment" name="payment" value="{{$payment->name}}">
        <select name="resturant">
            @inject('resturants', 'App\Models\Resturant')
            @foreach ($resturants->all() as $resturant)
                <option
                @if($payment->resturant_id == $resturant->id)
                selected
                @endif
                value="{{$resturant->id}}" > {{$resturant->name}} </option>
            @endforeach
        </div>
        </select>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection



@section('footer')
    <h3> footer of Edit payment </h3>
@endsection

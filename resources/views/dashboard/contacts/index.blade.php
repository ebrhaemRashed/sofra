@extends('dashboard.layout')

@section('header')
    <h3> contact   </h3>
    <h3> <a href="{{route('contact.create')}}"> Create contact </a>    </h3>
@endsection


@section('body')

<form action =""  method="get">
    @csrf
    @inject('clients','App\Models\Client' )
    <select name="client_id">
        <optgroup label="client">
         <option selected disabled>choose client </option>
        @foreach ($clients->all() as $client)
            <option value="{{$client->id}}"> {{$client->name}} </option>
        @endforeach
        </optgroup>
    </select>
    <input type="submit" value="search">
</form>

<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">from</th>
        <th scope="col">title</th>
        <th scope="col">message</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$contact->client()->where('id',$contact->client_id)->first()->name}}</td>
            <td>{{$contact->title}}</td>
            <td>{{$contact->message}}</td>
            <td>
                <form method="post" action = "{{route('contact.destroy',$contact->id)}}">
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
    <h3> footer of contact </h3>
@endsection

@extends('layouts.app')

@section('content')
    <div id="app">
        <test />
    </div>
    <h1> {{$pytanie[0]->tresc}} </h1>
    <form action="/odp" method="POST">
    @csrf
    @foreach ($pytanie[0]->odpowiedzi as $odpowiedz)
        <input name="odpowiedz" type="radio" value="{{$odpowiedz->id}}">
            <label>{{$odpowiedz->tresc}}</label>
    @endforeach
    <button type="submit" class="btn btn-primary">
            Wybierz
    </button>
    <a href="{{route('losowanie1')}}" class="btn btn-primary"> Następne pytanie    </a>    
    @if (\Session::has('sprawdzanie'))
        <div class="wynik">
            <ul>
                <li>{!! \Session::get('sprawdzanie')!!}</li>
            </ul>
        </div>
    @endif
    </form>
@endsection
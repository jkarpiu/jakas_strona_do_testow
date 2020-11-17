@extends('layouts.app')

@section('content')
    <h1> {{$pytanie[0]->tresc}} </h1>
    @foreach ($pytanie[0]->odpowiedzi as $odpowiedz)
        <input name="odpowiedz" type="radio" value="{{$odpowiedz->id}}">
            <label>{{$odpowiedz->tresc}}</label>
    @endforeach
    <button type="submit" href="Route::controller('odpowiedz', 'randQuestionController')" class="btn btn-primary">
            Wybierz
    </button>
@endsection
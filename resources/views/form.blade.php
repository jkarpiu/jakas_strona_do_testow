@extends('layouts.app')

@section('content')
<div id="app">
</div>
    <form action="/dodaj_pytanie" method="POST">
        @csrf
        <h1 class="header1">Dodaj pytanie</h1>
        <input class="form-control question-input" placeholder="Pytanie" type="text" name="pytanie">
        <select class="form-control question-input" name="dzial">
            @foreach ($dzialy as $dzial)
                <option value="{{ $dzial->id }}"> {{ $dzial->nazwa }} </option>
            @endforeach
        </Select>
        <br>
        <h1 class="header2">Dodaj odpowiedzi</h1>
        @foreach (['a1', 'a2', 'a3', 'a4'] as $item)
        <div id="head-answer-all">
            <div id="answer-all">
                <p class="check-valid">Poprawna: <input type="radio" name="valid" value="{{ $item }}"></p>
                    <input class="form-control answer-input" placeholder="Odpowiedź"
                    type="text" name="{{ $item }}" id=" {{ $item }} ">
            </div>
        </div> 
        @endforeach
        <center>
            <button type="submit" class="btn btn-primary">
                Wyślij
            </button>
        </center>
    </form>
@endsection

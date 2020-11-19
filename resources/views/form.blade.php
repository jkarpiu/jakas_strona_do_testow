@extends('layouts.app')

@section('content')
<div id="app">
</div>
    <form action="/dodaj_pytanie" method="POST">
        @csrf
        <h1 class="header1">Dodaj pytanie</h1>
        <input class="form-control" placeholder="Pytanie" type="text" name="pytanie">
        <select class="form-control" name="dzial">
            @foreach ($dzialy as $dzial)
                <option value="{{ $dzial->id }}"> {{ $dzial->nazwa }} </option>
            @endforeach
        </Select>
        <br>
        @foreach (['a1', 'a2', 'a3', 'a4'] as $item)
            <p>Poprawna: <input type="radio" name="valid" value="{{ $item }}">
            <input placeholder="Odpowiedź" class="form-control" type="text" name="{{ $item }}" id=" {{ $item }} "></p>
            <br>
        @endforeach
        <button type="submit" class="btn btn-primary">
            Wyślij
        </button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
<div id="app">
    <jakis-tam-komponent />
</div>
    <form action="/dodaj_pytanie" method="POST">
        @csrf
        <input class="form-control" placeholder="Pytanie" type="text" name="pytanie">
        <br>
        @foreach (['a1', 'a2', 'a3', 'a4'] as $item)
            <p>Poprawna: <input type="radio" name="valid" value="{{ $item }}">
            <input placeholder="Odpowiedź" class="form-control" type="text" name="{{ $item }}" id=" {{ $item }} "></p>
            <br>
        @endforeach
        <select class="form-control" name="dzial">
            @foreach ($dzialy as $dzial)
                <option value="{{ $dzial->id }}"> {{ $dzial->nazwa }} </option>
            @endforeach
        </Select>
        <button type="submit" class="btn btn-primary">
            Wyślij
        </button>
    </form>
@endsection

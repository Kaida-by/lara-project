@extends('layouts.layout', ['title' => 'Успеваемость'])

@section('content')
    успеваемость
    по всем курсам: {{ $resultTests }}%
    <br>
    <br>
    @foreach($resultTopic as $key => $topic)
        Тема: {{ $key }}
        Оценка: {{ $topic }}
        <br>
    @endforeach

@endsection

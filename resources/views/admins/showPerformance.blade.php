@extends('layouts.layout', ['title' => 'Успеваемость'])

@section('content')
    успеваемость
    по всем курсам: {{ $resultTests }}%
    <br>
    <br>
    @foreach($resultTopic as $key => $topic)
        Тема: {{ $topic->title_top }}
        Оценка: {{ $key }}
        <br>
    @endforeach

@endsection

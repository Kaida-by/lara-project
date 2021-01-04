@extends('layouts.layout', ['title' => 'Тема - ' . $topic->title])


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $topic->title_top }}</div>
                <div class="card-body">
                    <div class="cont">{{ $topic->descr_top }}</div>
                    <div class="deadline-top">Время на тест: {{ $topic->deadline }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-btn-test">
        @if($topic->active == 'checked')
            <a href="{{ route('test.index', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Пройти тест</a>
        @else
            <p>Тесты еще не готовы</p>
        @endif
        @if($access)
            <a href="{{ route('test.create', ['id' => $topic->topic_id]) }}" class="btn btn-outline-primary">Добавить тест</a>
            <a href="{{ route('test.showAll', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Посмотреть тесты</a>
        @endif
    </div>
@endsection

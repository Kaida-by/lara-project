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
            <a href="" class="btn btn-outline-success">Пройти тест</a>
        @else
            <p>Тесты еще не готовы</p>
            <a href="{{ route('course.index') }}" class="btn btn-outline-primary">На главную</a>
        @endif
    </div>
@endsection

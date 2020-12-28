@extends('layouts.layout', ['title' => 'Темы'])
@section('content')
    @auth
        @if($accessTopic)
            <div class="block-create">
                <a href="{{ route('topic.create', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Добавить тему</a>
            </div>
        @endif
    @endauth
    <div class="row">
        <div class="col-12">
            @if(count($topics) > 0)
                @foreach($topics as $topic)
                    <div class="card">
                        <div class="card-header">{{ $topic->title_top }}</div>
                        <a href="{{ route('topic.show', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Перейти к теме</a>
                    </div>
                @endforeach
            @else
            <p>Упс, тестов еще нет :(</p>
            @endif
        </div>
    </div>
@endsection

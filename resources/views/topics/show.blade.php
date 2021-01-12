@extends('layouts.layout', ['title' => 'Тема - ' . $topic->title])


@section('content')
    @auth
        @if($resultCourses)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">{{ $topic->title_top }}</div>
                        <div class="card-body">
                            <div class="cont">{{ $topic->descr_top }}</div>
                            <div class="deadline-top">Время на тест: {{ $topic->deadline/60 }} минут</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-btn-test">
                @if($topic->active == 'checked' && !empty($result_test))
                    <a href="{{ route('test.index', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Пройти тест</a>
                @else
                    <p>Тесты еще не готовы</p>
                @endif
                @if($access)
                    <a href="{{ route('test.create', ['id' => $topic->topic_id]) }}" class="btn btn-outline-primary">Добавить тест</a>
                    @if (!empty($result_test))
                        <a href="{{ route('test.showAll', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Посмотреть тесты</a>
                    @endif
                @endif
            </div>
        @else
            <p>Чтобы просматривать эту страницу, необходимо записаться на курс</p>
            <a href="{{ route('course.record', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Записаться на курс</a>
        @endif
    @endauth
@endsection

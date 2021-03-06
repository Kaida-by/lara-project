@extends('layouts.layout', ['title' => 'Курс - ' . $course->title])


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $course->title }}</div>
                <div class="card-body">
                    <div class="cont">{{ $course->descr }}</div>
                    <div class="auth"><span>teacher: </span>{{ $course->name }}</div>
                    <div class="start-c">Начало курса: {{ $course->start }}</div>
                    <div class="end-c">Конец курса: {{ $course->end }}</div>

                    <div class="card-btn">
                        <a href="{{ route('course.index') }}" class="btn btn-outline-primary">На главную</a>
                        @auth
                            @if(\Illuminate\Support\Facades\Auth::user()->id == $course->teacher_id)
                                <a href="{{ route('course.edit', ['id' => $course->course_id]) }}" class="btn btn-outline-warning">Редактировать</a>
                                <form action="{{ route('course.destroy', ['id' => $course->course_id]) }}" method="post"
                                      onsubmit="if (confirm('Вы точно хотите удалить курс?')) { return true } else { return false }">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @if($resultCourses)
            <a href="{{ route('topic.index', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Перейти к темам</a>
        @else
            <a href="{{ route('course.record', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Записаться на курс</a>
        @endif
    </div>
@endsection

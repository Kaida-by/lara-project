@extends('layouts.layout', ['title' => 'Курс - ' . $course->title])

@section('content')

    <form action="{{ route('course.update', ['id' => $course->course_id]) }}" method="post">
        @csrf
        @method('patch')
        <p>Редактировать курс</p>
        <div class="form-group">
            <input type="text" class="form-control" name="title" required value="{{ $course->title }}">
        </div>
        <div class="form-group">
            <textarea name="descr" rows="7" class="form-control" required>{{ $course->descr }}</textarea>
        </div>
        <div class="form-group">
            <input type="date" name="start" required value="{{ $course->start }}">
        </div>
        <div class="form-group">
            <input type="date" name="end" required value="{{ $course->end }}">
        </div>
        <div class="form-group">
            <input type="color" name="background" required value="{{ $course->background }}">
        </div>

        <input type="submit" value="Отредактировать" class="btn btn-success">
    </form>

@endsection

@extends('layouts.layout', ['title' => 'Создание новой темы'])

@section('content')

    <form action="{{ route('topic.store', ['id' => $course->course_id]) }}" method="post">
        @csrf
        <p>Добавить тему</p>
        <div class="form-group">
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <textarea name="descr" rows="7" class="form-control" required></textarea>
        </div>
        <div class="block-deadline">
            <p>Время на тест:</p>
            <p>Часы:минуты</p>
            <input type="time" name="deadline">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" name="access" type="checkbox" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label" for="flexSwitchCheckChecked">Доступ</label>
        </div>
        <input type="submit" value="Добавить тему" class="btn btn-success">
    </form>

@endsection

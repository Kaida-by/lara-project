@extends('layouts.layout', ['title' => 'Курс - ' . $topic->title_top])

@section('content')

    <form action="{{ route('topic.update', ['id' => $topic->topic_id]) }}" method="post">
        @csrf
        @method('patch')
        <p>Редактировать курс</p>
        <div class="form-group">
            <input type="text" class="form-control" name="title" required value="{{ $topic->title_top }}">
        </div>
        <div class="form-group">
            <textarea name="descr" rows="7" class="form-control" required>{{ $topic->descr_top }}</textarea>
        </div>
        <div class="block-deadline">
            <p>Время на тест:</p>
            <p>Часы:минуты</p>
            <input type="time" name="deadline" required value="{{ $topic->deadline }}">
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" name="access" type="checkbox" id="flexSwitchCheckChecked" {{ $topic->active }} value="checked">
            <label class="form-check-label" for="flexSwitchCheckChecked">Доступ</label>
        </div>

        <input type="submit" value="Отредактировать" class="btn btn-success">
    </form>

@endsection

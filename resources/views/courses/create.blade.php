@extends('layouts.layout', ['title' => 'Создание нового курса'])

@section('content')

    <form action="{{ route('course.store') }}" method="post">
        @csrf
        <p>Добавить курс</p>
        <div class="form-group">
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <textarea name="descr" rows="7" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <input type="date" name="start" required>
        </div>
        <div class="form-group">
            <input type="date" name="end" required>
        </div>

        <input type="submit" value="Добавить курс" class="btn btn-success">
    </form>

@endsection

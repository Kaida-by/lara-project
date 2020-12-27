@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    @if (isset($_GET['search']))
        @if (count($courses) > 0)
            <h2>По запросу "<?php echo $_GET['search']; ?>" найдено {{ count($courses) }} курсов.</h2>
        @else
            <h2>По запросу "<?php echo $_GET['search']; ?>" ничего не найдено.</h2>
            <a href="{{ route('course.index') }}" class="btn btn-outline-primary">Отобразить все курсы</a>
        @endif
    @endif

    <div class="row">
        @foreach($courses as $course)
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ $course->title }}</div>
                <div class="card-body">
                    <div class="cont">{{ $course->descr }}</div>
                    <div class="auth"><span>teacher: </span>{{ $course->name }}</div>
                    <a href="{{ route('course.show', ['id' => $course->course_id]) }}" class="btn btn-outline-primary">Перейти к курсу</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if (!isset($_GET['search']))
        {{ $courses->links() }}
    @endif
@endsection

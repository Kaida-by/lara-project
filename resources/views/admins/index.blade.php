@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    <div class="block-h">Hello, {{ $user->name }}</div>
    <p>What are you going to do?</p>
    <a class="btn btn-outline-success" href="{{ route('admin.edit') }}">Радактировать профиль</a>
    <a class="btn btn-outline-success" href="{{ route('admin.showCourses') }}">Мои курсы</a>
    <a class="btn btn-outline-success" href="{{ route('admin.showPerformance') }}">Успеваемость</a>
@endsection

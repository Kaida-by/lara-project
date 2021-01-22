@extends('layouts.layout', ['title' => 'Редактирование профиля'])

@section('content')
    <form action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <p>Редактировать профиль</p>
        <div class="form-group">
            <input type="text" class="form-control" name="name" required value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" required value="{{ $user->email }}">
        </div>
        <div class="form-group">
            старый пароль
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            новый пароль
            <input type="password" class="form-control" name="password2" required>
        </div>
        <div class="form-group">
            новый пароль еще раз
            <input type="password" class="form-control" name="password3" required>
        </div>

        <div class="form-group">
            Фото профиля
            <input type="file" name="img">
        </div>

        <input type="submit" value="Отредактировать" class="btn btn-success">
    </form>
@endsection

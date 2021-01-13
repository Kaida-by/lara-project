@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    @if(!empty($resultCourse))
        @foreach($resultCourse as $course)
            {{$course->title}}
            {{$course->descr}}
            <a href="{{ route('course.show', ['id' => $course->course_id]) }}" class="btn btn-outline-primary">Перейти к курсу</a>
            @auth
                @if(\Illuminate\Support\Facades\Auth::id() == $course->teacher_id)
                    <a href="{{ route('course.edit', ['id' => $course->course_id]) }}" class="btn btn-outline-warning">Редактировать</a>
                    <form action="{{ route('course.destroy', ['id' => $course->course_id]) }}" method="post"
                          onsubmit="if (confirm('Вы точно хотите удалить курс?')) { return true } else { return false }">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-danger" value="Удалить">
                    </form>
                @endif
            @endauth
            <br><br>
        @endforeach
    @else
        Вы пока не записаны на курсы
    @endif
@endsection

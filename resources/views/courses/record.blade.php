@extends('layouts.layout', ['title' => 'Курс - ' . $course->title])


@section('content')
    <form action="{{ route('course.recordAct', ['id' => $course->course_id]) }}" method="post">
        @csrf
        <p>
            2+2*2 = <input type="text" name="eight" required>
        </p>
        <input type="submit" value="Отправить" class="btn btn-success">
    </form>
@endsection

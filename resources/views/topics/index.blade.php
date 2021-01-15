@extends('layouts.layout', ['title' => 'Темы'])
@section('content')
    @auth
        @if($accessTopic)
            <div class="block-create">
                <a href="{{ route('topic.create', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Добавить тему</a>
            </div>
        @endif
        @if($resultCourses)
            <div class="row">
                <div class="col-12">
                    @if(count($topics) > 0)
                        @foreach($topics as $topic)
                            <div class="card">
                                <div class="card-header">{{ $topic->title_top }}</div>
                                @if ($topic->active)
                                  <a href="{{ route('topic.show', ['id' => $topic->topic_id]) }}" class="btn btn-outline-success">Перейти к теме</a>
                                @else
                                  Тема еще не доступна
                                @endif
                               
                                @if($course->teacher_id == \Illuminate\Support\Facades\Auth::id())
                                    <div class="card-btn">
                                        <a href="{{ route('course.index') }}" class="btn btn-outline-primary">На главную</a>
                                        @if(\Illuminate\Support\Facades\Auth::id() == $topic->teacher_id)
                                            <a href="{{ route('topic.edit', ['id' => $topic->topic_id]) }}" class="btn btn-outline-warning">Редактировать</a>
                                            <form action="{{ route('topic.destroy', ['id' => $topic->topic_id]) }}" method="post"
                                                  onsubmit="if (confirm('Вы точно хотите удалить эту тему?')) { return true } else { return false }">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                    <p>Упс, тестов еще нет :(</p>
                    @endif
                </div>
            </div>
        @else
            <p>Чтобы просматривать эту страницу, необходимо записаться на курс</p>
            <a href="{{ route('course.record', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Записаться на курс</a>
        @endif
    @endauth
@endsection

@extends('layouts.layout', ['title' => 'Тема'])
@section('content')
    @auth
        @if($resultCourses)
            <div class="row">
                <div class="col-12">
                    @if($test_arr)
                        <div class="bl-time">Тест закончиться через: <span id="t_m"></span></div>
                        <form action="{{ route('test.prores', ['id' => $topic->topic_id]) }}" method="post">
                            @csrf
                            @method('patch')
                            @foreach($test_arr as $key => $test)
                                <div class="card">
                                    <div class="card-header">Задание: {{ $key+1 }} - {{ $test->question }}</div>
                                    <div class="card-body">
                                        <input name="ans{{ $test->test_id . '0' }}" type="checkbox" class="input" id="customCheck{{ $key . $test->test_id . '1' }}" value="{{ $test->answer_1 }}">
                                        <label class="label" for="customCheck{{ $key . $test->test_id . '1' }}">{{ $test->answer_1 }}</label><br>

                                        <input name="ans{{ $test->test_id . '1' }}" type="checkbox" class="input" id="customCheck{{ $key . $test->test_id . '2' }}" value="{{ $test->answer_2 }}">
                                        <label class="label" for="customCheck{{ $key . $test->test_id . '2' }}">{{ $test->answer_2 }}</label><br>

                                        <input name="ans{{ $test->test_id . '2' }}" type="checkbox" class="input" id="customCheck{{ $key . $test->test_id . '3' }}" value="{{ $test->answer_3 }}">
                                        <label class="label" for="customCheck{{ $key . $test->test_id . '3' }}">{{ $test->answer_3 }}</label><br>

                                        <input name="ans{{ $test->test_id . '3' }}" type="checkbox" class="input" id="customCheck{{ $key . $test->test_id . '4' }}" value="{{ $test->answer_4 }}">
                                        <label class="label" for="customCheck{{ $key . $test->test_id . '4' }}">{{ $test->answer_4 }}</label><br>

                                        <input name="ans{{ $test->test_id . '4' }}" type="checkbox" class="input" id="customCheck{{ $key . $test->test_id . '5' }}" value="{{ $test->answer_5 }}">
                                        <label class="label" for="customCheck{{ $key . $test->test_id . '5' }}">{{ $test->answer_5 }}</label>
                                    </div>
                                </div>
                            @endforeach
                                <input type="submit" class="btn btn-success" id="c_l_c" value="Завершить тест">
                        </form>
                        <script>
                            var countDownDate = {{ $deadline * 1000 }}
                            var x = setInterval(function() {
                                //Сейчас
                                var now = new Date().getTime();
                                //Разница
                                var diff = countDownDate - now;
                                // рассчет времени
                                var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((diff % (1000 * 60)) / 1000);
                                // Вывод времени
                                document.getElementById("t_m").innerHTML = hours + "ч "
                                    + minutes + "м " + seconds + "сек ";
                                // Если закончилось время
                                if (diff < 0) {
                                    clearInterval(x);
                                    document.getElementById("c_l_c").click();
                                }
                            }, 1000);
                        </script>
                    @else
                        Упс, тесты пока не придумали :(
                    @endif
                </div>
            </div>
        @else
            <p>Чтобы просматривать эту страницу, необходимо записаться на курс</p>
            <a href="{{ route('course.record', ['id' => $course->course_id]) }}" class="btn btn-outline-success">Записаться на курс</a>
        @endif
    @endauth
@endsection

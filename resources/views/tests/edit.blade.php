@extends('layouts.layout', ['title' => 'Тест - ' . $test->test_id])

@section('content')

    <form action="{{ route('test.update', ['id' => $test->test_id]) }}" method="post">
        @csrf
        @method('patch')
        <p>Редактировать тест</p>
        <div class="form-group">
            <p>Вопрос: </p>
            <input type="text" class="form-control" name="question" required value="{{ $test->question }}">
        </div>
        <div class="form-group">
            <div class="block-1">
                <p>Верные варианты ответа:</p>
                1 - <input type="checkbox" class="input" name="true_ans_1" value="1"><br>
                2 - <input type="checkbox" class="input" name="true_ans_2" value="2"><br>
                3 - <input type="checkbox" class="input" name="true_ans_3" value="3"><br>
                4 - <input type="checkbox" class="input" name="true_ans_4" value="4"><br>
                5 - <input type="checkbox" class="input" name="true_ans_5" value="5"><br>
            </div>
            <div class="block-2">
                <p>Варианты ответа: </p>
                <input type="text" class="form-control" name="answ_1" required value="{{ $test->answer_1 }}">
                <input type="text" class="form-control" name="answ_2" required value="{{ $test->answer_2 }}">
                <input type="text" class="form-control" name="answ_3" required value="{{ $test->answer_3 }}">
                <input type="text" class="form-control" name="answ_4" required value="{{ $test->answer_4 }}">
                <input type="text" class="form-control" name="answ_5" required value="{{ $test->answer_5 }}">
            </div>
        </div>

        <input type="submit" value="Отредактировать" class="btn btn-success">
    </form>

@endsection

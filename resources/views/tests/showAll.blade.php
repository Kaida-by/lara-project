@extends('layouts.layout', ['title' => 'Тема'])
@section('content')
    <div class="row">
        <div class="col-12">
            @if($test_arr)
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
                        @if($access)
                            <div class="block-edit">
                                <a href="{{ route('test.edit', ['id' => $test->test_id]) }}" class="btn btn-outline-warning">Редактировать</a>
                                <form action="{{ route('test.destroy', ['id' => $test->test_id]) }}" method="post"
                                      onsubmit="if (confirm('Вы точно хотите удалить этот тест?')) { return true } else { return false }">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                Упс, тесты пока не придумали :(
            @endif

        </div>
    </div>
@endsection

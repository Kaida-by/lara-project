<?php

namespace App\Http\Controllers;

use App\Course;
use App\Test;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index($id)
    {
        $topic = Topic::find($id);
        $tests = Test::all();

        $test_arr = [];
        foreach ($tests as $test) {
            if ($test->topics_id == $id) {
                $test_arr[] = $test;
            }
        }

        $topic_id = new Topic();
        $resultTopics = $topic_id->checkTopicUser(Auth::user(), $topic);
        if ($resultTopics) {
            $id = $topic->courses_id;
            return redirect()->route('topic.index', compact('id'))->with('success', 'Вы уже прошли этот тест');
        }

        $course = Course::find($topic->courses_id);
        $access = false;
        if ($course->teacher_id == Auth::id()) {
            $access = true;
        }

        return view('tests.index', compact('test_arr', 'topic', 'access'));
    }

    public function processingResponses(Request $request, $id)
    {
        $tests = Test::all();

        $topic = Topic::find($id);
        $topic_id = new Topic();
        $resultTopics = $topic_id->checkTopicUser(Auth::user(), $topic);
        if ($resultTopics) {
            $id = $topic->courses_id;
            return redirect()->route('topic.index', compact('id'))->with('success', 'Вы уже прошли этот тест');
        }

        foreach ($tests as $key => $test) {
            if ($test->topics_id == $id) {
                $ar[] =
                    [
                        $key . '0' => $request->input('ans' . $test->test_id . '0'),
                        $key . '1' => $request->input('ans' . $test->test_id . '1'),
                        $key . '2' => $request->input('ans' . $test->test_id . '2'),
                        $key . '3' => $request->input('ans' . $test->test_id . '3'),
                        $key . '4' => $request->input('ans' . $test->test_id . '4')
                    ];

                $true_ans[] = $test->true;
            }
        }

        for ($i = 0; $i < count($ar); $i++) {
            $str_arr[] = implode($ar[$i]);
        }

        $score_pr = 0;
        foreach ($str_arr as $resp_user) {
            foreach ($true_ans as $true) {
                if ($resp_user == $true) {
                    $score_pr++;
                }
            }
        }

        $score = $score_pr / count($ar) * 100;
        $topic = Topic::find($id);
        $topic->users()->attach(Auth::id(), ['score' => $score]);

        return view('tests.show', compact('score'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create($id)
    {
        $topic = Topic::find($id);

        return view('tests.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $test = new Test();
        $topic = Topic::find($id);
        $test->topics_id = $topic->topic_id;
        $test->question = $request->question;
        $test->answer_1 = $request->answ_1;
        $test->answer_2 = $request->answ_2;
        $test->answer_3 = $request->answ_3;
        $test->answer_4 = $request->answ_4;
        $test->answer_5 = $request->answ_5;

        for ($i = 1; $i <=5; $i++) {
            $req[] = $request->input('true_ans_' . $i);
            $ans[] = $request->input('answ_' . $i);
        }

        foreach ($req as $val_1) {
            foreach ($ans as $key_2 => $val_2) {
                if ($val_1 - 1 == $key_2) {
                    $test->true .= $val_2;
                }
            }
        }

        $test->save();

        return redirect()->route('topic.show', compact('id'))->with('success', 'Тест успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showAll($id)
    {
        $topic = Topic::find($id);
        $tests = Test::all();

        $test_arr = [];
        foreach ($tests as $test) {
            if ($test->topics_id == $id) {
                $test_arr[] = $test;
            }
        }

        $course = Course::find($topic->courses_id);
        $access = false;
        if ($course->teacher_id == Auth::id()) {
            $access = true;
        }

        return view('tests.showAll', compact('test_arr', 'topic', 'access'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $test = Test::find($id);
        $topic = Topic::find($test->topics_id);
        $course = Course::find($topic->courses_id);

        if ($course->teacher_id != Auth::id()) {
            return redirect()->route('topic.index')->with('success', 'Вы не можете редактировать данный тест!');
        }

        return view('tests.edit', compact('topic', 'test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $test = Test::find($id);
        $test->question = $request->question;
        $test->answer_1 = $request->answ_1;
        $test->answer_2 = $request->answ_2;
        $test->answer_3 = $request->answ_3;
        $test->answer_4 = $request->answ_4;
        $test->answer_5 = $request->answ_5;

        for ($i = 1; $i <=5; $i++) {
            $req[] = $request->input('true_ans_' . $i);
            $ans[] = $request->input('answ_' . $i);
        }
        $test->true = '';
        foreach ($req as $val_1) {
            foreach ($ans as $key_2 => $val_2) {
                if ($val_1 - 1 == $key_2) {

                    $test->true .= $val_2;
                }
            }
        }
        $course_id = Topic::find($test->topics_id);

        $test->update();

        return redirect()->route('course.index')->with('success', 'Тест успешно отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        $topic = Topic::find($test->topics_id);
        $course = Course::find($topic->courses_id);

        if ($course->teacher_id != Auth::id()) {
            return redirect()->route('topic.index')->with('success', 'Вы не можете удалить данный тест!');
        }
        $test->delete();

        return redirect()->route('course.index')->with('success', 'Тест успешно удален!');

    }
}

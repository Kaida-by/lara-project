<?php

namespace App\Http\Controllers;

use App\Course;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        if ($request->search) {
            $courses = Course::join('users', 'teacher_id', '=', 'users.id')
                ->where('title', 'like', '%' .  $request->search  . '%')
                ->orWhere('name', 'like', '%' .  $request->search  . '%')
                ->orderBy('courses.created_at', 'desc')
                ->get();

            return view('courses/index', compact('courses'));
        }

        $course = Course::find($id);
        $accessTopic = false;
        if ($course->teacher_id == Auth::id()) {
            $accessTopic = true;
        }

        $topics = Course::join('topics', 'course_id', '=', 'topics.courses_id')
            ->where('topics.courses_id', '=', $id)
            ->get();

        return view('topics.index', compact('topics', 'courses', 'accessTopic', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create($id)
    {
        $course = Course::find($id);
        return view('topics.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $topic = new Topic();
        $course = Course::find($id);
        $topic->courses_id = $course->course_id;
        $topic->title_top = $request->title;
        $topic->descr_top = $request->descr;
        $topic->deadline = $request->deadline;
        $topic->active = $request->access ?? '';
        $topic->save();

        return redirect()->route('topic.index', compact('id'))->with('success', 'Тема успешно добавлена!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $topic = Topic::find($id);

        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $topic = Topic::find($id);
        $course = Course::find($topic->courses_id);

        if ($course->teacher_id != Auth::user()->id) {
            return redirect()->route('course.index')->with('success', 'Вы не можете редактировать данный курс!');
        }

        return view('topics.edit', compact('course', 'topic'));
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
        $topic = Topic::find($id);
        $topic->title_top = $request->title;
        $topic->descr_top = $request->descr;
        $topic->deadline = $request->deadline;
        $topic->active = $request->access ?? '';
        $id = $topic->topic_id;
        $topic->update();

        return redirect()->route('topic.show', compact('id'))->with('success', 'Тема успешно отредактирована!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $course = Course::find($topic->courses_id);

        if ($course->teacher_id != Auth::user()->id) {
            return redirect()->route('course.index')->withErrors('Вы не можете удалить данную тему!');
        }
        $topic->delete();

        return redirect()->route('course.index')->with('success', 'Тема успешно удалена!');
    }
}

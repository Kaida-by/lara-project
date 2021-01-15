<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $courses = Course::join('users', 'teacher_id', '=', 'users.id')
                ->where('title', 'like', '%' .  $request->search  . '%')
                ->orWhere('name', 'like', '%' .  $request->search  . '%')
                ->orderBy('courses.created_at', 'desc')
                ->get();

            return view('courses.index', compact('courses'));
        }

        $courses = Course::join('users', 'teacher_id', '=', 'users.id')
            ->orderBy('courses.created_at', 'desc')
            ->paginate(4);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->permissionLevel >= 1) {
            return view('courses.create');
        }
        return redirect()->route('course.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $course = new Course();
        $course->title = $request->title;
        $course->descr = $request->descr;
        $course->teacher_id = Auth::user()->id;
        $course->start = $request->start;
        $course->end = $request->end;
        $course->background = $request->background;

        $course_id = Course::find($course->course_id);
        $course_id->users()->attach(Auth::user()->id);

        return redirect()->route('course.index')->with('success', 'Курс успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $course_id = new Course();
        $resultCourses = $course_id->checkCourseUser(Auth::user(), Course::find($id));

        $course = Course::join('users', 'teacher_id', '=', 'users.id')
            ->find($id);

        $topics = Course::join('topics', 'course_id', '=', 'topics.courses_id')
            ->where('topics.courses_id', '=', $id)
            ->get();

        return view('courses.show', compact('course', 'topics', 'resultCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $course = Course::find($id);
        if ($course->teacher_id != Auth::user()->id) {
            return redirect()->route('course.index')->withErrors('Вы не можете редактировать данный курс!');
        }

        return view('courses.edit', compact('course'));

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
        $course = Course::find($id);
        $course->title = $request->title;
        $course->descr = $request->descr;
        $course->start = $request->start;
        $course->end = $request->end;
        $course->background = $request->background;
        $id = $course->course_id;
        $course->update();

        return redirect()->route('course.show', compact('id'))->with('success', 'Курс успешно отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if ($course->teacher_id != Auth::user()->id) {
            return redirect()->route('course.index')->withErrors('Вы не можете удалить данный курс!');
        }
        $course->delete();

        return redirect()->route('course.index')->with('success', 'Курс успешно удален!');
    }

    public function record($id)
    {
        $course = Course::find($id);

        $course_id = new Course();
        $resultCourses = $course_id->checkCourseUser(Auth::user(), $course);

        if ($resultCourses) {
            return redirect()->route('course.show', compact('id'))->with('success', 'Вы успешно авторизовались!');
        }

        return view('courses.record', compact('course'));
    }

    public function recordAct(Request $request, $id)
    {
        $course_id = Course::find($id);
        if ($request->eight == 6) {
            $course_id->users()->attach(Auth::user()->id);

            return redirect()->route('course.show', compact('id'))->with('success', 'Вы успешно записалиь на курс!');
        } else {
            return redirect()->route('course.show', compact('id'))->with('success', 'Что-то пошло не так...');
        }
    }
}

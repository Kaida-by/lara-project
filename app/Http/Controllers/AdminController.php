<?php

namespace App\Http\Controllers;

use App\Course;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $user = \App\User::find(Auth::id());
        return view('admins.index', compact('user'));
    }

    public function edit()
    {
        $user = \App\User::find(Auth::id());
        return view('admins.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \App\User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $user->img = $url;
        }

        if ($request->password2 == $request->password3) {
            if (password_verify($request->password, $user->password)) {
                $user->password = password_hash($request->password2, PASSWORD_DEFAULT);
            } else {
                return redirect()->route('admin.edit', compact('user'))->with('success', 'Вы неверно ввели пароль!');
            }
        } else {
            return redirect()->route('admin.edit', compact('user'))->with('success', 'Ваши новые пароли не совпадают друг с другом');
        }
        $user->update();

        return redirect()->route('admin.index')->with('success', 'Профиль успешно отредактирован!');
    }

    public function showCourses()
    {
        $user = Auth::user();
        $courses = Course::all();
        $course = $user->showCourses(Auth::user());

        $resultCourse = [];
        foreach ($courses as $cour) {
            foreach ($course as $key) {
                if ($cour->course_id == $key) {
                    $resultCourse[] = $cour;
                }
            }
        }

        return view('admins.showCourses', compact('resultCourse'));
    }

    public function showPerformance()
    {
        $user = Auth::user();
        $performance = $user->showPerformance(Auth::user());
        $count = 0;
        $overallMark = 0;
        foreach ($performance as $grade) {
            $overallMark += $grade;
            $count++;
        }
        if (0 == $count) {
            return redirect()->route('admin.index')->with('success', 'Вы еще не проходили тесты');
        }
        $resultTests = $overallMark / $count;

        $resultTopic = [];
        $topics = Topic::all();
        foreach ($topics as $topic) {
            foreach ($performance as $key=>$item) {
                if ($topic->topic_id == $key) {
                    $resultTopic[$item] = $topic;
                }
            }
        }

        return view('admins.showPerformance', compact('performance', 'resultTests', 'resultTopic'));
    }

}

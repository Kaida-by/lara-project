<?php

namespace App\Http\Controllers;

use Acaronlex\LaravelCalendar\Calendar;
use App\Course;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = [];
        $calendar = new Calendar();
        $courses = Course::all();

        foreach ($courses as $course) {
            $events[] = Calendar::event(
                $course->title, //event title
                true, //full day event?
                $course->start, //start time (you can also use Carbon instead of DateTime)
                $course->end, //end time (you can also use Carbon instead of DateTime)
                'stringEventId', //optionally, you can specify an event ID
                [
                    'color' => '#444444',
                    'textColor' => '#ffffff'
                ]
            );
        }

        $calendar->addEvents($events)
            ->setOptions([
                'locale' => 'local',
                'firstDay' => 0,
                'displayEventTime' => true,
                'selectable' => true,
                'initialView' => 'timeGridWeek',
                'headerToolbar' => [
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
                ]
            ]);
        $calendar->setId('1');
        $calendar->setCallbacks([
            'select' => 'function(selectionInfo){}',
            'eventClick' => 'function(event){}'
        ]);

        return view('admins.calendar', compact('calendar'));
    }
}

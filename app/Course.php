<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'course_user', 'course_id');
    }

    public function checkCourseUser($auth, $courses)
    {
        $resultCourses = false;
        if ($auth) {
            foreach ($courses->users as $cour) {
                $arrUserCour['user_id'] = $cour->pivot->user_id;
                $arrUserCour['course_id'] = $cour->pivot->course_id;
                if ($auth->id == $arrUserCour['user_id'] &&
                    $courses->course_id == $arrUserCour['course_id']) {
                    $resultCourses = true;
                }
            }
        }
        return $resultCourses;
    }
}

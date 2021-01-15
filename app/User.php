<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_user', 'user_id', 'course_id');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_user', 'user_id', 'topic_id')->withPivot('start_time', 'score');
    }

    public function showCourses($auth)
    {
        $courses = [];
        foreach ($auth->courses as $key => $cours) {
            $courses[] = $cours->course_id;
        }
        return $courses;
    }

    public function showPerformance($auth)
    {
        $performance = [];
        foreach ($auth->topics as $key => $topic) {
            $performance[$topic->topic_id] = $topic->pivot->score;
        }
        return $performance;
    }
}

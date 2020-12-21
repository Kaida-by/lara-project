<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

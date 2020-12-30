<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $primaryKey = 'topic_id';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

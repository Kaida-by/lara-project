<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $primaryKey = 'topic_id';

    public function users()
    {
        return $this->belongsToMany('App\User', 'topic_user', 'topic_id');
    }

    public function checkTopicUser($auth, $topics)
    {
        $resultTopics = false;
        if ($auth) {
            foreach ($topics->users as $top) {
                $arrUserTop['user_id'] = $top->pivot->user_id;
                $arrUserTop['topic_id'] = $top->pivot->topic_id;
                if ($auth->id == $arrUserTop['user_id'] &&
                    $topics->topic_id == $arrUserTop['topic_id']) {
                    $resultTopics = true;
                }
            }
        }
        return $resultTopics;
    }
}

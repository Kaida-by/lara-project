<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $primaryKey = 'topic_id';

    public function users()
    {
        return $this->belongsToMany('App\User', 'topic_user', 'topic_id')->withPivot('start_time', 'score');
    }

    public function checkTopicUser($auth, $topics)
    {
        $resultTopics = ['access' => 'Еще не проходил', 'topic' => ''];
        if ($auth) {
            foreach ($topics->users as $top) {
                $arrUserTop['user_id'] = $top->pivot->user_id;
                $arrUserTop['topic_id'] = $top->pivot->topic_id;
                $arrUserTop['start_time'] = strtotime($top->pivot->start_time);
                $score['score'] = $top->pivot->score;

                if ($auth->id == $arrUserTop['user_id'] &&
                    $topics->topic_id == $arrUserTop['topic_id'] &&
                    strtotime(Carbon::now()) <= $arrUserTop['start_time'] &&
                    $score['score'] === null) {
                    $resultTopics = ['access' => 'Доступ пока что есть', 'topic' => $arrUserTop['start_time']];

                } elseif ($auth->id == $arrUserTop['user_id'] &&
                    $topics->topic_id == $arrUserTop['topic_id'] &&
                    $score['score'] !== null) {
                    $resultTopics = ['access' => 'Тест пройден', 'topic' => $arrUserTop['start_time']];
                }
            }
        }

        return $resultTopics;
    }
}

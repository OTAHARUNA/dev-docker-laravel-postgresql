<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //
    protected $fillable = ['posts'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    //followerIds（）で取得したフォローしているユーザIDをControllerを介して取得したと仮定してそのデータを引数で渡す

    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }
}

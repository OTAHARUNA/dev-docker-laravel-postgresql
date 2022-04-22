<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //

    protected $primaryKey = [
        'follow_id',
        'follower_id'
    ];
    protected $fillable = [
        'follow_id',
        'follower_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

    //フォローしているユーザーのID取得

    public function followerIds(Int $user_id)
    {
        return $this->where('follower_id', $user_id)->get('follow_id');
    }

}

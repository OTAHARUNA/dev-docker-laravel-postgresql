<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','bio','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $rememberTokenName = false;

    //リレーション設定
    public function posts() {
        return $this->hasMany('App\Post');
    }

    //フォロワーもApp\Userであること認識する必要あり。この2つの方法で1つのモデルApp\Userのみ必要
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow_id', 'follower_id');
    }
    //あるユーザのフォロー中のユーザを取得する： $user->followings
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'follow_id');
    }

    //$user_id=クリックしたid


     // フォローする 取得してアタッチする。 レコード追加
    public function follow($user_id)
    {
        return $this->followings()->attach($user_id);
    }

    // フォロー解除する　取得して該当削除　レコード削除(ユーザーから役割を引き離す)
    public function unfollow($user_id)
    {
        return $this->followings()->detach($user_id);
    }

    // フォローしているか following:ユーザーの取得する　フォローしているid=ログインしているID
    public function isFollowing($user_id)
    {
        return (boolean) $this->followings()->where('follow_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('follower_id', $user_id)->exists();
    }

    public function updateProfile(Array $params)
    {
        if (isset($params['image'])) {
            $file_name = $params['image']->store('public/image/');

            $this::where('id', $this->id)
                ->update([
                    'username'          => $params['username'],
                    'image' => basename($file_name),
                    'mail'         => $params['mail'],
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'username'          => $params['username'],
                    'mail'         => $params['mail'],
                ]);
        }

        return;
    }

}

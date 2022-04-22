<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;
use App\Post;

class UsersController extends Controller
{
    //
    public function profile(){
        $users = Auth::user()->get();
        return view('users.profile',compact('users'));
    }
//ユーザーの一覧表示＆ユーザー検索してフォローする・フォローしない決める
    public function index(Request $request){
    //Userの全データを取得
      //  $users = Auth::user()->followings()->get();
        $users = Auth::user()->get();

        $word = $request->input('word');

        $query = User::query();
        if(!empty($word)){
            $query->where('username','LIKE',"%{$word}%");
        }
        $users =$query->get();

        return view('users.search',compact('users','word'));
    }


    //編集機能edit ここから
    public function edit(User $users)
    {
        return view('users.edit', ['user' => $user]);
    }
    //画像アップデート
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        //左view側のname=''
        if(isset($request->newpassword)){
            $validator = Validator::make($data, [
                'username'          => ['required', 'string','min:4' , 'max:12'],Rule::unique('users')->ignore($user->id),
                'mail'         => ['required', 'string', 'email', 'min:4' , 'max:30'], Rule::unique('users')->ignore($user->id),
                'nowpassword' => ['min:4' , 'max:12' , function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('現在のパスワードが違います');
                        }
                    }
                ],
                'newpassword' => ['string','min:4', 'max:12' , 'confirmed','different:nowpassword'],
                'image'=>['file','image','mimes:jpeg,png,jpg,bmb'],
            ],
            [
                'required' => ':attributeを入力してください',
                'email.email' => '正しい:attributeを入力してください',
            ],
            [
                'username' => '名前',
                'email' => 'メールアドレス'
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }}else{
            $validator = Validator::make($data, [
                'username'          => ['required', 'string', 'max:255'],Rule::unique('users')->ignore($user->id),
                'mail'         => ['required', 'string', 'email', 'max:255'], Rule::unique('users')->ignore($user->id),
                'image'=>['file','image','mimes:jpeg,png,jpg,bmb'],
            ],
            [
                'required' => ':attributeを入力してください',
                'email.email' => '正しい:attributeを入力してください',
            ],
            [
                'username' => '名前',
                'email' => 'メールアドレス',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        }

        $validator->validate();

        $upload_image = $request->file('image');

        if($upload_image){
            //保存するファイルに名前をつける
            $fileName = $upload_image->getClientOriginalName();
            $upload_image->storeAs('uploads',$fileName,"public");

         }else{
        //画像が登録されなかった時はから文字をいれる
           $name = "";
         }
        //
        if (isset($request->newpassword)) {
            # code...
            \App\User::where('id', $user->id)
                ->update([
                    'username'          => $request['username'],
                    'mail'         => $request['mail'],
                    'password'     => bcrypt($request->get('newpassword')),
                    'bio'             =>$request['bio'],
            ]);
            }else{
                \App\User::where('id', $user->id)
                ->update([
                    'username'          => $request['username'],
                    'mail'         => $request['mail'],
                    'bio'             =>$request['bio'],
            ]);

        }
        if(isset($upload_image)){
            \App\User::where('id', $user->id)
                ->update([
                    'image' => $fileName,
                ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
            echo '間違ってます';
        }
        return redirect ('/top')->with('更新出来ました');
    }




    //フォローした・されている人のプロフィール画面　show ルーティング等画面推移はできている★ここ完成
    public function show($id)
    {
        //ユーザー情報全て取得
        $login_user = Auth::user();
        //フォローしているID ログインしているユーザー情報

        $is_following = $login_user->isFollowing($id);
        $is_followed = $login_user->isFollowed($id);

        $timelines = Post::where('user_id', $id)->orderBy('created_at', 'DESC')->get();

        $myuser = \App\User::find($id);


        return view('users.show', [
            'user'           => $login_user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'myuser'          => $myuser,
        ]);
    }


    //フォロー機能
    public function follow($id)
    {
        //ログインしている人の情報
        $follower = Auth::user();

        $is_following = $follower->isFollowing($id);
        if(!$is_following){
            //フォローしていなければフォローする
            $follower->follow($id);
            return back();
        }
    }
    //フォロー解除
    public function unfollow($id)
    {
        $follower = Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }

}

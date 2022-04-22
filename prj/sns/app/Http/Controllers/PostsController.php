<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;
use Auth;

class PostsController extends Controller
{
    //
  //  public function index(){
  //      return view('posts.index');
  //  }

  //一覧表示
    public function index(){
    //Userの全データを取得 $posts = Post::orderBy('created_at', 'desc')->get();
        $id = \Auth::id();
        $users = Auth::user()->get();
    //ログインしているＩＤ    dd($id);
        $follow = DB::table('follows')->where('follower_id',$id)->pluck('follow_id');
    //フォローしている人のＩＤ    dd($follow);
        $follower = DB::table('follows')->where('follow_id',$id)->pluck('follower_id');
    //OKフォローされている（自分をフォローしている）ＩＤ dd($follower); 12が出せている
        $posts = Post::whereIn('user_id',$follow)->orwhere('user_id',$id)->orderBy('id','desc')->get();

        //
        $followers =Post::whereIn('user_id',$follower)->orwhere('user_id',$id)->orderBy('id','desc')->get();
        //dd($followers);
    //    $posts = DB::table('posts')->whereIn('user_id',$follow)->get();
    //フォローしているユーザー/ログインＩＤの投稿    dd($posts);
 //userでのフォローしているひとの取得       dd(Auth::user()->followings()->get());

        //以下、Id順に投稿並びかえる→投稿日順に変更後ほど。ページネーションは9つの投稿取得
 //      $posts = Post::orderBy('id','desc')->paginate(9);\

        return view('posts.index',compact('users','posts','followers'));
    }

    //以下、要確認


    //作成・保存まで　投稿処理
    public function store(Request $request, Post $posts)
    {
        //今ログインしている人
        $user = \Auth::user();
        $tweet = $request->input('text');

        //今ログインしている人のpostsに入れる
        $posts = $user->posts()->create([
            'posts' => $tweet,
        ]);
        $posts->save();
        return back();
    }

    //編集機能edit
    public function edit(Request $request, Post $posts,$id)
    {
        //ユーザーのクリックした投稿表示
        $tweet = \App\Post::find($id);
        $tweet->posts = $request->input('texts');
        $tweet->update();
        return back();
    }


    //削除機能
    public function destroy($id) {
      $posts = \App\Post::find($id);
      //ログインしているＩＤとクリックしたユーザーＩＤ一緒？
      if (\Auth::id() == $posts->user->id) {
        $posts->delete();
      }

        return back();
    }

}

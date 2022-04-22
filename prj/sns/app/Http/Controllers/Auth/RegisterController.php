<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     //自動的にリダイレクトとされる機能
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'min:4' , 'max:12'],
            'mail' => ['required', 'string', 'email', 'min:4' , 'max:30', 'unique:users'],
            'password' => ['required','string','min:4', 'max:12','confirmed', 'unique:users'],
        ],
        [
            'required' => ':attributeを入力してください',
            'email.email' => '正しい:attributeを入力してください',
        ],
        [
            'username' => '名前',
            'email' => 'メールアドレス'
        ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(validator($data)){
                $this->validator($data);
                $this->create($data);
                $request->flash();
                return redirect('added');
            }
            echo '登録条件に合っていません。';

        }
        return view('auth.register');
    }

    public function added(Request $request){
        $username = $request->old('username');
        return view('auth.added');
    }
}

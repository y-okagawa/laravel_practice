<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use DB;
use Validator;
use Redirect;
use Hash;
use Exception;
use Log;
// モデル
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        Log::INFO(\Request::server('HTTP_USER_AGENT'));
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required',
        ];

        $messages = array(
            'email.required' => 'メールアドレスを正しく入力してください。',
            'password.required' => 'パスワードを正しく入力してください。',
            'password_confirmation.required' => 'パスワードが一致しません。',
            'phone.required' => '電話番号を正しく入力してください。',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $user = new User;
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->phone = $request->get('phone');
            $user->save();
            return Redirect::route('users.index')
                ->with('success', '会員登録しました。');
        }else{
            return Redirect::route('users.create')
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->email = $request->email;
        $user->phone = $request->phone;

        $rules = [
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ];

        $messages = array(
            'email.required' => 'メールアドレスを正しく入力してください。',
            'phone.required' => '電話番号を正しく入力してください。',
        );
        try {
            $validator = Validator::make($request->all(), $rules, $messages);
            if (!$validator->passes()) {
                throw new Exception($validator->messages());
            }
            DB::beginTransaction();
            $user->save();
            DB::commit();
        } catch(\Illuminate\Contracts\Validation\ValidationException $e) {
            DB::rollback();
            debug($e->getMessage());
            // Log::notice($e->messages());
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            debug($e->getMessage());
        }
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * 展示所有的用户信息页面
     * @return [type] [description]
     */
    public function index()
    {
    	$users = User::all();
    	return view('users.index',compact('users'));
    }

    /**
     * 展示个人页面
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show(User $user)
    {
    	return view('users.show',compact('user'));
    }

    /**
     * 展示新增页面
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function create(User $user)
    {
    	return view('users.create',compact('user'));
    }

    /**
     * 注册新用户
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	//verify data,if return false
    	$verify = $this->validate($request, [
    		'name' 		=> 'required|max:50',
    		'email'		=> 'required|email|max:255|unique:users',
    		'password' 	=> 'required|min:6|confirmed'
    	]);
    	//save data
    	$user = User::create([
    		'name'	=> $request->name,
    		'email'	=> $request->email,
    		'password' => bcrypt($request->password),
    	]);

        Auth::login($user);
    	session()->flash('success','signup successful');
    	return redirect()->route('users.show',[$user]);
    }

    /**
     * 展示编辑页面
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function edit(User $user)
    {
    	return view('users.edit',compact('user'));
    }

    /**
     * 更新用户信息
     * @param  User    $user    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(User $user, Request $request)
    {
    	$this->validate($request,[
    		'name' 	=> 'required|max:50',
    		'password' => 'nullable|confirmed|min:6',
    	]);

    	//确定更新数据
    	$data = [];
    	$data['name'] = $request->name;
    	if (isset($request->password)) {
    		$data['password'] = $request->password;
    	}

    	//更新
    	$user->update($data);

    	return redirect()->route('users.show',$user->id);
    }

    /**
     * 删除某个用户
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function destroy(User $user)
    {
    	$user->destroy();
    	return back();
    }




}

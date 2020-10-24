<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\UserRequest;

use App\User;

use View;

class UserController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$users=User::select()
			->whereNotNull('profile_id')
			->where('name', 'LIKE', '%'.$filter.'%')
			->whereNull('is_member')
			->orderBy('name')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.user.index', array('users'=>$users));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		$validator = Validator::make($request->all(), [
			'email'=>'required|email|unique:users,email',
			'password'=>'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withInput($request->all())
				->withErrors($validator);
		}

		$user = User::Create($request->all());

		\App\Util\RegisterLog::add($user);
		return redirect('admin/user/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::FindOrFail($id);

        return view('admin.user.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request, $id)
	{
		$user = User::FindOrFail($id);
		$user->fill($request->all());
		$user->active = $request->active;
		$user->save();

		\App\Util\RegisterLog::add($user);
		return redirect('admin/user/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::FindOrFail($id);
		$user->delete();

		\App\Util\RegisterLog::add($user);
		return redirect('admin/user/');
	}

}

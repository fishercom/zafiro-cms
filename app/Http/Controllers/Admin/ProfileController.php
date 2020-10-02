<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\ProfileRequest;

use App\Profile;
use App\AdmPermission;

use View;

class ProfileController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$profiles = Profile::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->orderBy('id')
			->Paginate();

		View::share('filter', $filter);
        
        return view('admin.profile.index', array('profiles'=>$profiles));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$profile=new Profile(Request::all());
		$profile->active = '1';

        return view('admin.profile.create', compact('profile'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProfileRequest $request)
	{
		$profile = Profile::Create($request->all());
		$events = $request->events;
		foreach ($events as $event_id) {
			AdmPermission::create(['event_id'=>$event_id, 'profile_id'=>$profile->id]);
		}

		\App\Util\RegisterLog::add($profile);
		return redirect('admin/profile/');
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
		$profile = Profile::FindOrFail($id);

        return view('admin.profile.edit', compact('profile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProfileRequest $request, $id)
	{
		$profile = Profile::FindOrFail($id);
		$profile->fill($request->all());
		$profile->active = $request->active;
		$profile->save();

		$events = $request->events;
		if($events){
			AdmPermission::where('profile_id', $profile->id)->delete();
			foreach ($events as $event_id) {
				AdmPermission::create(['event_id'=>$event_id, 'profile_id'=>$profile->id]);
			}
		}

		\App\Util\RegisterLog::add($profile);
		return redirect('admin/profile/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$profile = Profile::FindOrFail($id);
		$profile->delete();

		\App\Util\RegisterLog::add($profile);
		return redirect('admin/profile/');
	}

}

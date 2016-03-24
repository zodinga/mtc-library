<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', Input::get('limit', 30));

		$search_criteria = array(
			'role' => Input::get('role', null),
			'search' => Input::get('search', null),
			'status' => Input::get('status', null),
			'limit' => $limit
			);
		$users = User::withTrashed()
			->where(function($query){
				if( Input::get('role', null) != null )
					$query->where('role', '=', Input::get('role', null));
				
				if( Input::get('search', null) != null ) {
					$query->where(function($q1){
						$q1->where('username', 'LIKE', "%".Input::get('search')."%")
							->orWhere('fullname', 'LIKE', "%".Input::get('search')."%");
					});
				}

				if( Input::get('status', null) != null ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status') == 'active' ) {
						$query->where('deleted_at', '=', null);
					}
				}
			})
			->orderBy('username', 'asc')->paginate($limit);

		$index = $users->getCurrentPage() > 1?$users->getCurrentPage()*$users->getPerPage():1;

		return View::make('user.list', array(
			'limit' => $limit,
			'users' => $users,
			'types'=>$this->types(), 
			'limit_sizes'=>$this->limitSizes(), 
			'search_criteria'=>$search_criteria, 
			'index'=>$index
			));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input_data = Input::all();
		
		$rules = array(
			'username' => 'required|unique:users',
			'password' => 'required',
			'fullname' => 'required',
			'role' => 'required',
			'picture' => 'image'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('user.create')->withErrors($validator)->withInput();
		
		$user = new User();
		$user->username = $input_data['username'];
		$user->password = Hash::make($input_data['password']);
		$user->fullname = $input_data['fullname'];
		$user->role = $input_data['role'];
		$user->avatar = 'avatar/default-white.png';
		$user->save();

		if(Input::hasFile('picture')) {
			$picture = Input::file('picture');
			$filename = 'user-'.$user->id . '.' . $picture->getClientOriginalExtension();
			$picture->move(public_path() . '/avatar/', $filename);
			$user->avatar = 'avatar/' . $filename;
			$user->save();
		}

		return Redirect::route("user.index")->with('success','New user created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		dd('...');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('user.edit', array('user'=>User::find($id)));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input_data = Input::all();
		$user = User::find($id);
		
		$rules = array(
			'username' => 'required|unique:users,username,' . $user->id . ',id',
			'fullname' => 'required',
			'role' => 'required',
			'picture' => 'image'
			);

		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('user.edit', array($user->id))->withErrors($validator)->withInput();
		
		$user->username = $input_data['username'];
		
		if($input_data['password'] != '')
			$user->password = Hash::make($input_data['password']);
		
		$user->fullname = $input_data['fullname'];
		$user->role = $input_data['role'];

		if(Input::hasFile('picture')) {
			$picture = Input::file('picture');
			$filename = 'user-'.$user->id .'-'. uniqid() . '.' . $picture->getClientOriginalExtension();
			$picture->move(public_path() . '/avatar/', $filename);
			$user->avatar = 'avatar/' . $filename;
		}

		if(Input::get('remove_picture', null) == 1) {
			$user->avatar = 'avatar/default-white.png';
		}
		
		$user->save();

		return Redirect::route("user.edit", array($user->id))->with('success','User updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$restore = Input::get('restore', null);
		$delete = Input::get('delete', null);
		$forceDelete = Input::get('force', null);

		$user = User::withTrashed()->find($id);

		if($user) {
			if($delete) {
				$user->delete();
				return Redirect::route("user.index")->with('success',"Library user was deleted.");
			}
			elseif($restore) {
				$user->restore();
				return Redirect::route("user.index")->with('success',"Library user was restored.");
			}
			elseif($forceDelete) {
				$user->forceDelete();
				return Redirect::route("user.index")->with('success',"Library user was deleted permanently.");
			}
		}
		else {
			return Redirect::route("user.index")->with('danger',"Delete failed. User not found.");
		}
	}

}
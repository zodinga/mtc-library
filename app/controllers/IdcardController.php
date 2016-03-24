<?php

class IdcardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', Input::get('limit', 30));

		$search_criteria = array(
			'type' => Input::get('type', null),
			'search' => Input::get('search', null),
			'validity' => Input::get('validity', null),
			'limit' => $limit
			);

		$idcards = Idcard::withTrashed()
					->where(function($query){
						if( Input::get('type', null) != null )
							$query->where('type', '=', Input::get('type', null));
						
						if( Input::get('search', null) != null ) {
							$query->where(function($q1){
								$q1->where('name', 'LIKE', "%".Input::get('search')."%")
									->orWhere('card_no', 'LIKE', "%".Input::get('search')."%");
							});
						}

						if( Input::get('validity', '') != '' ) {
							if( Input::get('validity') == 'valid' ) {
								$query->where(function($q2){
									$q2->where('type', '=', 'faculty')
										->orWhere('type', '=', 'staff')
										->orWhere('valid_upto', '>=', DB::raw("DATE(NOW())"));
								});
							}
							elseif( Input::get('validity') == 'expired' ) {
								$query->where('valid_upto', '<', DB::raw("DATE(NOW())"));
							}
						}
					})
					->orderBy('id', 'desc')
					->paginate($limit);

		$index = $idcards->getCurrentPage() > 1?$idcards->getCurrentPage()*$idcards->getPerPage():1;

		return View::make('idcard.list', array(
			'idcards' => $idcards, 
			'limit'=>$limit, 
			'types'=>$this->types(), 
			'limit_sizes'=>$this->limitSizes(), 
			'search_criteria'=>$search_criteria, 
			'index'=>$index ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$district = get_setting('district');
		$district_code = get_setting('district_code');

		$regular_student = Idcard::where('type', '=', 'regular student')->orderBy('card_no', 'desc')->first();
		$short_course = Idcard::where('type', '=', 'short course')->orderBy('card_no', 'desc')->first();
		$faculty = Idcard::where('type', '=', 'faculty')->orderBy('card_no', 'desc')->first();
		$staff = Idcard::where('type', '=', 'staff')->orderBy('card_no', 'desc')->first();
		
		$idcard_data = array('card_type'=> Input::get('card_type', 'student'));

		if($regular_student == null)
			$idcard_data['rs'] = 'RS' . date('Y') . '0001';
		else {
			$idcard_data['rs'] = 'RS' . date('Y') . str_pad( ((int)substr($regular_student->card_no, 8, 4) + 1), 4, "0", STR_PAD_LEFT);
		}
		if($short_course == null)
			$idcard_data['sc'] = 'SC' . date('Y') . '0001';
		else {
			$idcard_data['sc'] = 'SC' . date('Y') . str_pad( ((int)substr($short_course->card_no, 8, 4) + 1), 4, "0", STR_PAD_LEFT);
		}
		if($faculty == null)
			$idcard_data['fa'] = 'FA' . date('Y') . '0001';
		else {
			$idcard_data['fa'] = 'FA' . date('Y') . str_pad( ((int)substr($faculty->card_no, 8, 4) + 1), 4, "0", STR_PAD_LEFT);
		}
		if($staff == null)
			$idcard_data['st'] = 'ST' . date('Y') . '0001';
		else {
			$idcard_data['st'] = 'ST' . date('Y') . str_pad( ((int)substr($staff->card_no, 8, 4) + 1), 4, "0", STR_PAD_LEFT);
		}
		

		return View::make('idcard.create.form')
			->with($idcard_data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input_data = Input::all();
		
		if($input_data['type'] == 'regular student' || $input_data['type'] == 'short course') {
			$rules = array(
				'name' => 'required',
				'session' => 'required',
				'date_of_issue' => 'required',
				'valid_upto' => 'required',
				'contact' => 'required',
				'present_address' => 'required',
				'permanent_address' => 'required',
				'picture' => 'required|image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'student'))->withErrors($validator)->withInput();
			
			$idcard = new Idcard();
			$idcard->card_no = $input_data['card_no'];
			$idcard->name = $input_data['name'];
			$idcard->blood_group = $input_data['blood_group'];
			$idcard->contact = $input_data['contact'];
			$idcard->type = $input_data['type'];
			$idcard->session = $input_data['session'];
			$idcard->present_address = $input_data['present_address'];
			$idcard->permanent_address = $input_data['permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['date_of_issue']));
			$idcard->valid_upto = date('Y-m-d', strtotime($input_data['valid_upto']));
			$idcard->save();

			if(Input::hasFile('picture')) {
				$picture = Input::file('picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Student Identity Card was created.');
		}
		else if($input_data['type'] == 'faculty') {
			$rules = array(
				'fa_name' => 'required',
				'fa_date_of_issue' => 'required',
				'fa_contact' => 'required',
				'fa_designation' => 'required',
				'fa_present_address' => 'required',
				'fa_permanent_address' => 'required',
				'fa_picture' => 'required|image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'faculty'))->withErrors($validator)->withInput();
			
			$idcard = new Idcard();
			$idcard->card_no = $input_data['fa_card_no'];
			$idcard->name = $input_data['fa_name'];
			$idcard->contact = $input_data['fa_contact'];
			$idcard->blood_group = $input_data['fa_blood_group'];
			$idcard->designation = $input_data['fa_designation'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['fa_present_address'];
			$idcard->permanent_address = $input_data['fa_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['fa_date_of_issue']));
			$idcard->save();

			if(Input::hasFile('fa_picture')) {
				$picture = Input::file('fa_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Faculty Identity Card was created.');
		}
		else if($input_data['type'] == 'staff') {
			$rules = array(
				'st_name' => 'required',
				'st_father_name' => 'required',
				'st_date_of_birth' => 'required',
				'st_id_mark' => 'required',
				'st_date_of_issue' => 'required',
				'st_contact' => 'required',
				'st_designation' => 'required',
				'st_present_address' => 'required',
				'st_permanent_address' => 'required',
				'st_picture' => 'required|image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'staff'))->withErrors($validator)->withInput();
			
			$idcard = new Idcard();
			$idcard->card_no = $input_data['st_card_no'];
			$idcard->name = $input_data['st_name'];
			$idcard->father_name = $input_data['st_father_name'];
			$idcard->id_mark = $input_data['st_id_mark'];
			$idcard->date_of_birth = $input_data['st_date_of_birth'];
			$idcard->contact = $input_data['st_contact'];
			$idcard->blood_group = $input_data['st_blood_group'];
			$idcard->designation = $input_data['st_designation'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['st_present_address'];
			$idcard->permanent_address = $input_data['st_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['st_date_of_issue']));
			$idcard->save();

			if(Input::hasFile('st_picture')) {
				$picture = Input::file('st_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Staff Identity Card was created.');
		}
		else if($input_data['type'] == 'temporary') {
			$rules = array(
				'tm_name' => 'required',
				'tm_date_of_issue' => 'required',
				'tm_valid_upto' => 'required',
				'tm_contact' => 'required',
				'tm_school' => 'required',
				'tm_present_address' => 'required',
				'tm_permanent_address' => 'required',
				'tm_picture' => 'image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'temporary'))->withErrors($validator)->withInput();
			
			$idcard = new Idcard();
			$idcard->card_no = $input_data['tm_card_no'];
			$idcard->name = $input_data['tm_name'];
			$idcard->name_of_school = $input_data['tm_school'];
			$idcard->contact = $input_data['tm_contact'];
			$idcard->blood_group = $input_data['tm_blood_group'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['tm_present_address'];
			$idcard->permanent_address = $input_data['tm_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['tm_date_of_issue']));
			$idcard->valid_upto = date('Y-m-d', strtotime($input_data['tm_valid_upto']));
			$idcard->save();

			if(Input::hasFile('tm_picture')) {
				$picture = Input::file('tm_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Temporary Identity Card was created.');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Redirect::route('idcard.edit', array($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$idcard = Idcard::find($id);
		return View::make('idcard.edit.form', array('idcard'=>$idcard));
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
		$idcard = Idcard::find($id);

		if($idcard->type == 'regular student' || $idcard->type == 'short course') {
			$rules = array(
				'name' => 'required',
				'session' => 'required',
				'date_of_issue' => 'required',
				'valid_upto' => 'required',
				'contact' => 'required',
				'present_address' => 'required',
				'permanent_address' => 'required',
				'picture' => 'image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'student'))->withErrors($validator)->withInput();
			
			$idcard->name = $input_data['name'];
			$idcard->contact = $input_data['contact'];
			$idcard->blood_group = $input_data['blood_group'];
			$idcard->session = $input_data['session'];
			$idcard->present_address = $input_data['present_address'];
			$idcard->permanent_address = $input_data['permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['date_of_issue']));
			$idcard->valid_upto = date('Y-m-d', strtotime($input_data['valid_upto']));
			$idcard->save();

			if(Input::hasFile('picture')) {
				$picture = Input::file('picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Student Identity Card was updated.');
		}
		elseif($idcard->type == 'faculty') {
			$rules = array(
				'fa_name' => 'required',
				'fa_date_of_issue' => 'required',
				'fa_contact' => 'required',
				'fa_designation' => 'required',
				'fa_present_address' => 'required',
				'fa_permanent_address' => 'required',
				'fa_picture' => 'image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.create', array('card_type'=>'faculty'))->withErrors($validator)->withInput();
			
			$idcard->name = $input_data['fa_name'];
			$idcard->contact = $input_data['fa_contact'];
			$idcard->blood_group = $input_data['fa_blood_group'];
			$idcard->designation = $input_data['fa_designation'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['fa_present_address'];
			$idcard->permanent_address = $input_data['fa_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['fa_date_of_issue']));
			$idcard->save();

			if(Input::hasFile('fa_picture')) {
				$picture = Input::file('fa_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Faculty Identity Card was updated.');
		}
		elseif($idcard->type == 'staff') {
			$rules = array(
				'st_name' => 'required',
				'st_father_name' => 'required',
				'st_date_of_birth' => 'required',
				'st_id_mark' => 'required',
				'st_date_of_issue' => 'required',
				'st_contact' => 'required',
				'st_designation' => 'required',
				'st_present_address' => 'required',
				'st_permanent_address' => 'required',
				'st_picture' => 'image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.edit', array($idcard->id, 'card_type'=>'staff'))->withErrors($validator)->withInput();
			
			$idcard->name = $input_data['st_name'];
			$idcard->father_name = $input_data['st_father_name'];
			$idcard->id_mark = $input_data['st_id_mark'];
			$idcard->date_of_birth = $input_data['st_date_of_birth'];
			$idcard->contact = $input_data['st_contact'];
			$idcard->blood_group = $input_data['st_blood_group'];
			$idcard->designation = $input_data['st_designation'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['st_present_address'];
			$idcard->permanent_address = $input_data['st_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['st_date_of_issue']));
			$idcard->save();

			if(Input::hasFile('st_picture')) {
				$picture = Input::file('st_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Staff Identity Card was updated.');
		}
		elseif($idcard->type == 'temporary') {
			$rules = array(
				'tm_name' => 'required',
				'tm_date_of_issue' => 'required',
				'tm_valid_upto' => 'required',
				'tm_contact' => 'required',
				'tm_school' => 'required',
				'tm_present_address' => 'required',
				'tm_permanent_address' => 'required',
				'tm_picture' => 'image'
				);
			$validator = Validator::make($input_data, $rules);

			if($validator->fails())
				return Redirect::route('idcard.edit', array($idcard->id, 'card_type'=>'temporary'))->withErrors($validator)->withInput();
			
			$idcard->name = $input_data['tm_name'];
			$idcard->name_of_school = $input_data['tm_school'];
			$idcard->contact = $input_data['tm_contact'];
			$idcard->blood_group = $input_data['tm_blood_group'];
			$idcard->type = $input_data['type'];
			$idcard->present_address = $input_data['tm_present_address'];
			$idcard->permanent_address = $input_data['tm_permanent_address'];
			$idcard->date_of_issue = date('Y-m-d', strtotime($input_data['tm_date_of_issue']));
			$idcard->valid_upto = date('Y-m-d', strtotime($input_data['tm_valid_upto']));
			$idcard->save();

			if(Input::hasFile('tm_picture')) {
				$picture = Input::file('tm_picture');
				$filename = $idcard->id . '.' . $picture->getClientOriginalExtension();
				$picture->move(public_path() . '/avatar/', $filename);
				$idcard->picture = 'avatar/' . $filename;
				$idcard->save();
			}

			return Redirect::route("idcard.edit", array($idcard->id))->with('success','Temporary Identity Card was updated.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * When ID Card is deleted, member is also deleted along with all member transactions history.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$restore = Input::get('restore', null);
		$delete = Input::get('delete', null);
		$forceDelete = Input::get('force', null);

		$idcard = Idcard::withTrashed()->find($id);

		if($idcard) {
			if($delete) {
				$idcard->delete();
				Member::withTrashed()->where('card_no','=',$idcard->card_no)->delete();
				return Redirect::route("idcard.index")->with('success',"Library ID Card was deleted.");
			}
			elseif($restore) {
				$idcard->restore();
				Member::withTrashed()->where('card_no','=',$idcard->card_no)->restore();
				return Redirect::route("idcard.index")->with('success',"Library ID Card was restored.");
			}
			elseif($forceDelete) {
				$idcard->forceDelete();
				Member::withTrashed()->where('card_no','=',$idcard->card_no)->forceDelete();
				return Redirect::route("idcard.index")->with('success',"Library ID Card was deleted permanently.");
			}
		}
		else {
			return Redirect::route("idcard.index")->with('danger',"Delete failed. ID Card not found.");
		}
	}

}
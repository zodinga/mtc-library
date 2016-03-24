<?php

class MemberController extends \BaseController {

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
			'status' => Input::get('status', null),
			'limit' => $limit
			);

		$members = Member::withTrashed()->join('idcards', function($join){
			$join->on('members.card_no','=','idcards.card_no');
		})
		->where(function($query){
			if( Input::get('type', null) != null )
				$query->where('type', '=', Input::get('type', null));
			
			if( Input::get('search', null) != null ) {
				$query->where(function($q1){
					$q1->where('name', 'LIKE', "%".Input::get('search')."%")
						->orWhere('members.card_no', 'LIKE', "%".Input::get('search')."%");
				});
			}

			if( Input::get('status', null) != null ) {
				if( Input::get('status') == 'valid' ) {
					$query->where(function($q2){
						$q2->where('type', '=', 'faculty')
							->orWhere('type', '=', 'staff')
							->orWhere('valid_upto', '>=', DB::raw("DATE(NOW())"));
					});
				}
				elseif( Input::get('status') == 'expired' ) {
					$query->where(function($q3){
						$q3->where('valid_upto', '<', DB::raw("DATE(NOW())"));
					});
				}
				elseif( Input::get('status') == 'deleted' ) {
					$query->where('members.deleted_at', '!=', "NULL");
				}
			}
		})
		->select('members.*', 
			'idcards.name', 'idcards.father_name', 'idcards.id_mark', 'idcards.date_of_birth',
			'idcards.blood_group', 'idcards.type', 'idcards.valid_upto', 'idcards.date_of_issue',
			'idcards.contact', 'idcards.picture', 'idcards.session', 'idcards.present_address', 
			'idcards.permanent_address', 'idcards.designation', 'idcards.name_of_school')
		->orderBy('members.card_no', 'asc')->paginate($limit);

		$index = $members->getCurrentPage() > 1?$members->getCurrentPage()*$members->getPerPage():1;

		return View::make('member.list', array(
			'limit' => $limit,
			'members' => $members,
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
		return View::make('member.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$card_no = Input::get('card_no', null);
		
		if($card_no == null)
			return Redirect::route("member.create")->with('danger','Library member was not created due to invalid card number.');
		else {
			$memberExists = Member::where('card_no','=',$card_no)->count();
			if($memberExists)
				return Redirect::route("member.create")->with('danger',"ID Card <a target='_blank' href='".url('member')."?search=".$card_no."'><b>".$card_no."</b></a> was already registered as library member. Please try different ID Card.");

			$member = new Member();
			$member->card_no = $card_no;
			$member->save();
			return Redirect::route("member.create")->with('success','New library member was created.');
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
		dd($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

		$member = Member::withTrashed()->find($id);

		if($member) {
			if($delete) {
				$member->delete();
				return Redirect::route("member.index")->with('success',"Library member was deleted.");
			}
			elseif($restore) {
				$member->restore();
				return Redirect::route("member.index")->with('success',"Library member was restored.");
			}
			elseif($forceDelete) {
				$member->forceDelete();
				return Redirect::route("member.index")->with('success',"Library member was deleted permanently.");
			}
		}
		else {
			return Redirect::route("member.index")->with('danger',"Delete failed. Member not found.");
		}
	}

	public function status($card_no)
	{
		$member = Member::with('idcards')->whereCardNo($card_no)->first();

		return Response::json($member);
	}

}
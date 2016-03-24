<?php

class viewprofileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('home.viewprofile')
			->with('display',0);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	

	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

	public function search()
	{
		$input_data = Input::all();
		
		$rules = array(
			'cardId' => 'required'
			);

		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('viewProfile.index')->withErrors($validator)->withInput();

		$member = Member::where('card_no','=',Input::get('cardId'))->first();
		if($member)
		{
			$idcard = Idcard::where('card_no','=',$member->card_no)->first();
			$transactions = Transaction::where('card_no','=',$idcard->card_no)->get();
			$bookings = Booking::where('card_no','=',$idcard->card_no)->get();
			//return "member";
			return View::make('home.viewprofile')
				->with('info','Card ID Found.')
				->with('idcard',$idcard)
				->with('bookings',$bookings)
				->with('display',1)
				->with('transactions',$transactions);
		}
		else
		{
		return View::make('home.viewprofile')
			->with('info','Card ID Not Found.')
			->with('idcard',NULL)
			->with('bookings',NULL)
			->with('display',1)
			->with('transactions',NULL);
		}
	}

}
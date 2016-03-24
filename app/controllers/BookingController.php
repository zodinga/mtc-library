<?php

class BookingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookings = Booking::orderBy('created_at')->get();
		return View::make("booking.list")
			->with('bookings',$bookings);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Session::has('barcode'))
		{
			$barcode = Session::get('barcode');
		}
		else
		{
			$barcode = "MTC0000000";
		}
		return View::make('home.booking')
			->with('barcode',$barcode)
			->with('display',0);
	}

	public function createbooking($id)
	{
		$barcode = $id;
		//dd($barcode);
		return View::make('home.booking')
			->with('barcode',$barcode)
			->with('display',0);
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
			'cardId' => 'required'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('booking.create')->withErrors($validator)->withInput();

		$booking = Booking::where('card_no','=',Input::get('cardId'))->where('barcode','=',Input::get('barcode'))->first();
		if($booking)
		{
			return Redirect::route("booking.create")
				->with('barcode',Input::get('barcode'))
				->with('danger','You Already Booked .');
		}
		else
		{
		//dd( Input::get('barcode'));
		$booking = new Booking;
		$booking->card_no = Input::get('cardId');
		$booking->barcode = Input::get('barcode');
		$booking->save();
		return Redirect::route("booking.create")
			->with('barcode',Input::get('barcode'))
			->with('success','Booking Succesfully created.');
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
		$icard = Idcard::join('Members','Members.card_no','=','Idcards.card_no')
			->where('Idcards.name','LIKE','%'.Input::get('memberName').'%')
			->where('Members.deleted_at','=',NULL)
			->get();
		return View::make('home.booking')
			->with('icards',$icard)
			->with('barcode',Input::get('barcode'))
			->with('display',1);
	}

	

}
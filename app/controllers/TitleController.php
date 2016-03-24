<?php

class TitleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$booktitles = Booktitle::where('id','>',0)->orderBy('title_name','asc')->get();
		return View::make('title.create')
			->with('booktitles',$booktitles);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$booktitle = Input::get('title');
		$title = Booktitle::where('title_name','LIKE',$booktitle)->first();
		if($title)
		{
			return Redirect::route("title.create")->with('danger',"Book Title aleardy exist.");
		} 
		else
		{
			$btitle = new Booktitle;
			$btitle->title_name = $booktitle;
			$btitle->save();
			return Redirect::route("title.create")->with('success',"Book Title sucessfully Added.");

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
		$title = Booktitle::find($id);
		$booktitles = Booktitle::all();
		return View::make('title.edit')
			->with('title',$title)
			->with('booktitles',$booktitles);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$booktitle = Booktitle::find($id);
		$booktitle->title_name = Input::get('title');
		$booktitle->save();
		return Redirect::route("title.create")->with('success',"Book Title sucessfully Updated.");

	}

	public function search()
	{
		$title = Input::get('title');
		$booktitles = Booktitle::where('title_name','LIKE','%'.$title.'%')->get();
		return View::make('title.create')
			->with('booktitles',$booktitles);
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

}
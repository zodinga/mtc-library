<?php

class PublisherController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', Input::get('limit', 30));

		$search_criteria = array(
			'search' => Input::get('search', null),
			'status' => Input::get('status', 'active'),
			'limit' => $limit
			);
		$publishers = Publisher::withTrashed()->where(function($query){				
				
				if( Input::get('search', null) != null ) {
					$query->where('publisher_name', 'LIKE', "%".Input::get('search')."%");
				}

				if( Input::get('status', 'active') != null ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status', 'active') == 'active' ) {
						$query->where('deleted_at', '=', null);
					}
				}
			})->orderBy('publisher_name', 'asc')->paginate();

		$index = $publishers->getCurrentPage() > 1?$publishers->getCurrentPage()*$publishers->getPerPage():1;
		return View::make('publisher.list', array(
			'limit' => $limit,
			'publishers' => $publishers,
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
		return View::make('publisher.create');
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
			'publisher_name' => 'required|unique:publishers,publisher_name'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('publisher.create')->withErrors($validator)->withInput();
		
		$publisher = new Publisher();
		$publisher->publisher_name = $input_data['publisher_name'];
		$publisher->save();

		return Redirect::route("publisher.index")->with('success','New publisher created.');
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
		$publisher = Publisher::find($id);
		return View::make('publisher.edit', array('publisher'=>$publisher));
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
		$publisher = Publisher::find($id);
		
		$rules = array(
			'publisher_name' => 'required|unique:publishers,publisher_name,' . $publisher->id . ',id'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('publisher.edit', array($publisher->id))->withErrors($validator)->withInput();
		
		$publisher->publisher_name = $input_data['publisher_name'];
		$publisher->save();

		return Redirect::route("publisher.index")->with('success','Publisher name updated.');
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

		$publisher = Publisher::withTrashed()->find($id);

		if($publisher) {
			if($delete) {
				$publisher->delete();
				return Redirect::route("publisher.index")->with('success',"Publisher was deleted.");
			}
			elseif($restore) {
				$publisher->restore();
				return Redirect::route("publisher.index")->with('success',"Publisher was restored.");
			}
			elseif($forceDelete) {
				$publisher->forceDelete();
				return Redirect::route("publisher.index")->with('success',"Publisher was deleted permanently.");
			}
		}
		else {
			return Redirect::route("publisher.index")->with('danger',"Delete failed. Publisher not found.");
		}
	}

}
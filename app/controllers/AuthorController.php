<?php

class AuthorController extends \BaseController {

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
		$authors = Author::withTrashed()->where(function($query){				
				
				if( Input::get('search', null) != null ) {
					$query->where('author_name', 'LIKE', "%".Input::get('search')."%");
				}

				if( Input::get('status', 'active') != null ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status', 'active') == 'active' ) {
						$query->where('deleted_at', '=', null);
					}
				}
			})->orderBy('author_name', 'asc')->paginate();

		$index = $authors->getCurrentPage() > 1?$authors->getCurrentPage()*$authors->getPerPage():1;
		return View::make('author.list', array(
			'limit' => $limit,
			'authors' => $authors,
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
		return View::make('author.create');
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
			'author_name' => 'required|unique:authors,author_name'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('author.create')->withErrors($validator)->withInput();
		
		$author = new Author();
		$author->author_name = $input_data['author_name'];
		$author->save();

		return Redirect::route("author.index")->with('success','New author created.');
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
		$author = Author::find($id);
		return View::make('author.edit', array('author'=>$author));
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
		$author = Author::find($id);
		
		$rules = array(
			'author_name' => 'required|unique:authors,author_name,' . $author->id . ',id'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('author.edit', array($author->id))->withErrors($validator)->withInput();
		
		$author->author_name = $input_data['author_name'];
		$author->save();

		return Redirect::route("author.index")->with('success','Author name updated.');
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

		$author = Author::withTrashed()->find($id);

		if($author) {
			if($delete) {
				$author->delete();
				return Redirect::route("author.index")->with('success',"Author was deleted.");
			}
			elseif($restore) {
				$author->restore();
				return Redirect::route("author.index")->with('success',"Author was restored.");
			}
			elseif($forceDelete) {
				$author->forceDelete();
				return Redirect::route("author.index")->with('success',"Author was deleted permanently.");
			}
		}
		else {
			return Redirect::route("author.index")->with('danger',"Delete failed. Author not found.");
		}
	}

}
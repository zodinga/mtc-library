<?php

class CategoryController extends \BaseController {

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
		$categories = Category::withTrashed()->where(function($query){				
				
				if( Input::get('search', null) != null ) {
					$query->where('category_name', 'LIKE', "%".Input::get('search')."%");
				}

				if( Input::get('status', 'active') != null ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status', 'active') == 'active' ) {
						$query->where('deleted_at', '=', null);
					}
				}
			})->orderBy('category_name', 'asc')->paginate();

		$index = $categories->getCurrentPage() > 1?$categories->getCurrentPage()*$categories->getPerPage():1;
		return View::make('category.list', array(
			'limit' => $limit,
			'categories' => $categories,
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
		return View::make('category.create');
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
			'category_name' => 'required|unique:categories,category_name'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('category.create')->withErrors($validator)->withInput();
		
		$category = new Category();
		$category->category_name = $input_data['category_name'];
		$category->save();

		return Redirect::route("category.index")->with('success','New category created.');
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
		$category = Category::find($id);
		return View::make('category.edit', array('category'=>$category));
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
		$category = Category::find($id);
		
		$rules = array(
			'category_name' => 'required|unique:categories,category_name,' . $category->id . ',id'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('category.edit', array($category->id))->withErrors($validator)->withInput();
		
		$category->category_name = $input_data['category_name'];
		$category->save();

		return Redirect::route("category.index")->with('success','Category name updated.');
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

		$category = Category::withTrashed()->find($id);

		if($category) {
			if($delete) {
				$category->delete();
				return Redirect::route("category.index")->with('success',"Category was deleted.");
			}
			elseif($restore) {
				$category->restore();
				return Redirect::route("category.index")->with('success',"Category was restored.");
			}
			elseif($forceDelete) {
				$category->forceDelete();
				return Redirect::route("category.index")->with('success',"Category was deleted permanently.");
			}
		}
		else {
			return Redirect::route("category.index")->with('danger',"Delete failed. Category not found.");
		}
	}

}
<?php

class BookController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$classifications_options = array('0'=>'All Classification');
		$classifications = DB::table('books')->distinct()->get(array('classification_no'));
		foreach($classifications as $classification)
			$classifications_options[$classification->classification_no] = $classification->classification_no;

		$categories_options = array('0'=>'All Categories');
		$categories = Category::orderBy('category_name', 'asc')->get();
		foreach($categories as $category)
			$categories_options[$category->id] = $category->category_name;

		$limit = Input::get('limit', Input::get('limit', 30));

		$search_criteria = array(
			'search' => Input::get('search', null),
			'status' => Input::get('status', 'active'),
			'category_id' => Input::get('category_id', 0),
			'classification_no' => Input::get('classification_no', 0),
			'limit' => $limit
			);

		$books = Book::withTrashed()
			->join('authors', function($join){
				$join->on('books.author_id', '=', 'authors.id');
			})

			->join('booktitles', function($join){
				$join->on('books.title', '=', 'booktitles.id');
			})
			->join('publishers', function($join){
				$join->on('books.publisher_id', '=', 'publishers.id');
			})
			->where(function($query){			
				
				if( Input::get('search', null) != null ) {
					$query->where(function($q1){
						$q1->where('books.barcode', 'LIKE', "%".Input::get('search')."%");
						$q1->orWhere('booktitles.title', 'LIKE', "%".Input::get('search')."%");
						$q1->orWhere('authors.author_name', 'LIKE', "%".Input::get('search')."%");
						$q1->orWhere('publishers.publisher_name', 'LIKE', "%".Input::get('search')."%");
					});
				}

				if( Input::get('classification_no') != null && Input::get('classification_no') != 0 ) {
					$query->where('classification_no', 'LIKE', Input::get('classification_no') . "%");
				}

				if( Input::get('category_id', 0) != 0 ) {
					$query->where('category_id', '=', Input::get('category_id') );
				}

				if( Input::get('status', 'active') != '' ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('books.deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status', 'active') == 'active' ) {
						$query->where('books.deleted_at','=', null);
					}
				}

			})
			->select('booktitles.*','books.*', 
			'authors.author_name', 'publishers.publisher_name')
			->orderBy('title_name', 'asc')->paginate($limit);

		$index = $books->getCurrentPage() > 1?$books->getCurrentPage()*$books->getPerPage():1;
		return View::make('book.list', array(
			'limit' => $limit,
			'books' => $books,
			'types'=>$this->types(), 
			'limit_sizes'=>$this->limitSizes(), 
			'search_criteria'=>$search_criteria, 
			'index'=>$index,
			'classifications' => $classifications_options,
			'categories' => $categories_options,
			));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::orderBy('category_name', 'asc')->get();
		$authors = Author::orderBy('author_name', 'asc')->get();
		$publishers = Publisher::orderBy('publisher_name', 'asc')->get();
		return View::make('book.create', array(
			'categories' => $categories,
			'authors' => $authors,
			'publishers' => $publishers,
			));
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
			'accession_no' => 'required|unique:books,accession_no',
			'published_year' => 'numeric|min:1000|max:3000',
			'pages' => 'required|numeric|min:1',
			'copies' => 'required|numeric|min:1',
			'category_id' => 'required_if:new_category,0',
			'author_id' => 'required_if:new_author,0',
			'publisher_id' => 'required_if:new_publisher,0',
			'category_new' => 'required_if:new_category,1',
			'author_new' => 'required_if:new_author,1',
			'source' => 'required',
			'publisher_new' => 'required_if:new_publisher,1'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('title.create')->with('danger','Cannot Add New Book due to required field not entered...');
		
		if($input_data['new_category'] == 1) {
			$new_category = new Category();
			$new_category->category_name = $input_data['category_new'];
			$new_category->save();
			$input_data['category_id'] = $new_category->id;
		}

		if($input_data['new_author'] == 1) {
			$new_author = new Author();
			$new_author->author_name = $input_data['author_new'];
			$new_author->save();
			$input_data['author_id'] = $new_author->id;
		}

		if($input_data['new_publisher'] == 1) {
			$new_publisher = new Publisher();
			$new_publisher->publisher_name = $input_data['publisher_new'];
			$new_publisher->save();
			$input_data['publisher_id'] = $new_publisher->id;
		}

		$book = new Book();
		$book->barcode = '';
		$book->title = $input_data['titleID'];
		$book->category_id = $input_data['category_id'];
		$book->classification_no = $input_data['classification_no'];
		$book->book_no = $input_data['book_no'];
		$book->accession_no = $input_data['accession_no'];
		$book->author_id = $input_data['author_id'];
		$book->edition = $input_data['edition'];
		$book->publisher_id = $input_data['publisher_id'];
		$book->published_year = $input_data['published_year'];
		$book->pages = $input_data['pages'];
		$book->volume = $input_data['volume'];
		$book->isbn_no = $input_data['isbn_no'];
		$book->copies = $input_data['copies'];
		$book->price = $input_data['price'];
		$book->source = $input_data['source'];
		$book->source_name = $input_data['source_name'];
		$book->remarks = $input_data['remarks'];
		$book->shelf_no = $input_data['shelf_no'];
		$book->row_no = $input_data['row_no'];
		$book->save();

		$book->barcode = 'MTC' . str_pad( $book->id, 6, "0", STR_PAD_LEFT);
		$book->save();

		return Redirect::route("book.edit", array($book->id))->with('success','New book entry created. You can continue editing the book detail.');
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
		$categories = Category::orderBy('category_name', 'asc')->get();
		$authors = Author::orderBy('author_name', 'asc')->get();
		$publishers = Publisher::orderBy('publisher_name', 'asc')->get();
		$book = Book::with(array('author','publisher','category'))->find($id);
		return View::make('book.edit', array(
			'categories' => $categories,
			'authors' => $authors,
			'publishers' => $publishers,
			'book'=>$book
			));
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
		$book = Book::with(array('author','publisher','category'))->find($id);
		
		$rules = array(
			'accession_no' => 'required|unique:books,accession_no,' . $book->accession_no . ',accession_no',
			
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('book.edit', array($book->id))->withErrors($validator)->withInput();
		
		if($input_data['new_category'] == 1) {
			$new_category = new Category();
			$new_category->category_name = $input_data['category_new'];
			$new_category->save();
			$input_data['category_id'] = $new_category->id;
		}

		if($input_data['new_author'] == 1) {
			$new_author = new Author();
			$new_author->author_name = $input_data['author_new'];
			$new_author->save();
			$input_data['author_id'] = $new_author->id;
		}

		if($input_data['new_publisher'] == 1) {
			$new_publisher = new Publisher();
			$new_publisher->publisher_name = $input_data['publisher_new'];
			$new_publisher->save();
			$input_data['publisher_id'] = $new_publisher->id;
		}

		$book->title = $input_data['titleID'];
		$book->category_id = $input_data['category_id'];
		$book->classification_no = $input_data['classification_no'];
		$book->accession_no = $input_data['accession_no'];
		$book->author_id = $input_data['author_id'];
		$book->edition = $input_data['edition'];
		$book->publisher_id = $input_data['publisher_id'];
		$book->published_year = $input_data['published_year'];
		$book->pages = $input_data['pages'];
		$book->volume = $input_data['volume'];
		$book->isbn_no = $input_data['isbn_no'];
		$book->copies = $input_data['copies'];
		$book->price = $input_data['price'];
		$book->source = $input_data['source'];
		$book->source_name = $input_data['source_name'];
		$book->remarks = $input_data['remarks'];
		$book->shelf_no = $input_data['shelf_no'];
		$book->row_no = $input_data['row_no'];
		$book->save();

		

		return Redirect::route("book.edit", array($book->id))->with('success','Book entry updated. You can continue editing the book detail.');
	
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

		$book = Book::withTrashed()->find($id);

		if($book) {
			if($delete) {
				$book->delete();
				return Redirect::route("book.index")->with('success',"Library book was deleted.");
			}
			elseif($restore) {
				$book->restore();
				return Redirect::route("book.index")->with('success',"Library book was restored.");
			}
			elseif($forceDelete) {
				$book->forceDelete();
				return Redirect::route("book.index")->with('success',"Library book was deleted permanently.");
			}
		}
		else {
			return Redirect::route("book.index")->with('danger',"Delete failed. Book not found.");
		}
	}

	public function preview($barcode)
	{
		$book = Book::with('author')->whereBarcode($barcode)->first();

		if($book)
			return View::make('book.preview', array('book'=>$book));
		else
			return "notfound";
	}

	public function newbook()
	{
		$titleID = Input::get('titleID');
		$book = Book::where('title','=',$titleID)->first();
		$booktitle = Booktitle::find($titleID);
		$categories = Category::orderBy('category_name', 'asc')->get();
		$authors = Author::orderBy('author_name', 'asc')->get();
		$publishers = Publisher::orderBy('publisher_name', 'asc')->get();
		if($book)
		{
			return View::make('book.createExisting', array(
				'categories' => $categories,
				'authors' => $authors,
				'publishers' => $publishers,
				'book' => $book,
				'booktitle' => $booktitle,
				));
		}
		else
		{
			return View::make('book.create', array(
				'categories' => $categories,
				'authors' => $authors,
				'publishers' => $publishers,
				'booktitle' => $booktitle,
				));
		}

	}


}
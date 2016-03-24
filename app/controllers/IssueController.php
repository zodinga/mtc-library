<?php
class IssueController extends \BaseController {

	public function getNew()
	{
		return View::make('issue.new');
	}

	public function postNew()
	{
		$input_data = Input::all();

		$rules = array(
			'member_card_no' => 'required|exists:idcards,card_no'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::to('issue/new')->withErrors($validator)->withInput();
		
		if($input_data['book_count'] == "" || $input_data['book_count'] == 0)
			return Redirect::to("issue/new")->with('bookEmptyWarning','New issue cannot be created. Books empty.')->withInput();

		$books = Input::get('book');

		

		foreach($books as $book) {
			$transaction = new Transaction();
			$transaction->card_no = trim(strtoupper(Input::get('member_card_no')));
			$transaction->book_id = $book['book_id'];
			$transaction->copies = 1;
			$transaction->issued_at = DB::raw('NOW()');
			$transaction->due_at = date('Y-m-d H:i:s', strtotime($book['due_date']));
			$transaction->save();
		}

		return Redirect::to("issue/new")->with('success','New issue created.');
	}

	public function memberPendingHistory($card_no)
	{
		$pending_issues = Transaction::whereRaw("`returned_at` is null")
			->where('card_no','=',$card_no)
			->get();

		return View::make('issue.member-pending-history', array(
			'pending_issues' => $pending_issues
			));
	}

	public function getIndex()
	{
		$limit = Input::get('limit', Input::get('limit', 30));

		$search_criteria = array(
			'search' => Input::get('search', ''),
			'status' => Input::get('status', ''),
			'limit' => $limit
			);

		$transactions = Transaction::withTrashed()
			->join('idcards', function($join){
				$join->on('transactions.card_no', '=', 'idcards.card_no');
			})
			->join('books', function($join){
				$join->on('transactions.book_id', '=', 'books.id');
			})
			->where(function($query){			
				
				if( Input::get('search') != null ) {
					$query->where('transactions.card_no', 'LIKE', "%".Input::get('search')."%");
				}

				if( Input::get('status') != '' ) {
					if( Input::get('status') == 'deleted' ) {
						$query->where('transactions.deleted_at', '!=', "NULL");
					}
					elseif( Input::get('status') == 'active' ) {
						$query->where('transactions.deleted_at','=', null);
					}
					elseif( Input::get('status') == 'overdue' ) {
						$query->where(DB::raw('DATE(transactions.due_at)'),'<', DB::raw('DATE(NOW())'));
					}
					elseif( Input::get('status') == 'returned' ) {
						$query->where('transactions.returned_at','!=', "NULL");
					}
				}

			})
			->select('transactions.*', 'idcards.name', 'books.title')
			->orderBy('transactions.issued_at', 'desc')->paginate($limit);

		$index = $transactions->getCurrentPage() > 1?$transactions->getCurrentPage()*$transactions->getPerPage():1;
		return View::make('issue.list', array(
			'transactions' => $transactions,
			'limit' => $limit,
			'limit_sizes'=>$this->limitSizes(), 
			'search_criteria'=>$search_criteria,
			'index'=>$index
			));
	}

	public function getDelete($id)
	{
		$transaction = Transaction::withTrashed()->find($id);

		if($transaction) {
			$transaction->delete();
			return Redirect::to("issue")->with('success',"Transaction was deleted.");
		}
		else {
			return Redirect::to("issue")->with('danger',"Delete failed. Book not found.");
		}
	}

	public function getRestore($id)
	{
		$transaction = Transaction::withTrashed()->find($id);

		if($transaction) {
			$transaction->restore();
			return Redirect::to("issue")->with('success',"Transaction was deleted.");
		}
		else {
			return Redirect::to("issue")->with('danger',"Delete failed. Book not found.");
		}
	}

	public function getForce($id)
	{
		$transaction = Transaction::withTrashed()->find($id);

		if($transaction) {
			$transaction->forceDelete();
			return Redirect::to("issue")->with('success',"Transaction was deleted permanently.");
		}
		else {
			return Redirect::to("issue")->with('danger',"Delete failed. Book not found.");
		}
	}

	public function getReturn($id)
	{
		$transaction = Transaction::withTrashed()->find($id);

		if($transaction) {
			$transaction->returned_at = DB::raw('NOW()');
			$transaction->save();
			return Redirect::to("issue")->with('success',"Book return successful.");
		}
		else {
			return Redirect::to("issue")->with('danger',"Book return failed. Book not found.");
		}
	}

	public function getCancelReturn($id)
	{
		$transaction = Transaction::withTrashed()->find($id);

		if($transaction) {
			$transaction->returned_at = DB::raw('NULL');
			$transaction->save();
			return Redirect::to("issue")->with('success',"Book return cancelled.");
		}
		else {
			return Redirect::to("issue")->with('danger',"Book return cancel failed. Book not found.");
		}
	}

}
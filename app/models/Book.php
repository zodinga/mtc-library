<?php
class Book extends Eloquent {

	protected $softDelete = true;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'books';

	public function author()
	{
		return $this->belongsTo('Author');
	}

	public function publisher()
	{
		return $this->belongsTo('Publisher');
	}

	public function booktitle()
	{
		return $this->belongsTo('Booktitle');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}
	

}
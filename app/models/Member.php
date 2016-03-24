<?php
class Member extends Eloquent {

	protected $softDelete = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';

	public function idcards()
	{
		return $this->belongsTo('Idcard', 'card_no', 'card_no');
	}
}
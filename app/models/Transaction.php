<?php
class Transaction extends Eloquent {

	protected $softDelete = true;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transactions';
}
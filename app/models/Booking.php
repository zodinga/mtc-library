<?php
class Booking extends Eloquent {

	protected $softDelete = true;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bookings';

}
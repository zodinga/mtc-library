<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function types()
	{
		return array(
			'' => 'All ID Card Types',
			'pre service' => 'Pre Service Student',
			'in service' => 'In Service Student',
			// 'faculty' => 'Faculty',
			'staff' => 'Staff',
			'temporary' => 'Temporary'
			);
	}

	public function limitSizes()
	{
		return array(
			'0' => 'All Records',
			'20' => '20 Records',
			'30' => '30 Records',
			'50' => '50 Records',
			'70' => '70 Records',
			'90' => '90 Records',
			'100' => '100 Records',
			);
	}

}
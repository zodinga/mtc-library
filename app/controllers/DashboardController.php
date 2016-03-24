<?php

class DashboardController extends \BaseController {

	public function principal()
	{
		$bookings = Booking::all();
		$settings = Setting::find(11);
		$bookingDelete = 0;
		if($bookings)
		{
			foreach ($bookings as $booking) {
				$date = $booking->created_at;
				$datearray = explode(" ", $date);
				$date1 = date_create($datearray[0]);
				$date2 = date_create(date('Y-m-d'));
				$date = date_diff($date1,$date2);
				if($date->d > $settings->setting_data)
				{
					$bookingDelete++;
					$booking->delete();
				}

			}
		}
		return View::make('dashboard.principal')->with('bookingDelete',$bookingDelete);
	}

	public function administrator()
	{
		$bookings = Booking::all();
		$settings = Setting::find(11);
		$bookingDelete = 0;
		if($bookings)
		{
			foreach ($bookings as $booking) {
				$date = $booking->created_at;
				$datearray = explode(" ", $date);
				$date1 = date_create($datearray[0]);
				$date2 = date_create(date('Y-m-d'));
				$date = date_diff($date1,$date2);
				if($date->d > $settings->setting_data)
				{
					$bookingDelete++;
					$booking->delete();
				}

			}
		}
		return View::make('dashboard.administrator')->with('bookingDelete',$bookingDelete);
	}

}
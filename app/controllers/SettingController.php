<?php
class SettingController extends BaseController {
	
	public function getIndex()
	{
		return View::make('settings');
	}

	public function postIndex()
	{
		$input_data = Input::all();

		$rules = array(
			'site_title' => 'required',
			'district' => 'required',
			'district_code' => 'required',
			'copyright' => 'required',
			'logo' => 'image',
			'faculty_allowed' => 'required',
			'staff_allowed' => 'required',
			'student_allowed' => 'required',
			'temporary_allowed' => 'required',
			'booking_allowed' => 'required'
			);
		$validator = Validator::make($input_data, $rules);

		if($validator->fails())
			return Redirect::route('settings/index')->withErrors($validator)->withInput();
		
		Setting::whereSettingKey('site_title')->update(array('setting_data'=>$input_data['site_title']));
		Setting::whereSettingKey('district')->update(array('setting_data'=>$input_data['district']));
		Setting::whereSettingKey('district_code')->update(array('setting_data'=>$input_data['district_code']));
		Setting::whereSettingKey('copyright')->update(array('setting_data'=>$input_data['copyright']));
		Setting::whereSettingKey('faculty_allowed')->update(array('setting_data'=>$input_data['faculty_allowed']));
		Setting::whereSettingKey('staff_allowed')->update(array('setting_data'=>$input_data['staff_allowed']));
		Setting::whereSettingKey('student_allowed')->update(array('setting_data'=>$input_data['student_allowed']));
		Setting::whereSettingKey('temporary_allowed')->update(array('setting_data'=>$input_data['temporary_allowed']));
		Setting::whereSettingKey('booking_allowed')->update(array('setting_data'=>$input_data['booking_allowed']));

		if(Input::hasFile('logo')) {			
			$logo = Input::file('logo');
			$filename = 'logo-' . uniqid() .'.'. $logo->getClientOriginalExtension();
			$logo->move(public_path() . '/logo/', $filename);
			Setting::whereSettingKey('logo')->update(array('setting_data'=>'logo/'.$filename));
		}

		if(Input::get('remove_logo', null) == 1)
			Setting::whereSettingKey('logo')->update(array('setting_data'=>''));

		return Redirect::to("settings")->with('success','Settings updated.');
	}
}
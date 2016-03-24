<?php

/**
 * Get the setting value from the settings table
 * @param  string $key [The key for the settings to be obtained]
 * @return string      [The settings value]
 */	
function get_setting($key)
{
	if(strlen($key) !== 0) {
		$setting = Setting::whereSettingKey($key)->first();
		return isset($setting->setting_key)?$setting->setting_data:null;
	}
	else return null;
}

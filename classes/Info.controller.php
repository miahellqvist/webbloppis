<?php

class Info {

	public static function aboutUs() {
		$data['template'] = 'about.html';
		return $data;
	}

	public static function support() {
		$data['template'] = 'support.html';
		return $data;
	}

	public static function membershipInfo() {
		$data['template'] = 'membershipinfo.html';
		return $data;
	}
}
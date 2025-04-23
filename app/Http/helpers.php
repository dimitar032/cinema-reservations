<?php

if (!function_exists('json_response')) {

	function json_response($code, $text, $data = null)
	{
		return response([
			'message' => $text,
			'errors' => $data,
		], $code);
	}
}
<?php

if( ! function_exists('http_get'))
{
	function http_get($url, array $header = [], $refer = '')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, $refer);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}
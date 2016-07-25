<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('label'))
{
	function label_user($key)
	{
		if($key == 1)
		{
			return "<span class='badge bg-green'>ACTIVE</span>";
		}else
		{
			return "<span class='badge bg-yellow'>INACTIVE</span>";
		}
	}
}

if ( ! function_exists('label_post'))
{
	function label_post($key)
	{
		if($key == 'publish')
		{
			return "<span class='badge bg-green'>PUBLISH</span>";
		}else
		{
			return "<span class='badge bg-purple'>DRAFT</span>";
		}
	}
}
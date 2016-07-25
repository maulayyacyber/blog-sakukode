<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('menu'))
{
	function menu($option=FALSE)
	{
		$CI =& get_instance();

		$opt = isset($option) ? $option : '';

		switch ($opt) {
			case TRUE:
				
				$key = "protected";
				break;
			case FALSE:
				$key = "not protected";
				break;
			default:
				$key = "not protected";
				break;
		}

		$query = $CI->db->select('*')->where('options',$key)->where('status','active')->get('menu');

		if($query->num_rows() > 0){

			$result = $query->result();

			return $result;

		}else{

			return NULL;			
		}

	}
}

if ( ! function_exists('menu_group'))
{
	function menu_group($option=FALSE,$group)
	{
		$CI =& get_instance();

		$opt = isset($option) ? $option : '';

		switch ($opt) {
			case TRUE:
				
				$key = "protected";
				break;
			case FALSE:
				$key = "not protected";
				break;
			default:
				$key = "not protected";
				break;
		}

		$query = $CI->db->select('*')
						->from('menu')
						->join('menu_groups','menu_groups.menu_id=menu.menu_id')
						->where('options',$key)
						->where('status','active')
						->where('menu_groups.group_id',$group)
						->get();

		if($query->num_rows() > 0){

			$result = $query->result();

			return $result;

		}else{

			return NULL;			
		}

	}
}
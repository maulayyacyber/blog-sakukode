<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('inbox'))
{
	function inbox()
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('messages',array('deleted'=>0,'status'=>'UNREAD'));

		if($query->num_rows() > 0){

			return $query->num_rows();
		}else{
			return NULL;
		}
		
	}
}

if ( ! function_exists('messages'))
{
	function new_messages()
	{
		$CI =& get_instance();

		$query = $CI->db->limit(10)->order_by('date','DESC')->get_where('messages',array('deleted'=>0));

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return NULL;
		}
		
	}
}

if ( ! function_exists('draft'))
{
	function draft($user_id)
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('emails',array('status'=>'draft','author_id'=>$user_id,'deleted'=>0));

		if($query->num_rows() > 0){

			return $query->num_rows();
		}else{
			return NULL;
		}
		
	}
}

if ( ! function_exists('sent'))
{
	function sent($user_id)
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('emails',array('status'=>'sent','author_id'=>$user_id,'deleted'=>0));

		if($query->num_rows() > 0){

			return $query->num_rows();
		}else{
			return NULL;
		}
		
	}
}

if ( ! function_exists('trash'))
{
	function trash()
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('messages',array('deleted'=>1));

		if($query->num_rows() > 0){

			return $query->num_rows();
		}else{
			return NULL;
		}
		
	}
}
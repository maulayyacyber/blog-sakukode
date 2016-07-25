<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('company'))
{
	function company($key)
	{
		$CI =& get_instance();

		$query = $CI->db->select($key)->where('company_id',1)->get('companies');

		if($query->num_rows() != 1){

			return NULL;
		}else{
			$result = $query->row();

			return $result->$key;
		}
		
	}
}

if ( ! function_exists('user_profile'))
{
	function user_profile($id)
	{
		$CI =& get_instance();

		$query = $CI->db->select('username,email,first_name,last_name,job,phone')->get_where('users',array('id'=>$id));

		if($query->num_rows() != 1){

			return NULL;
		}else{
			$result = $query->row();

			return $result;
		}
		
	}
}

if ( ! function_exists('category'))
{
	function category()
	{
		$CI =& get_instance();

		$query = $CI->db->select('category_id,category_url,category_name')
						->order_by('category_id','ASC')
						->get('blog_categories');

		if($query->num_rows() > 0 ){

			return $query->result();
		}else{
			
			return NULL;
		}
		
	}
}

if ( ! function_exists('post'))
{
	function post($limit=1)
	{
		$CI =& get_instance();

		$query = $CI->db->select('article_title,article_url,updated_at')
						->limit($limit)
						->where('status','publish')
						->where('deleted',0)
						->order_by('date','ASC')
						->get('blog_articles');

		if($query->num_rows() > 0 ){

			return $query->result();
		}else{
			
			return NULL;
		}
		
	}
}

if ( ! function_exists('portofolio'))
{
	function portofolio($limit=1,$field='*')
	{
		$CI =& get_instance();

		$query = $CI->db->select($field)
						->limit($limit)
						->order_by('portofolio_id','ASC')
						->get('portofolios');

		if($query->num_rows() > 0 ){

			return $query->result();
		}else{
			
			return NULL;
		}
		
	}
}

if ( ! function_exists('total_comment'))
{
	function total_comment($id)
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('blog_comments',array('article_id'=>$id,'deleted'=>0));

		if($query->num_rows > 0)
		{
			$result = $query->num_rows();
			return $result;
		}else
		{
			$result = "Tidak ada";
			return $result;
		}
		
	}
}

if ( ! function_exists('total_post'))
{
	function total_post($field,$key)
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('blog_articles',array($field => $key,'deleted'=>0));
		
		if($query->num_rows() > 0)
		{
			$total = $query->num_rows();
			return $total;
		}
		else
		{
			return NULL;
		}
	}
}

if ( ! function_exists('read_more'))
{
	function read_more($content)
	{
		//$str    = htmlspecialchars_decode($content);
		$result = substr($content, 0, strpos($content, '&amp;lt;!--more--&amp;gt;'));
	
		if($result != NULL)
		{
			return $result;
		}
		else
		{
			return $content;
		}
	}
}

if ( ! function_exists('generate_slug'))
{
	function generate_slug($date,$slug)
	{
		if(isset($date) && isset($slug))
		{
			$year  = date("Y",strtotime($date));
			$month = date("m",strtotime($date));

			$url   = "blog/".$year."/".$month."/".$slug;  
			return $url;
		}else
		{
			return NULL;
		}
	}
}

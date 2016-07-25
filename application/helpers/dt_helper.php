<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dt_button'))
{
	function dt_button($noid,$options=1)
	{
		$CI =& get_instance();

		$CI->load->library('salabim');

		$uri = $CI->router->fetch_class();
		$id  = $CI->salabim->encode($noid);

		switch ($options) {
			case 1:
				$btn  = anchor($uri.'/detail', 'detail', array('class'=>'btn btn-info btn-xs'));
				$btn .= anchor($uri.'/ubah', 'ubah', array('classs'=>'btn btn-success btn-xs'));

				return $btn;
				break;
			
			default:
				$btn  = anchor($uri.'/detail', 'detail', array('class'=>'btn btn-info btn-xs'));
				$btn .= anchor($uri.'/ubah', 'ubah', array('classs'=>'btn btn-success btn-xs'));

				return $btn;
				break;
		}
	}
}
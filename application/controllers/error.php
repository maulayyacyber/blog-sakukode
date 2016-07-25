<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->helper(array('dateindo','text','mail'));
	}

	public function index()
	{
		if($this->ion_auth->logged_in() && $this->uri->segment(1) == 'sk-admin')
		{
			$this->stencil->theme('backend');
			$this->stencil->layout('default');
			$this->stencil->slice('head');
			$this->stencil->slice('header');
			$this->stencil->slice('sidebar');

			$this->stencil->title('Error Page');

			$this->stencil->paint('404');
		}
		elseif($this->uri->segment(1) != 'sk-admin')
		{
			$this->stencil->theme('frontend');
			$this->stencil->layout('404');
			$this->stencil->slice('head');
			$this->stencil->slice('script');

			$this->stencil->title('Error Page');

			$this->stencil->paint('error_page');
		}else
		{
			$this->stencil->theme('frontend');
			$this->stencil->layout('404');
			$this->stencil->slice('head');
			$this->stencil->slice('script');

			$this->stencil->title('Error Page');

			$this->stencil->paint('error_page');
		}
	}

}

/* End of file error.php */
/* Location: ./application/controllers/error.php */
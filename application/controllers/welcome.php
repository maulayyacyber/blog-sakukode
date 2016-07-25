<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function menu()
	{
		$menus = menu_group(TRUE,2);

		foreach ($menus as $k) {
			
			echo $k->name;
			echo "<br>";
		}
	}

	public function example()
	{
		$this->load->helper(array('mail','dateindo','text'));
		$this->stencil->theme('backend');
		$this->stencil->slice('head');
		$this->stencil->slice('header');
		$this->stencil->slice('sidebar');

		$this->stencil->title('Example');

		$this->stencil->layout('default');
		$this->stencil->paint('blank');
	}

	public function example_login()
	{
		$this->stencil->theme('backend');
		$this->stencil->slice('head');
		

		$this->stencil->title('Example Login');

		$this->stencil->layout('login');
		$this->stencil->paint('login');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
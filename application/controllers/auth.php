<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');

		$this->lang->load('auth');
		$this->load->helper('language');

		$this->stencil->theme('backend');
		$this->stencil->layout('login');
		$this->stencil->slice('head');
		$this->stencil->title('Login');
	}

	public function login()
	{
		if ($this->ion_auth->logged_in())	redirect('sk-admin/dashboard');

		//validate form input
			$this->form_validation->set_rules('identity', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			$this->form_validation->set_message('required','%s is required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if ($this->form_validation->run() == true)
			{
			//check to see if the user is logging in
			//check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
				{
				//if the login is successful
				//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('sk-admin/dashboard', 'refresh');
				}
				else
				{
				//if the login was un-successful
				//redirect them back to the login page
					$this->session->set_flashdata('message', '<p class="text-danger">'.$this->ion_auth->errors().'</p>');
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' 	=> 'identity',
				'type' 	=> 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('identity'),
				);
			$this->data['password'] = array('name' => 'password',
				'id' 	=> 'password',
				'type' 	=> 'password',
				'class'	=> 'form-control'
				);

			$this->stencil->paint('login', $this->data);
		}

	}

	//log the user out
	function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('sk-admin', 'refresh');
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
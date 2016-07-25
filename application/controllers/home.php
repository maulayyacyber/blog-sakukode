<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->theme('frontend');
		$this->stencil->layout('front_layout');
		$this->stencil->slice('head');
		$this->stencil->slice('navbar');
		$this->stencil->slice('slider');
		$this->stencil->slice('contact');
		$this->stencil->slice('script');

		$this->load->model(array('message_m'));
	}

	public function index()
	{
		$this->stencil->paint('about_page');	
	}

	public function send_message()
	{
	

		
			$config = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|trim|xss_clean'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim|xss_clean|valid_email'
			),
			array(
				'field' => 'message',
				'label' => 'Message',
				'rules' => 'required|trim|xss_clean'
			),
		);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-error"><i class="fa fa-exclamation-triangle"></i>&nbsp;','</p>');

			if($this->form_validation->run() == FALSE) {

				$data = array(
					'check' => FALSE,
					'msg'   => validation_errors()
				);

				echo json_encode($data);
			}else {

				$post = array(
				'name' 		=> strip_tags($this->input->post('name',TRUE),ENT_QUOTES),
				'email'		=> strip_tags($this->input->post('email',TRUE),ENT_QUOTES),
				'subject'	=> strip_tags($this->input->post('subject',TRUE),ENT_QUOTES),
				'message'	=> strip_tags($this->input->post('message',TRUE),ENT_QUOTES)
				);

				$query = $this->message_m->insert($post);

				if($query)
				{
					$this->session->set_flashdata('msg_success', 'Success, Message Sent. Thanks '.$this->input->post('name',TRUE)); 
					$data = array(
						'status' => TRUE
					);
				}
				else
				{
					$data = array(
						'status' => FALSE,
						'msg'	=> 'Ada Kesalahan pada sistem'
					);
				}

				echo json_encode($data);
				
			} 
		 
	}

	public function recaptcha($recaptcha)
	{
		$google_url="https://www.google.com/recaptcha/api/siteverify";
		$secret='6LcuO_8SAAAAAEmkgn2ZTMqEd3r6mmE5PuCFXbtu';
		$ip= $_SERVER['REMOTE_ADDR'];
		$url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
		$res=$this->get_curl_data($url);
		$res= json_decode($res, true);
		//reCaptcha success check 
		if($res['success'] == TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}

	function get_curl_data($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		//curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
		$curlData = curl_exec($curl);
		curl_close($curl);
		return $curlData;
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
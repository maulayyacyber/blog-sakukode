<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->theme('frontend');
		$this->stencil->layout('single_layout');
		$this->stencil->slice('head');
		$this->stencil->slice('navbar');
		$this->stencil->slice('contact');
		$this->stencil->slice('script');
		$this->stencil->title('Portfolio');

		$this->load->model('portofolio_m');
	}

	public function index()
	{
		$data['portfolios'] = $this->portofolio_m->order_by('portofolio_id','DESC')->get_custom('portofolio_name,url,picture,description');

		$this->stencil->data($data);
		$this->stencil->paint('portfolio_page');
	}

}

/* End of file portfolio.php */
/* Location: ./application/controllers/portfolio.php */
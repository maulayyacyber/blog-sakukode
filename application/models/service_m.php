<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_m extends MY_Model {

	public $primary_key = 'service_id';
	protected $soft_delete = TRUE;

	public function add_service($icon,$img)
	{
		$servname	= $this->input->post('serv-name');
		$servslug 	= strtolower(url_title($servname));
		$shortdesc	= $this->input->post('short-desc');
		$desc		= $this->input->post('desc');

		$data = array(
			'service_name'		=> strip_tags($servname,ENT_QUOTES),
			'service_slug'		=> strip_tags($servslug,ENT_QUOTES),
			'img_icon'			=> strip_tags($icon,ENT_QUOTES),
			'img_header'		=> strip_tags($img,ENT_QUOTES),
			'short_desc'		=> htmlentities($shortdesc,ENT_QUOTES,"UTF-8"),
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->insert($data);
	}

	public function update_service($id)
	{
		$servname	= $this->input->post('serv-name');
		$servslug 	= strtolower(url_title($servname));
		$shortdesc	= $this->input->post('short-desc');
		$desc		= $this->input->post('desc');

		$data = array(
			'service_name'		=> strip_tags($servname,ENT_QUOTES),
			'service_slug'		=> strip_tags($servslug,ENT_QUOTES),
			'short_desc'		=> htmlentities($shortdesc,ENT_QUOTES,"UTF-8"),
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$file,$path)
	{
		$data = array(
			'img_header' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}

	public function update_icon($id,$file,$path)
	{
		$data = array(
			'img_icon' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}
	

}

/* End of file service_m.php */
/* Location: ./application/models/service_m.php */
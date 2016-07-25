<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_M extends MY_Model {

	public $primary_key = "company_id";
	protected $soft_delete = TRUE;

	public function update_logo($id,$file,$path)
	{
		$data = array(
			'logo' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}

}

/* End of file company_M.php */
/* Location: ./application/models/company_M.php */
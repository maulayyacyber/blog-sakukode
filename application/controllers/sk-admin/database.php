<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Database');
		
	}

	public function index()
	{
		$this->stencil->paint('database');
	}

	public function backup($type)
	{
		$this->load->library('backup');
 
		$result = $this->backup->backup();
		 
		// Return in string and force client to download the file
		$this->load->helper('download');
		//print_r($result);
		//exit();
		$date = date("Y-m-d H:i:s");
		if($type == 'sql')
		{
			force_download('dbangmin'.$date.'.sql', $result);	
		}elseif($type == 'gz')
		{
			force_download('dbangmin'.$date.'.sql.gz', $result);
		}else{
			redirect('sk-admin/database');
		}
		
	}

}

/* End of file database.php */
/* Location: ./application/controllers/sk-admin/database.php */
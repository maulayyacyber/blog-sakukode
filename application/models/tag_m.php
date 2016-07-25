<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag_m extends MY_Model {

	public function select_tag($key)
	{
		$this->db->select('tag');
		$this->db->like('tag',$key);

		return $this;
	}

}

/* End of file tag_m.php */
/* Location: ./application/models/tag_m.php */
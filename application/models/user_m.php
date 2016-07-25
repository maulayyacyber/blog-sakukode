<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

	public $primary_key = 'id';

	
	public function get_one($id)
	{
		$query = $this->db->select('users.username,users.active,users_groups.group_id')
						  ->from('users')
						  ->join('users_groups','users_groups.user_id=users.id')
						  ->where('users.id',$id)
						  ->get();

		if($query->num_rows == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}

}

/* End of file user_m.php */
/* Location: ./application/models/user_m.php */
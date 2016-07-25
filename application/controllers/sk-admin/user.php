<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->stencil->title('User');
		$this->load->helper('label');
		$this->load->model(array('user_m','group_m','users_group_m'));
	}

	/*
		=============================================
		method : INDEX (Load Page Index)
		=============================================
	*/

	public function index()
	{
		$this->style_table();
		//prepare data
		$data['path_add'] 		= 'sk-admin/user/add';
		$data['path_table']		= 'sk-admin/user/get_all';
		$data['header_table']	= array('check','Name','Email','Job','Status','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "300px", "aTargets": [ 1 ] },
          					 { "sWidth": "100px", "aTargets": [ 5 ] },';
		$this->stencil->data($data);
		//set page view
		$this->stencil->paint('general/table');
	}
	

	/*
		=============================================
		method : GET ALL (Select all data from table)
		=============================================
	*/

	public function get_all()
	{
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select("id,first_name,last_name,email,job,active")
						 ->from('users')
						 ->edit_column('check','<input type="checkbox" value="$1">','id')
						 ->edit_column('first_name','$1 $2','first_name,last_name')
						 ->unset_column('last_name')
						 ->edit_column('active','$1','label_user(active)')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','delete')),'id');

		echo $this->datatables->generate();
	}


	/*
		=================
		method : VIEW
		=================
	*/
	public function view($user_id)
	{
		if(!isset($user_id)) redirect('sk-admin/user');

		$id = $this->security->xss_clean($user_id);

		$result = $this->user_m->get_by('id',$id);

		if(!empty($result))
		{
			$status = ($result->active == 1) ? 'ACTIVE' : 'INACTIVE';
			$group  = $this->ion_auth->get_users_groups($id)->row();
			$arr_result = array(
				'Firstname' => $result->first_name,
				'Lastname'	=> $result->last_name,
				'Email'		=> $result->email,
				'Job'		=> $result->job,
				'Phone'		=> $result->phone,
				'Status'	=> $status,
				'Group'		=> $group->name
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/user';
		$data['id']				= $id;
		$this->stencil->data($data);
		$this->stencil->paint('general/detail');
	}


	/*
		============================
		method : ADD (Load Form Add)
		============================
	*/
	public function add()
	{
		$data['groups'] = $this->group_m->get_all();
		$this->stencil->data($data);
		$this->stencil->paint('form/user');
	}
	/*
		============================
		method : EDIT (Load Form Add)
		============================
	*/
	public function edit($id)
	{
		if(!isset($id)) redirect('sk-admin/user');
		
		$result = $this->user_m->get_one($id);
		
		if(!empty($result))
		{
			$data = array(
				'check' 	=> TRUE,
				'user_id'	=> $id,
				'username'	=> $result->username,
				'status'	=> $result->active,
				'group_id'	=> $result->group_id,
				'groups'	=> $this->group_m->get_all()
			);
		}
		else
		{
			$data = array('check' => FALSE);
		}
	
		$this->stencil->data($data);
		$this->stencil->paint('form/user_edit');
	}
	/*
		=================
		method : DELETE
		=================
	*/
	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/user','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->user_m->delete($id);
			if($q)
			{			
				$data = array(
					'status' => TRUE,
					'msg' =>  "Data has been deleted."
				);

				echo json_encode($data);
			}
			else
			{
				$data = array(
					'status' => FALSE,
					'msg'  => "Failed deleted data "
				);

				echo json_encode($data);
			}
		}
		else if(empty($id))
		{
			$data = array(
				'status' => FALSE,
				'msg' => "Error System"
			);

			echo json_encode($data);
		}
	}

	/*
		======================================================
		method : DELETE MANY (process delete many data)
		======================================================
	*/
	public function delete_many()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/user','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->user_m->delete_many($id);

		if($q)
		{
			$data = array(
				'status' => TRUE,
				'msg' => "Data has been deleted"
			);
			echo json_encode($data);
		}else
		{
			$data = array(
				'status' => FALSE,
				'msg' => "Failed Delete"
			);

			echo json_encode($data);
		}
	}

	/*
		=============================================================
		method : SAVE (Proses validation form and insert/update data)
		=============================================================
	*/
	public function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/user','refresh');

		$tables = $this->config->item('tables','ion_auth');
		//validate form input
		$this->form_validation->set_rules('first-name', 'Firstname', 'required|xss_clean');
		$this->form_validation->set_rules('last-name', 'Lastname', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique['.$tables['users'].'.username]');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('group', 'Group', 'xss_clean');
		$this->form_validation->set_rules('Job', 'Job', 'xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
		$this->form_validation->set_rules('conf-password', 'Password Confirm', 'required|matches[password]');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');


		//validation form true
		
		if($this->form_validation->run() == TRUE)
		{
			$load 		= $this->input->post('submit');

			$username = $this->input->post('username');
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');
			$group    = $this->input->post('group');

			$group_ids = array($group);

			$additional_data = array(
				'first_name' => $this->input->post('first-name'),
				'last_name'  => $this->input->post('last-name'),
				'job'    => $this->input->post('job'),
				'phone'      => $this->input->post('phone'),
			);	

			$check = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);

			if($check)
			{
				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', ''.$this->ion_auth->messages().' '.anchor('/sk-admin/user/add', 'Add User').'');	
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> TRUE,
					'status'	=> TRUE,
					'msg'		=> $this->ion_auth->messages().' '.anchor('/sk-admin/user', 'Go back to list').'',
				);
			}
			else
			{
				//return error message
				$data = array(
					'status'	=> FALSE,
					'msg'		=> $this->ion_auth->errors()
				);
			}

			echo json_encode($data);
		}
		else //validation form false
		{
			

			//return error message
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);		
		}
	}

	/*
		=============================================================
		method : UPDATE ()
		=============================================================
	*/

	public function update()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/user','refresh');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('active', 'Status', 'trim|required|xss_clean');
		$this->form_validation->set_rules('group', 'Group', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$data =array(
				'status' => FALSE,
				'msg'	=> validation_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$load = $this->input->post('submit');

			$userid = $this->input->post('user-id');
			$active = $this->input->post('active');
			$group  = $this->input->post('group');

			$post1 = array('active' => $active);
			$post2 = array('group_id'=> $group);

			$this->user_m->update($userid,$post1);
			$this->users_group_m->update_by(array('user_id'=>$userid),$post2);

			if($load == 1)
			{
				$this->session->set_flashdata('notif-success', ''.$this->ion_auth->messages().' '.anchor('/sk-admin/user/add', 'Add User').'');	
			}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'Success Updated user '.anchor('/sk-admin/user', 'Go back to list').'',
				);

			echo json_encode($data);
		}
	}


}

/* End of file user.php */
/* Location: ./application/controllers/sk-admin/user.php */
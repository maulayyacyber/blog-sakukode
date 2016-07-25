<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends MY_Controller {

	protected $path_img = "./uploads/img/teams";

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Team');
		$this->load->model('team_m');
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
		$data['path_add'] 		= 'sk-admin/team/add';
		$data['path_table']		= 'sk-admin/team/get_all';
		$data['header_table']	= array('check','Name','Email','Job','Photo','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,3,4,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "80px", "aTargets": [ 4 ] },
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
		$this->datatables->select('team_id,firstname,email,job,picture')
						 ->from('teams')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','team_id')
						 ->edit_column('picture',$this->_img('uploads/img/teams/$1',70,60),'picture')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','picture','delete')),'team_id');

		echo $this->datatables->generate();
	}

	/*
		=================
		method : VIEW
		=================
	 */


	public function view($team_id)
	{
		if(!isset($team_id)) redirect('sk-admin/team');

		$id = $this->security->xss_clean($team_id);

		$result = $this->team_m->get_by('team_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'firstname' => $result->firstname,
				'lastname'	=> $result->lastname,
				'email'		=> $result->email,
				'job'		=> $result->job,
				'facebook'	=> $result->fb_account,
				'twitter'	=> $result->twitter_account,
				'picture'	=> $this->_img('uploads/img/teams/'.$result->picture,100,100),
				'testimony'	=> $result->description
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/team/edit/'.$id;
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
		//prepare data form
		$data = array(
			'check'		=> TRUE,
			'teamid'	=> NULL,
			'fname'		=> '',
			'lname'		=> '',
			'email'		=> '',
			'job'		=> '',
			'fb'		=> '',
			'twitter'	=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/team');
	}

	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	 */
	public function edit($team_id)
	{
		if(!isset($team_id)) redirect('sk-admin/team');

		$id = $this->security->xss_clean($team_id);
		$result = $this->team_m->get_by('team_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> TRUE,
				'teamid'	=> $result->team_id,
				'fname'		=> $result->firstname,
				'lname'		=> $result->lastname,
				'email'		=> $result->email,
				'job'		=> $result->job,
				'fb'		=> $result->fb_account,
				'twitter'	=> $result->twitter_account,
				'picture'	=> $result->picture,
				'desc'		=> $result->description,
				'btn_submit'=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> FALSE
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/team');
	}

	/*
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	 */

	public function change_picture($teamid)
	{
		if(!isset($team_id)) redirect('sk-admin/team');
		
		$id = $this->security->xss_clean($teamid);

		$result = $this->team_m->get_custom_by('team_id,picture','team_id',$id);

		$data = array(
			'path' 			=> $this->path_img.'/'.$result->picture,
			'path_action'	=> 'sk-admin/team/update_picture',
			'id'			=> $id,
			'picture'		=> $result->picture
		);
		$this->stencil->data($data);
		$this->stencil->paint('general/picture_form');
	}


	/*
		=================
		method : DELETE
		=================
	 */

	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/team','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->team_m->delete($id);
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
		method : UPDATE PICTURE (process save/update picture)
		======================================================
	 */

	public function update_picture()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/team','refresh');

		$newname    = strtolower(url_title($this->input->post('newname')));
		$filename 	= $this->input->post('filename');
		$path 		= $this->input->post('path');
		$load 		= $this->input->post('submit');
		$id         = $this->input->post('id');
		$pict = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= $this->path_img;
		$config['allowed_types']= 'gif|jpg|png|jpeg';		
		$config['max_size']     = '300';
		$config['max_width']  	= '700';
		$config['max_height']  	= '700';
		if(!empty($newname)){
			$config['file_name']    = $newname;
		}
			
		$this->upload->initialize($config);

		if(!$this->upload->do_upload($pict))
		{
			$data = array(
				'status' => FALSE,
				'msg'	 => $this->upload->display_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$upload = $this->upload->data();
			$file = $upload['file_name'];

			$this->team_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url($this->path_img.'/'.$file),
				'file'		=> $file,
				'load'		=> $load,
				'status'	=> TRUE,
				'msg'		=> 'Picture has been successfully changed. '.anchor('/sk-admin/'.$this->router->fetch_class().'', 'Go back to list').'',
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/team','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->team_m->delete_many($id);

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
		============================================================
		method : CHECK EMAIL (process checking exist email on table)
		===========================================================
	 */
	
	public function check_email($str)
	{
		$id = $this->input->post('team-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'teams';
			$cond = array('email'=>$str);

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_email','The Email is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
		}
	}



	/*
		=============================================================
		method : SAVE (Proses validation form and insert/update data)
		=============================================================
	 */

	function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/team','refresh');

		$this->form_validation->set_rules('fname', 'Firstname', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('lname', 'Lastname', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[70]|valid_email|xss_clean|callback_check_email');
		$this->form_validation->set_rules('job', 'Job', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('fb', 'Facebook', 'trim|required|min_length[5]|max_length[70]|prep_url|xss_clean');
		$this->form_validation->set_rules('twitter', 'Twitter', 'min_length[5]|max_length[70]|prep_url|xss_clean');
		$this->form_validation->set_rules('desc', 'Testimony', 'min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');

		$pic = 'picture';

		//validation form false
		if($this->form_validation->run() == FALSE)
		{
			//return error message
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}
		else //validation form true
		{
			$id 	= $this->input->post('team-id');
			$load 	= $this->input->post('submit');
			$fname  = $this->input->post('fname');
			$lname  = $this->input->post('lname');
			$file   = strtolower($fname.'-'.$lname);

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= $this->path_img;
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
				$config['overwrite'] = FALSE;
		        $config['max_size']     = '300';
		        $config['max_width']  	= '700';
		        $config['max_height']  	= '700';
					
				$this->upload->initialize($config);
					//validation upload false
					if(!$this->upload->do_upload($pic))
					{
						$data = array(
							'status'	=> 'error-upload',
							'msg'		=> $this->upload->display_errors()
						);

						echo json_encode($data);
					}
					else//validation upload true/success
					{
						$upload	   = $this->upload->data();
						$filename  = $upload['file_name']; 
						//call method to insert table
						$this->team_m->add_team($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/team/add', 'Add Team').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/team', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->team_m->update_team($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/team/edit/'.$id , 'Edit Team').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/team', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}



}

/* End of file team.php */
/* Location: ./application/controllers/sk-admin/team.php */
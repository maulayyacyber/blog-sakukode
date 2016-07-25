<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->stencil->title('Dashboard');
		$this->load->model(array('company_m','ion_auth_model','user_m'));
	}

	public function index()
	{
		//load model
		$this->load->model(array('blog_article_m','team_m','portofolio_m','message_m'));
		//get data from model
		$data['total_article']	 	= $this->blog_article_m->count_all();
		$data['total_product']		= $this->portofolio_m->count_all();
		$data['total_team']			= $this->team_m->count_all();
		$data['total_message']		= $this->message_m->count_all();
		$this->stencil->data($data);
		$this->stencil->paint('dashboard/index');
	}


	public function edit_company($id_post)
	{
		if(!isset($id_post)) redirect('sk-admin');
		$id = $this->security->xss_clean($id_post);

		$result = $this->company_m->get_by('company_id',$id);


		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> TRUE,
				'company_id'	=> $id,
				'company_name'	=> $result->company_name,
				'tagline'		=> $result->tagline,
				'email'			=> $result->email,
				'url'			=> $result->url,
				'address'		=> $result->address,
				'phone'			=> $result->phone,
				'hp'			=> $result->hp,
				'profile'		=> $result->profile,
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
		$this->stencil->paint('dashboard/form');
	}

	public function change_logo($company_id)
	{
		if(!isset($company_id)) redirect('sk-admin');
		
		$id = $this->security->xss_clean($company_id);

		$result = $this->company_m->get_custom_by('company_id,logo','company_id',$id);

		$data = array(
			'path' 			=> 'uploads/img/logo/'.$result->logo,
			'path_action'	=> 'sk-admin/dashboard/update_logo',
			'id'			=> $id,
			'picture'		=> $result->logo
		);
		$this->stencil->data($data);
		$this->stencil->paint('general/picture_form');
	}

	public function update_company()
	{

		if (!$this->input->is_ajax_request()) redirect('sk-admin','refresh');

		$this->form_validation->set_rules('company-name', 'Company Name', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('tagline', 'Tagline', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|min_length[5]|xss_clean|prep_url');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|min_length[5]|xss_clean');
		$this->form_validation->set_rules('hp', 'Hp', 'trim|min_length[5]|xss_clean|numeric');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('profile', 'Profile', 'trim|required|min_length[10]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');


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
			$id 		= $this->security->xss_clean($this->input->post('company-id'));
			$load 		= $this->input->post('submit');
			$comp_name 	= ucwords($this->input->post('company-name'));
			$tagline  	= $this->input->post('tagline');
			$email 		= $this->input->post('email');
			$url 		= $this->input->post('url');
			$address 	= $this->input->post('address');
			$phone 		= $this->input->post('phone');
			$hp 		= $this->input->post('hp');
			$profile 	= $this->input->post('profile');
			
				//action edit
				//call method to update table
				$post = array(
					'company_name'	=> strip_tags($comp_name,ENT_QUOTES),
					'tagline'		=> strip_tags($tagline,ENT_QUOTES),
					'email'			=> strip_tags($email,ENT_QUOTES),
					'url'			=> strip_tags($url,ENT_QUOTES),
					'phone'			=> strip_tags($phone,ENT_QUOTES),
					'hp'			=> strip_tags($hp,ENT_QUOTES),
					'address'		=> htmlentities($address,ENT_QUOTES,"UTF-8"),
					'profile'		=> htmlentities($profile,ENT_QUOTES,"UTF-8")
				);

				$this->company_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/dashboard/edit/'.$id , 'Edit Company Profile').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/dashboard', 'Go back to list').'',
					);

					echo json_encode($data);
			
				
		}
	}


	public function update_logo()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin','refresh');

		$newname    = strtolower(url_title($this->input->post('newname')));
		$filename 	= $this->input->post('filename');
		$path 		= $this->input->post('path');
		$load 		= $this->input->post('submit');
		$id         = $this->security->xss_clean($this->input->post('id'));
		$pict = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= "./uploads/img/logo";
		$config['allowed_types']= 'gif|jpg|png|jpeg';		
		$config['max_size']     = '100';
		$config['max_width']  	= '200';
		$config['max_height']  	= '80';
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

			$this->company_m->update_logo($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/uploads/img/logo/'.$file,
				'file'		=> $file,
				'load'		=> $load,
				'status'	=> TRUE,
				'msg'		=> 'Picture has been successfully changed. '.anchor('/sk-admin/'.$this->router->fetch_class().'', 'Go back to list').'',
			);

			echo json_encode($data);
		}

	}

	public function user_profile()
	{
		$id = $this->ion_auth->get_user_id();

		$result = $this->user_m->get_by('id',$id);

		if(!empty($result))
		{
			$status = ($result->active == 1) ? 'ACTIVE' : 'INACTIVE';
			$group  = $this->ion_auth->get_users_groups($id)->row();
			$arr_result = array(
				'Username'	=> $result->username,
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
		$data['id']				= $id;
		$this->stencil->data($data);
		$this->stencil->paint('dashboard/user_detail');
	}

	public function edit_user()
	{
		$id = $this->ion_auth->get_user_id();

		$result = $this->user_m->get_by('id',$id);

		if(!empty($result))
		{
			$status = ($result->active == 1) ? 'ACTIVE' : 'INACTIVE';
			$data = array(
				'username'	=> $result->username,
				'firstname' => $result->first_name,
				'lastname'	=> $result->last_name,
				'email'		=> $result->email,
				'job'		=> $result->job,
				'phone'		=> $result->phone
			);
		}else
		{
			$data = array();
		}

		$this->stencil->data($data);
		$this->stencil->paint('dashboard/user_form');

	}

	public function save_user()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin','refresh');

		$this->form_validation->set_rules('first-name', 'Firstname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last-name', 'Lastname', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('job', 'Job', 'xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');

		if($this->form_validation->run() == FALSE) //validation error
		{
			//return error message
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}else
		{
			//validation ok
			//action add
				$post = array(
					'first_name'	=> strip_tags($this->input->post('first-name'),ENT_QUOTES),
					'last_name'		=> strip_tags($this->input->post('last-name'),ENT_QUOTES),
					'email'			=> strip_tags($this->input->post('email'),ENT_QUOTES),
					'job'			=> strip_tags($this->input->post('job'),ENT_QUOTES),
					'phone'			=> strip_tags($this->input->post('phone'),ENT_QUOTES)
				);

				$load = $this->input->post('submit');

				$id = $this->ion_auth->get_user_id();

				$this->user_m->update($id,$post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Profile has been updated.');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> FALSE,
							'status'	=> TRUE,
							'msg'		=> 'Profile has been updated. '.anchor('/sk-admin/dashboard/user-profile', 'Go back').'',
						);

						echo json_encode($data);
		}
	}

	public function change_password()
	{
		$this->stencil->paint('dashboard/password_form');
	}

	public function save_password()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin','refresh');

		$this->form_validation->set_rules('old-password', 'Old Password', 'required|xss_clean');
		$this->form_validation->set_rules('new-password', 'New Password', 'required|xss_clean|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
		$this->form_validation->set_rules('conf-password', 'Password Confirm', 'required|xss_clean|matches[new-password]');

		if($this->form_validation->run() == FALSE) //validation error
		{
			//return error message
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}
		else //validation ok
		{
			$identity = $this->session->userdata('identity');

			$load = $this->input->post('submit');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old-password'), $this->input->post('new-password'));
		
			if($change)
			{
				if($load == 1)
				{
					$this->session->set_flashdata('notif-success',$this->ion_auth->messages());
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> TRUE,
					'status'	=> TRUE,
					'msg'		=> $this->ion_auth->messages().' '.anchor('/sk-admin/dashboard/user-profile', 'Go back').'',
					);

				echo json_encode($data);
			}
			else
			{
				//return error message
				$data = array(
					'status'	=> FALSE,
					'msg'		=> $this->ion_auth->errors()
				);

				echo json_encode($data);	
			}
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
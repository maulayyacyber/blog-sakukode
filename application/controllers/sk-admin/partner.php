<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends MY_Controller {

	protected $path_img = "./uploads/img/partners";

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Partner');
		$this->load->model('client_m');
	}

	/*
		=============================================
		method : INDEX (Load Page Index)
		=============================================
	 */
	public function index()
	{	
		//set css and js
		$this->style_table();
		//prepare data
		$data['path_add'] 		= 'sk-admin/partner/add';
		$data['path_table']		= 'sk-admin/partner/get_all';
		$data['header_table']	= array('check','Company','Contact Person','EMail','Phone','Hp','Picture','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,3,4,5,6,7 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "80px", "aTargets": [ 6 ] },
          					 { "sWidth": "120px", "aTargets": [ 7 ] },';
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
		//$path_pic = 'assets/img/portofolio/';
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select('client_id,company,contact_person,email,phone,hp,picture,')
						 ->from('clients')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','client_id')
						 ->edit_column('picture',$this->_img('uploads/img/partners/$1',70,60),'picture')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','picture','delete')),'client_id');

		echo $this->datatables->generate();
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
			'partner_id'=> NULL,
			'company'	=> '',
			'contact'	=> '',
			'email'		=> '',
			'phone'		=> '',
			'hp'		=> '',
			'url'		=> '',
			'address_1'	=> '',
			'address_2'	=> '',
			'picture'	=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/partner');
	}

	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	 */
	public function edit($client_id)
	{
		if(!isset($client_id)) redirect('sk-admin/partner');

		$id = $this->security->xss_clean($client_id);
		$result = $this->client_m->get_by('client_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> TRUE,
				'partner_id'=> $result->client_id,
				'company'	=> $result->company,
				'contact'	=> $result->contact_person,
				'email'		=> $result->email,
				'phone'		=> $result->phone,
				'hp'		=> $result->hp,
				'url'		=> $result->url,
				'address_1'	=> $result->address_1,
				'address_2'	=> $result->address_2,
				'picture'	=> $result->picture,
				'btn_submit'=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> FALSE,
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/partner');
	}


	/*
		=============================================================
		method : SAVE (Proses validation form and insert/update data)
		=============================================================
	 */


	function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/partner','refresh');
		
		$this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[5]|xss_clean|callback_check_company');
		$this->form_validation->set_rules('contact', 'Contact Person', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('hp', 'Hp', 'trim|min_length[11]|xss_clean|numeric');
		$this->form_validation->set_rules('address-1', 'Address 1', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|xss_clean|prep_url');
		$this->form_validation->set_rules('address-2', 'Address 2', 'min_length[5]|xss_clean');

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
			$id 	 = $this->input->post('partner-id');
			$load 	 = $this->input->post('submit');
			$company = $this->input->post('company');
			$file    = strtolower(url_title($company));

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
						$this->client_m->add_client($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/partner/add', 'Add Client').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/partner', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->client_m->update_client($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/partner/edit/'.$id , 'Edit Client').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/partner', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/*
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	 */

	public function change_picture($client_id)
	{
		if(!isset($client_id)) redirect('sk-admin/partner');
		
		$id = $this->security->xss_clean($client_id);

		$result = $this->client_m->get_custom_by('client_id,picture','client_id',$id);

		$data = array(
			'path' 			=> $this->path_img.'/'.$result->picture,
			'path_action'	=> 'sk-admin/partner/update_picture',
			'id'			=> $id,
			'picture'		=> $result->picture
		);
		$this->stencil->data($data);
		$this->stencil->paint('general/picture_form');
	}

	/*
		======================================================
		method : UPDATE PICTURE (process save/update picture)
		======================================================
	 */
	
	public function update_picture()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/partner','refresh');
		
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
		$config['overwrite']	= TRUE;
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

			$this->client_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().$this->path_img.'/'.$file,
				'file'		=> $file,
				'load'		=> $load,
				'status'	=> TRUE,
				'msg'		=> 'Picture has been successfully changed. '.anchor('/sk-admin/'.$this->router->fetch_class().'', 'Go back to list').'',
			);

			echo json_encode($data);
		}

	}

	/*
		=================
		method : DELETE
		=================
	 */

	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/partner','refresh');
		
		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->client_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/partner','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->client_m->delete_many($id);

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

}

/* End of file partner.php */
/* Location: ./application/controllers/sk-admin/partner.php */
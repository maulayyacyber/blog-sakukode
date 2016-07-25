<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends MY_Controller {

	protected $path_img ="./uploads/img/services/full";
	protected $path_icon = "./uploads/img/services/icons";

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Service');
		$this->load->model('service_m');
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
		$data['path_add'] 		= 'sk-admin/service/add';
		$data['path_table']		= 'sk-admin/service/get_all';
		$data['header_table']	= array('check','Service Name','Image Icon','Short Description','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,3,4 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "80px", "aTargets": [ 2 ] },
          					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "130px", "aTargets": [ 4 ] },';
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
		$this->datatables->select('service_id,service_name,img_icon,short_desc')
						 ->from('services')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','service_id')
						 ->edit_column('img_icon',$this->_img('uploads/img/services/icons/$1',70,60),'img_icon')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','picture','icon','delete')),'service_id');

		echo $this->datatables->generate();
	}
	/*
		=================
		method : VIEW
		=================
	*/
	public function view($serv_id)
	{
		if(!isset($serv_id)) redirect('sk-admin/service');

		$id = $this->security->xss_clean($serv_id);

		$result = $this->service_m->get_by('service_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'service name' 	=> $result->service_name,
				'service slug'	=> $result->service_slug,
				'short description'	=> $result->short_desc,
				'description'		=> $result->description,
				'image icon'		=> $this->_img('uploads/img/services/icons/'.$result->img_icon,100,100),
				'image header'		=> $this->_img('uploads/img/services/full/'.$result->img_header)
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/service/edit/'.$id;
		$data['id']				= $id;
		$this->stencil->data($data);
		$this->stencil->paint('general/detail');
	}
	/*
		=================
		method : DELETE
		=================
	 */

	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/service','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->service_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/service','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->service_m->delete_many($id);

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
		============================
		method : ADD (Load Form Add)
		============================
	*/
	public function add()
	{
		//prepare data form
		$data = array(
			'check'		=> TRUE,
			'serv_id'	=> NULL,
			'serv_name'	=> '',
			'img_icon'	=> '',
			'img_header'=> '',
			'short_desc'=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/service');
	}

	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	*/
	public function edit($serv_id)
	{
		if(!isset($serv_id)) redirect('sk-admin/service');

		$id = $this->security->xss_clean($serv_id);
		$result = $this->service_m->get_by('service_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> TRUE,
				'serv_id'	=> $result->service_id,
				'serv_name'	=> $result->service_name,
				'img_icon'	=> $result->img_icon,
				'img_header'=> $result->img_header,
				'short_desc'=> $result->short_desc,
				'desc'		=> $result->description,
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
		$this->stencil->paint('form/service');
	}
	/*
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	*/
	public function change_picture($servid)
	{
		if(!isset($servid)) redirect('sk-admin/service');
		
		$id = $this->security->xss_clean($servid);

		$result = $this->service_m->get_custom_by('service_id,img_header','service_id',$id);

		$data = array(
			'path' 			=> $this->path_img.'/'.$result->img_header,
			'path_action'	=> 'sk-admin/service/update_picture',
			'id'			=> $id,
			'picture'		=> $result->img_header
		);
		$this->stencil->data($data);
		$this->stencil->paint('general/picture_form');
	}
	/*

	/*
		======================================================
		method : UPDATE PICTURE (process save/update picture)
		======================================================
	 */

	public function update_picture()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/service','refresh');

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

			$this->service_m->update_picture($id,$file,$path);

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
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	*/
	public function change_icon($servid)
	{
		if(!isset($servid)) redirect('sk-admin/service');

		$id = $this->security->xss_clean($servid);

		$result = $this->service_m->get_custom_by('service_id,img_icon','service_id',$id);

		$data = array(
			'path' 			=> $this->path_icon.'/'.$result->img_icon,
			'path_action'	=> 'sk-admin/service/update_icon',
			'id'			=> $id,
			'picture'		=> $result->img_icon
		);
		$this->stencil->data($data);
		$this->stencil->paint('general/picture_form');
	}

	/*
		======================================================
		method : UPDATE PICTURE (process save/update picture)
		======================================================
	 */

	public function update_icon()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/service','refresh');

		$newname    = strtolower(url_title($this->input->post('newname')));
		$filename 	= $this->input->post('filename');
		$path 		= $this->input->post('path');
		$load 		= $this->input->post('submit');
		$id         = $this->input->post('id');
		$pict = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= $this->path_icon;
		$config['allowed_types']= 'gif|jpg|png|jpeg';		
		$config['max_size']     = '100';
		$config['max_width']	= '260';
		$config['max_height']	= '240';
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

			$this->service_m->update_icon($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Icon has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url($this->path_icon.'/'.$file),
				'file'		=> $file,
				'load'		=> $load,
				'status'	=> TRUE,
				'msg'		=> 'Icon has been successfully changed. '.anchor('/sk-admin/'.$this->router->fetch_class().'', 'Go back to list').'',
			);

			echo json_encode($data);
		}

	}
	/*
		=============================================================
		method : CHECK NAME ()
		=============================================================
	*/
	public function check_name($str)
	{
		$id = $this->input->post('serv-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'services';
			$cond = array('service_name'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_name','Service Name is exist. Try another?');
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/service','refresh');

		$this->form_validation->set_rules('serv-name', 'Service Name', 'trim|required|min_length[5]|xss_clean|callback_check_name');
		$this->form_validation->set_rules('short-desc', 'Short Description', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');

		$icon = 'icon';
		$pic  = 'picture';
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
			$id 		= $this->input->post('serv-id');
			$load 		= $this->input->post('submit');
			$servname  	= $this->input->post('serv-name');
			$file   	= strtolower(url_title($servname));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= $this->path_icon;
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
				$config['overwrite'] = FALSE;
		        $config['max_size']     = '300';
		        $config['max_width']	= '260';
		        $config['max_height']	= '240';
					
				$this->upload->initialize($config);
					//validation upload false
					if(!$this->upload->do_upload($icon))
					{
						$data = array(
							'status'	=> FALSE,
							'msg'		=> $this->upload->display_errors()
						);

						echo json_encode($data);
					}
					else//validation upload true/success
					{
						$upload_icon	= $this->upload->data();
						$icon  	   		= $upload_icon['file_name']; 

						$cek_file = $_FILES[$pic];

						if($cek_file['name'] == '')
						{
							$img = '';
							//call method to insert table
							$this->service_m->add_service($icon,$img);
							if($load == 1){
								$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/service/add', 'Add service').'');
							
							}
								
							$data = array(
								'load'		=> $load,
								'clearForm'	=> TRUE,
								'status'	=> TRUE,
								'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/service', 'Go back to list').'',
							);

							echo json_encode($data);
						}
						else
						{
							$config2['upload_path']	= $this->path_img;
							$config2['allowed_types']= 'gif|jpg|png|jpeg';		
							$config2['max_size']     = '300';

							$this->upload->initialize($config2);

							if(!$this->upload->do_upload($pic))
							{
								$data = array(
									'status'	=> FALSE,
									'msg'		=> $this->upload->display_errors()
								);

								echo json_encode($data);
							}
							else
							{
								$upload_img = $this->upload->data();
								
								$img = $upload_img['file_name'];
								
								//call method to insert table
								$this->service_m->add_service($icon,$img);
								if($load == 1){
									$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/service/add', 'Add service').'');
								
								}
									
								$data = array(
									'load'		=> $load,
									'clearForm'	=> TRUE,
									'status'	=> TRUE,
									'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/service', 'Go back to list').'',
								);

								echo json_encode($data);
							}
						}
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->service_m->update_service($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/service/edit/'.$id , 'Edit Service').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/service', 'Go back to list').'',
					);

					echo json_encode($data);
			}
		}
	}


}

/* End of file service.php */
/* Location: ./application/controllers/sk-admin/service.php */
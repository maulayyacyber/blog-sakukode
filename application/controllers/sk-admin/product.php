<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {

	protected $path_img_full  = "./uploads/img/works/full";
	protected $path_img_thumb = "./uploads/img/works/thumb";

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Product');
		$this->load->model('portofolio_m');
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
		$data['path_add'] 		= 'sk-admin/product/add';
		$data['path_table']		= 'sk-admin/product/get_all';
		$data['header_table']	= array('check','Product Name','Picture','Url','Client','Description','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,4,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "80px", "aTargets": [ 2 ] },
          					 { "sWidth": "300px", "aTargets": [ 5 ] },
          					 { "sWidth": "120px", "aTargets": [ 6 ] },';
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
		$this->datatables->select('portofolio_id,portofolio_name,picture,url,client,description')
						 ->from('portofolios')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','portofolio_id')
						 ->edit_column('picture',$this->_img('uploads/img/works/thumb/$1',70,60),'picture')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','picture','delete')),'portofolio_id');

		echo $this->datatables->generate();
	}

	/*
		=================
		method : VIEW
		=================
	*/
	public function view($porto_id)
	{
		if(!isset($porto_id)) redirect('sk-admin/product');
		
		$id = $this->security->xss_clean($porto_id);
		$result = $this->portofolio_m->get_by('portofolio_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Product Name' 	=> $result->portofolio_name,
				'Url'			  	=> '<a href="'.$result->url.'" target="_BLANK">'.$result->url.'</a>',
				'Client'			=> $result->client,
				'Description'		=> $result->description,
				'Picture'			=> '<img src="'.base_url().$this->path_img_thumb.'/'.$result->picture.'" width="120px" height="100px" />'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/product/edit/'.$id;
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
			'porto_id'	=> NULL,
			'porto_name'=> '',
			'client'	=> '',
			'url'		=> '',
			'picture'	=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/product');
	}
	
	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	*/
	public function edit($porto_id)
	{
		if(!isset($porto_id)) redirect('sk-admin/product');

		$id = $this->security->xss_clean($porto_id);
		$result = $this->portofolio_m->get_by('portofolio_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> TRUE,
				'porto_id'	=> $id,
				'porto_name'=> $result->portofolio_name,
				'client'	=> $result->client,
				'url'		=> $result->url,
				'picture'	=> $result->picture,
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
		$this->stencil->paint('form/product');
	}

	

	/*
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	*/
	public function change_picture($porto_id)
	{
		if(!isset($porto_id)) redirect('sk-admin/product');

		$id = $this->security->xss_clean($porto_id);

		$result = $this->portofolio_m->get_custom_by('portofolio_id,picture','portofolio_id',$porto_id);

		$data = array(
			'path' 			=> $this->path_img_full.'/'.$result->picture,
			'path_action'	=> 'sk-admin/product/update_picture',
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/product','refresh');

		$newname    = strtolower(url_title($this->input->post('newname')));
		$filename 	= $this->input->post('filename');
		$path 		= $this->input->post('path');
		$load 		= $this->input->post('submit');
		$id         = $this->input->post('id');
		$pict       = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= $this->path_img_full;
		$config['allowed_types']= 'gif|jpg|png|jpeg';	
		$config['max_size']     = '500';
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
			$newfile = $upload['file_name'];

			//create thumbnail
			$config = array(
				'width'		=> 520,
				'height' 	=> 450,
				'x_axis' 	=> '0',
				'y_axis' 	=> '0',
				'new_path' 	=> $this->path_img_thumb
			);

			$result = $this->_resize_image($config,$upload);	

			$filename = $result['filename'];

			$this->portofolio_m->update_picture($id,$newfile,$filename);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().$this->path_img_full.'/'.$newfile,
				'file'		=> $newfile,
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/product','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->portofolio_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/product','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->portofolio_m->delete_many($id);

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
	function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/product','refresh');

		$this->form_validation->set_rules('porto-name', 'Product Name', 'trim|required|min_length[5]|xss_clean|callback_check_name');
		$this->form_validation->set_rules('client', 'Client', 'trim|min_length[4]|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|min_length[5]|xss_clean|prep_url');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]|xss_clean');


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
			$id 	= $this->input->post('porto-id');
			$load 	= $this->input->post('submit');
			$file   = strtolower(url_title($this->input->post('porto-name')));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= $this->path_img_full;
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
		        $config['max_size']     = '500';
					
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
						$newfile   = $upload['file_name'];

						//create thumbnail
						$config = array(
							'width'		=> 520,
							'height' 	=> 450,
							'x_axis' 	=> '0',
							'y_axis' 	=> '0',
							'new_path' 	=> $this->path_img_thumb
						);

						$result = $this->_resize_image($config,$upload);	

						$filename = $result['filename'];
 
						//call method to insert table
						$this->portofolio_m->add_portofolio($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/product/add', 'Add Portofolio').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/product', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->portofolio_m->update_portofolio($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/product/edit/'.$id , 'Edit Portofolio').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/product', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}


}

/* End of file product.php */
/* Location: ./application/controllers/sk-admin/product.php */
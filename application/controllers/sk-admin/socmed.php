<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socmed extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Social Media');
		$this->load->model('socmed_m');
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
	
		$data['path_add'] 		= 'sk-admin/socmed/add';
		$data['path_table']		= 'sk-admin/socmed/get_all';
		$data['header_table']	= array('check','Social Media','Icon','Url','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,4 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "120px", "aTargets": [ 4 ] },';
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
		$this->datatables->select('socmed_id,socmed_name,icon,url')
						 ->from('socmeds')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','socmed_id')
						 ->edit_column('url','<a href="$1" target="_BLANK">$1</a>','url')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','delete')),'socmed_id');

		echo $this->datatables->generate();
	}


	/*
		=================
		method : VIEW
		=================
	 */

	public function view($socmed_id)
	{
		if(!isset($socmed_id)) redirect('sk-admin/socmed');

		$id = $this->security->xss_clean($socmed_id);
		$result = $this->socmed_m->get_by('socmed_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Social Media' 	=> $result->socmed_name,
				'Icon'			=> $result->icon,
				'Url'			=> '<a href="'.$result->url.'" target="_BLANK">'.$result->url.'</a>'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/socmed/edit/'.$id;
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
		$icons = $this->get_icon();
			//prepare data form
			$data = array(
				'check'			=> TRUE,
				'socmed_id'		=> '',
				'socmed_name'	=> '',
				'icons'			=> $icons,
				'url'			=> '',
				'btn_submit'	=> 'Save'
			);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/socmed');
	}
	
	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	 */
	public function edit($socmed_id)
	{
		if(!isset($socmed_id)) redirect('sk-admin/socmed');
		
		$id = $this->security->xss_clean($socmed_id);
		$result = $this->socmed_m->get_by('socmed_id',$id);
		$icons = $this->get_icon();

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> TRUE,
				'socmed_id'		=> $result->socmed_id,
				'socmed_name'	=> $result->socmed_name,
				'icon'			=> $result->icon,
				'icons'			=> $icons,
				'url'			=> $result->url,
				'btn_submit'	=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> FALSE,
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/socmed');
	}
	
	/*
		=================
		method : DELETE
		=================
	 */
	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/socmed','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->socmed_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/socmed','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->socmed_m->delete_many($id);

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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/socmed','refresh');

		$this->form_validation->set_rules('socmed-name', 'Social Media', 'trim|required|is_unique[socmeds.socmed_name]|xss_clean');
		$this->form_validation->set_rules('icon', 'Icon', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|min_length[5]|xss_clean|prep_url');

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
			$id 		= $this->input->post('socmed-id');
			$load 		= $this->input->post('submit');
			$socmedname	= ucwords($this->input->post('socmed-name'));
			$icon   	= $this->input->post('icon');
			$url 		= $this->input->post('url');

			if(empty($id))
			{
				//action add
				$post = array(
					'socmed_id'	=> NULL,
					'socmed_name'	=> strip_tags($socmedname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'url'			=> strip_tags($url,ENT_QUOTES)
				);

				$this->socmed_m->insert($post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/socmed/add', 'Add Social Media').'');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/socmed', 'Go back to list').'',
						);

						echo json_encode($data);
			}
			else
			{
				//action edit
				//call method to update table
				$post = array(
					'socmed_name'	=> strip_tags($socmedname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'url'			=> strip_tags($url,ENT_QUOTES)
				);

				$this->socmed_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/socmed/edit/'.$id , 'Edit Social Media').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/socmed', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}
	
	/*
		=============================================================
		method : GET ICON (load list icons from file icons.json)
		=============================================================
	 */
	public function get_icon()
	{
		$this->load->helper('file');

		$json = read_file('./assets/backend/js/icon.json');

		$result = json_decode($json);

		return $result;
	}



}

/* End of file socmed.php */
/* Location: ./application/controllers/sk-admin/socmed.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {


	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Category');
		$this->load->model('blog_category_m');
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
		$data['path_add'] 		= 'sk-admin/category/add';
		$data['path_table']		= 'sk-admin/category/get_all';
		$data['header_table']	= array('check','Category Name','Url','Description','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,3,4 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "90px", "aTargets": [ 4 ] },';
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
		$this->datatables->select('category_id,category_name,category_url,description')
						 ->from('blog_categories')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','category_id')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','delete')),'category_id');

		echo $this->datatables->generate();
	}


	/*
		=================
		method : VIEW
		=================
	 */
	public function view($category_id)
	{
		if(!isset($category_id)) redirect('sk-admin/category');
		
		$id = $this->security->xss_clean($category_id);
		$result = $this->blog_category_m->get_by('category_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Category Name' 	=> $result->category_name,
				'Category Url'		=> $result->category_url,
				'Description'		=> $result->description
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'sk-admin/category/edit/'.$id;
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
			'check'			=> TRUE,
			'category_id'	=> NULL,
			'category_name'	=> '',
			'desc'			=> '',
			'btn_submit'	=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/category');
	}
	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	*/
	public function edit($category_id)
	{
		if(!isset($category_id)) redirect('sk-admin/category');
		$id = $this->security->xss_clean($category_id);
		$result = $this->blog_category_m->get_by('category_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> TRUE,
				'category_id'	=> $result->category_id,
				'category_name'	=> $result->category_name,
				'desc'			=> $result->description,
				'btn_submit'	=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> FAlSE,
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('form/category');
	}


	/*
		=================
		method : DELETE
		=================
	*/
	public function delete()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/category','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->blog_category_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/category','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->blog_category_m->delete_many($id);

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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/category','refresh');

		$this->form_validation->set_rules('category-name', 'Category Name', 'trim|required|min_length[3]|xss_clean|is_unique[blog_categories.category_name]');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]|xss_clean');

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
			$id 		= $this->input->post('category-id');
			$load 		= $this->input->post('submit');
			$catname  	= ucwords($this->input->post('category-name'));
			$caturl 	= strtolower(url_title($this->input->post('category-name')));
			$desc 		= $this->input->post('desc');

			if(empty($id))
			{
				//action add
				$post = array(
					'category_id'	=> NULL,
					'category_name'	=> strip_tags($catname,ENT_QUOTES),
					'category_url'	=> strip_tags($caturl,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->blog_category_m->insert($post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/category/add', 'Add Blog Category').'');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/category', 'Go back to list').'',
						);

						echo json_encode($data);
			}
			else
			{
				//action edit
				//call method to update table
				$post = array(
					'category_name'	=> strip_tags($catname,ENT_QUOTES),
					'category_url'	=> strip_tags($caturl,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->blog_category_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/category/edit/'.$id , 'Edit Blog Category').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/category', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}



}

/* End of file category.php */
/* Location: ./application/controllers/sk-admin/category.php */
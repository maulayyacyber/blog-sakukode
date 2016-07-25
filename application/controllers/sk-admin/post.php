<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MY_Controller {

	protected $path_img 	= "./uploads/img/blogs/full";
	protected $path_thumb	= "./uploads/img/blogs/thumb";

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Post');

		$this->load->helper('label');

		$this->load->model(array('blog_article_m','blog_category_m','category_article_m','related_post_m'));
		$this->stencil->css('backend/css/bootstrap-tokenfield/bootstrap-tokenfield.min');
		$this->stencil->js('backend/js/bootstrap-typeahead.min');
		$this->stencil->js('backend/js/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min');
		$this->stencil->js('backend/js/plugins/ckeditor/ckeditor');
		$this->stencil->css('backend/css/token-input/token-input');
		$this->stencil->css('backend/css/token-input/token-input-facebook');
		$this->stencil->js('backend/js/plugins/token-input/jquery.tokeninput');
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

		$data['path_add'] 		= 'sk-admin/post/add';
		$data['path_table']		= 'sk-admin/post/get_all';
		$data['header_table']	= array('check','Title','Keyword','Author','Created','Updated','Status','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,7 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "240px", "aTargets": [ 1 ] },
          					 { "sWidth": "80px", "aTargets": [ 6 ] },
          					 { "sWidth": "100px", "aTargets": [ 7 ] },';
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

		$author_id = $this->ion_auth->get_user_id();
		//$path_pic = 'assets/img/portofolio/';
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select('article_id,article_title,keyword,username,created_at,updated_at,status')
						 ->from('blog_articles')
						 ->join('users','users.id=blog_articles.author_id')
						 ->where('blog_articles.deleted',0)
						 ->where('blog_articles.author_id',$author_id)
						 ->edit_column('check','<input type="checkbox" value="$1">','article_id')
						 ->edit_column('status','$1','label_post(status)')
						 ->add_column('Action',
				        	$this->_button('$1',array('view','edit','picture','delete')),'article_id');

		echo $this->datatables->generate();
	}

	/*
		=================
		method : VIEW
		=================
	 */
	public function view($article_id)
	{
		if(!isset($article_id)) redirect('sk-admin/post');

		$id = $this->security->xss_clean($article_id);
		$post = $this->blog_article_m->with('users')
                         			 ->get_by('article_id',$id);
        if(!empty($post)){
	        //set the variable $title into view
			$this->stencil->title($post->article_title);
			//set metadata
			$cont = word_limiter($post->content,50);
	        $cont2 = html_entity_decode($cont);
					
			//get data 
			$data['post'] = $post;
			$data['categories'] = $this->category_article_m->select($id);
			$data['linkedpost'] = ($this->related_post_m->linked_post($id) != NULL) ? $this->related_post_m->linked_post($id) : NULL ;
		}else{
			$data['post'] = null;
		}
		$this->stencil->paint('post/detail',$data);
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
			'post_id'		=> NULL,
			'categories'	=> array(),
			'list_category' => category(),
			'post_title'	=> '',
			'tags'		    => NULL,
			'status'		=> 'draft',
			'content'		=> '',
			'btn_submit'	=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('post/form');
	}
	
	/*
		=======================================================================
		method : EDIT (Load Form Edit & Passing Data from table with params id)
		=======================================================================
	*/
	public function edit($post_id)
	{
		if(!isset($post_id)) redirect('sk-admin/post');

		$id = $this->security->xss_clean($post_id);
		$result = $this->blog_article_m->get_by('article_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> TRUE,
				'post_id'		=> $result->article_id,
				'list_category' => category(),
				'post_title'	=> $result->article_title,
				'status'		=> $result->status,
				'picture'		=> $result->picture,
				'content'		=> $result->content,
				'btn_submit'	=> 'Update'
			);

			// populate category posts
			$categories = $this->category_article_m->get_many_by('article_id',$id);
			$data['linkedpost'] = ($this->related_post_m->linked_post($id) != NULL) ? $this->related_post_m->linked_post($id) : NULL ;
			
			$cat_cell   = array();
			foreach ($categories as $row) {
				$cat_cell[] = $row->category_id;
			}
			$data['categories'] = $cat_cell;
			// populate tag lists
			$str 	 = $result->keyword;
			$tag_arr = explode(",", $str);
			$tags = array();
			foreach($tag_arr as $k => $v)
			{
				$tags[] = array('id'=>$v,'name'=>$v);
			}
			$tags_json = json_encode($tags);
			$data['tags'] = htmlspecialchars( $tags_json, ENT_QUOTES ); 
		}else
		{
			$data = array(
				'check'		=> FALSE,
			);
		}

		
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('post/form');
	}

	/*
		==================================================
		method : CHANGE_PICTURE (Load form change picture)
		==================================================
	*/
	public function change_picture($post_id)
	{
		if(!isset($post_id)) redirect('sk-admin/post');

		$id = $this->security->xss_clean($post_id);

		$result = $this->blog_article_m->get_custom_by('article_id,picture','article_id',$id);

		$data = array(
			'path' 			=> $this->path_img.'/'.$result->picture,
			'path_action'	=> 'sk-admin/post/update_picture',
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/post','refresh');

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
				'width'		=> 65,
				'height' 	=> 65,
				'x_axis' 	=> '0',
				'y_axis' 	=> '0',
				'new_path' 	=> $this->path_thumb
			);

			$result = $this->_resize_image($config,$upload);	

			$filename = $result['filename'];

			$this->blog_article_m->update_picture($id,$newfile,$filename);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().$this->path_img.'/'.$newfile,
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/post','refresh');

		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->blog_article_m->delete($id);
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
		if (!$this->input->is_ajax_request()) redirect('sk-admin/post','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->blog_article_m->delete_many($id);

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
		method : CHANGE STATUS ()
		===========================================================
	 */
	public function change_status()
	{
		//if (!$this->input->is_ajax_request()) redirect('sk-admin/post','refresh');

		$id_post = $this->input->post('id');
		$status  = $this->input->post('status');

		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$data = array('status'=>$status);
			$q = $this->blog_article_m->update($id,$data);
			if($q)
			{
				$this->session->set_flashdata('notif-success','Article has been successfully change status.');
				
				redirect('sk-admin/post/view/'.$id);
			}
			else
			{
				$this->session->set_flashdata('notif-error','Failed change status.');
				
				redirect('sk-admin/post/view/'.$id);
			}
		}
		else if(empty($id))
		{
			$this->session->set_flashdata('notif-error','ID Null. System Error');
			
			redirect('sk-admin/post/view/'.$id);
		}

	}

	/*
		=============================================================
		method : CHECK TITLE()
		=============================================================
	*/
	public function check_title($str)
	{
		$id = $this->input->post('post-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'blog_articles';
			$cond = array('article_title'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_title','Title is exist. Try another?');
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
	public function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/post','refresh');
		
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean|callback_check_title');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');

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
			$id 	= $this->input->post('post-id');
			$load 	= $this->input->post('submit');
			$title  = $this->input->post('title');
			$file   = strtolower(url_title($title));

			if(empty($id)) 	//action add
			{
				$cek_file = $_FILES[$pic];

				if($cek_file['name'] == '')
				{
					
					$filename  = '';

					//insert data to blog_articles table
					$id = $this->blog_article_m->add_article($filename);
					
					
					if($id != NULL)
					{
						$category 	  = $this->input->post('category',TRUE);
						$tag 		  = $this->input->post('keyword',TRUE);
						$tag_cell     = explode(",", $tag);
						$related_cell = $this->input->post('related-post',TRUE);

						//insert data to category_articles
						if($category != NULL)
						{
							$category_posts = array();

							foreach($category as $key => $value)
							{
								$category_posts[] = array('article_id'=>$id,'category_id'=>$value);
							}

							$this->category_article_m->insert_many($category_posts);
						}

						//insert data to related_posts
						if($related_cell != NULL)
						{
							$related_posts = array();

							foreach($related_cell as $key => $value)
							{
								$related_posts[] = array('parent_id'=>$id,'related_id'=>$value);
							}

							$this->related_post_m->insert_many($related_posts);
						} 

						//insert data to tags
						if(count($tag_cell) > 0)
						{
							$this->load->model('tag_m');
							$tags = array();

							foreach($tag_cell as $key => $value)
							{
								if($this->check_data('tags',array('tag'=>strtolower($value))) == TRUE)
								{
									$tags[] = array('tag'=>$value);
								}
							}

							$this->tag_m->insert_many($tags);
						}
								
					}
					
					if($load == 1){
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/post/add', 'Add Post').'');
					}
							
					$data = array(
						'load'		=> $load,
						'clearForm'	=> TRUE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/post', 'Go back to list').'',
					);

					echo json_encode($data);
				}
				else
				{
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= $this->path_img;
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
				$config['overwrite'] = FALSE;
		        $config['max_size']     = '400';
		        $config['max_width']  	= '1200';
		        $config['max_height']  	= '980';
					
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
						//create thumbnail
						$config = array(
							'width'		=> 65,
							'height' 	=> 65,
							'x_axis' 	=> '0',
							'y_axis' 	=> '0',
							'new_path' 	=> $this->path_thumb
						);

						$result = $this->_resize_image($config,$upload);	
						//call method to insert table
						$this->blog_article_m->add_article($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/sk-admin/post/add', 'Add Post').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/sk-admin/post', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
				}				
			}
			else
			{
				//action edit
				//call method to update table
				$this->blog_article_m->update_article($id);

				$category 	  = $this->input->post('category',TRUE);
				$tag 		  = $this->input->post('keyword',TRUE);
				$tag_cell     = explode(",", $tag);
				$related_cell = $this->input->post('related-post',TRUE);

				//insert data to category_articles
				if($category != NULL)
				{
					$category_posts = array();

					foreach($category as $key => $value)
					{
						if($this->check_data('category_articles',array('article_id'=>$id,'category_id'=>$value)) == TRUE)
						{
							$category_posts[] = array('article_id'=>$id,'category_id'=>$value);
						}
					}

					$this->category_article_m->insert_many($category_posts);
				}

				//insert data to related_posts
				if($related_cell != NULL)
				{
					$related_posts = array();

					foreach($related_cell as $key => $value)
					{
						if($this->check_data('related_posts',array('parent_id'=>$id,'related_id'=>$value)) == TRUE)
						{
							$related_posts[] = array('parent_id'=>$id,'related_id'=>$value);
						}
					}

					$c = $this->related_post_m->insert_many($related_posts);
				} 

				//insert data to tags
				if(count($tag_cell) > 0)
				{
					$this->load->model('tag_m');
					$tags = array();

					foreach($tag_cell as $key => $value)
					{
						if($this->check_data('tags',array('tag'=>strtolower($value))) == TRUE)
						{
							$tags[] = array('tag'=>$value);
						}
					}

					$this->tag_m->insert_many($tags);
				}


				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/sk-admin/post/edit/'.$id , 'Edit Post').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/sk-admin/post', 'Go back to list').'',
					);

					echo json_encode($data);
				}
				
		}
	}

	public function tag_list()
	{
		$key = $_GET['q'];

		$this->load->model('tag_m');
		$result = $this->tag_m->select_tag($key)->get_all();

		$tags = array();

		if($result != NULL)
		{
			foreach($result as $row) {

			$tags[] = array('id'=>$row->tag,'name'=>$row->tag);
			}	
		}
		else
		{
			$tags[] = array('id'=>$key,'name'=>$key);
		}
		

		echo json_encode($tags);

	}

	public function post_list($id)
	{
		$key = $_GET['q'];

		$result = $this->blog_article_m->select_post($key,$id)->get_all();

		$posts = array();

		if($result != NULL)
		{
			foreach($result as $row) {

			$posts[] = array('id'=>$row->article_id,'name'=>$row->article_title);
			}	
		}
		
		echo json_encode($posts);

	}

	public function delete_category_post()
	{
		$postid  = $this->input->post('postid',TRUE);
		$categoryid = $this->input->post('categoryid',TRUE);

		$this->category_article_m->delete_by(array('article_id'=>$postid,'category_id'=>$categoryid));
	}

	public function delete_linked_post()
	{
		$postid  = $this->input->post('postid',TRUE);
		$linkedid = $this->input->post('linkedid',TRUE);

		$this->related_post_m->delete_by(array('parent_id'=>$postid,'related_id'=>$linkedid));
	}


}

/* End of file post.php */
/* Location: ./application/controllers/sk-admin/post.php */
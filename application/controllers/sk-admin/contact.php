<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller {

	protected $limit = 4;

	function __construct()
	{
		parent::__construct();

		$this->stencil->title('Contact');
		$this->load->model(array('message_m','email_m'));
		//load library 
		$this->load->library('pagination');
		//set css and js
		$this->stencil->css('backend/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min');
		$this->stencil->css('backend/css/iCheck/minimal/blue');
		$this->stencil->js('backend/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min');
		$this->stencil->js('backend/js/plugins//iCheck/icheck.min');

	}

	/*
		=============================================
		method : INDEX (Load Page Index)
		=============================================
	*/
		public function index($page_number=1)
		{
			$limit = $this->limit;
			$total = $this->message_m->count_by('deleted',0);

			$config['base_url']			= base_url().'sk-admin/contact/inbox'; 
			$config['total_rows']		= $total;
			$config['per_page']			= $limit;
			$config['uri_segment']		= 4;
			$config['next_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>';
			$config['prev_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>';
			$config['full_tag_open'] 	= '<span>';
			$config['full_tag_close'] 	= '</span>';
			$config['use_page_numbers'] = TRUE;
			$config['display_pages']	= FALSE;

			$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

			$this->pagination->initialize($config);
			$data['total']		= $total;
			$data['start']		= $offset+1;

			$data['pagination'] = $this->pagination->create_links();

			$result = $this->message_m->limit($limit,$offset)
			->order_by('date','DESC')
			->get_custom('message_id,name,message,date,status');

			$total_data = count($result);
			$data['finish']		= $data['start']+($total_data-1); 	
			if($result != false){
				$msg['messages'] = $result;
			}else{
				$msg['messages'] = '';
			}
			$data['body_content'] = $this->load->view('themes/backend/pages/contact/body',$msg,TRUE);
			$this->stencil->data($data);
			$this->stencil->paint('contact/inbox');
		}



	/*
		=============================================
		method : TRASH (get message in status deleted)
		=============================================
	*/
		public function trash($page_number=1)
		{
			$limit = $this->limit;
			$total = count($this->message_m->only_deleted()->get_all());

			$config['base_url']			= base_url().'sk-admin/contact/trash'; 
			$config['total_rows']		= $total;
			$config['per_page']			= $limit;
			$config['uri_segment']		= 4;
			$config['next_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>';
			$config['prev_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>';
			$config['full_tag_open'] 	= '<span>';
			$config['full_tag_close'] 	= '</span>';
			$config['use_page_numbers'] = TRUE;
			$config['display_pages']	= FALSE;

			$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

			$this->pagination->initialize($config);
			$data['total']		= $total;
			$data['start']		= $offset+1;

			$data['pagination'] = $this->pagination->create_links();

			$result = $this->message_m->limit($limit,$offset)
			->order_by('date','DESC')
			->only_deleted()->get_custom('message_id,name,message,date,status');

			$total_data = count($result);
			$data['finish']		= $data['start']+($total_data-1); 	
			if(!empty($result)){
				$msg['messages'] = $result;
			}else{
				$msg['messages'] = '';
			}
			$data['body_content'] = $this->load->view('themes/backend/pages/contact/body',$msg,TRUE);
			$this->stencil->data($data);
			$this->stencil->paint('contact/inbox');
		}


	/*
		=================
		method : DRAFT (get email in status Draft)
		=================
	*/
		public function draft($page_number=1)
		{
			$limit = $this->limit;
			$user_id = $this->ion_auth->get_user_id();
			$total = $this->email_m->count_by(array('author_id'=>$user_id,'status'=>'draft'));

			$config['base_url']			= base_url().'sk-admin/contact/draft'; 
			$config['total_rows']		= $total;
			$config['per_page']			= $limit;
			$config['uri_segment']		= 4;
			$config['next_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>';
			$config['prev_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>';
			$config['full_tag_open'] 	= '<span>';
			$config['full_tag_close'] 	= '</span>';
			$config['use_page_numbers'] = TRUE;
			$config['display_pages']	= FALSE;

			$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

			$this->pagination->initialize($config);
			$data['total']		= $total;
			$data['start']		= $offset+1;

			$data['pagination'] = $this->pagination->create_links();

			$result = $this->email_m->limit($limit,$offset)
			->order_by('date','DESC')
			->get_many_by(array('status'=>'draft','author_id'=>$user_id));

			$total_data = count($result);
			$data['finish']		= $data['start']+($total_data-1); 	
			if(!empty($result)){
				$email['emails'] = $result;
			}else{
				$email['emails'] = '';
			}
			$data['body_content'] = $this->load->view('themes/backend/pages/contact/body2',$email,TRUE);
			$this->stencil->data($data);
			$this->stencil->paint('contact/outbox');
		} 
	/*
		=================
		method : SENT (get email in status Sent)
		=================
	*/

		public function sent($page_number=1)
		{
			$limit = $this->limit;
			$user_id = $this->ion_auth->get_user_id();
			$total = $this->email_m->count_by(array('author_id'=>$user_id,'status'=>'sent'));

			$config['base_url']			= base_url().'sk-admin/contact/sent'; 
			$config['total_rows']		= $total;
			$config['per_page']			= $limit;
			$config['uri_segment']		= 4;
			$config['next_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>';
			$config['prev_link']		= '<button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>';
			$config['full_tag_open'] 	= '<span>';
			$config['full_tag_close'] 	= '</span>';
			$config['use_page_numbers'] = TRUE;
			$config['display_pages']	= FALSE;

			$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

			$this->pagination->initialize($config);
			$data['total']		= $total;
			$data['start']		= $offset+1;

			$data['pagination'] = $this->pagination->create_links();

			$result = $this->email_m->limit($limit,$offset)
			->order_by('date','DESC')
			->get_many_by(array('status'=>'sent','author_id'=>$user_id));

			$total_data = count($result);
			$data['finish']		= $data['start']+($total_data-1); 	
			if(!empty($result)){
				$email['emails'] = $result;
			}else{
				$email['emails'] = '';
			}
			$data['body_content'] = $this->load->view('themes/backend/pages/contact/body2',$email,TRUE);
			$this->stencil->data($data);
			$this->stencil->paint('contact/outbox');
		} 
	/*
		============================
		method : VIEW (Load Message by id)
		============================
	*/
	public function view()
	{
		$id_get = $this->uri->segment(4);

		$id = $this->security->xss_clean($id_get);
		$this->_update_status($id);

		$result = $this->message_m->with_deleted()->get_by('message_id',$id);

		if(!empty($result) && !empty($id))
		{
			$data['data'] = $result;
		}else
		{
			$data['data'] = NULL;
		}

		$this->stencil->data($data);
		$this->stencil->paint('contact/detail_inbox');
	}

	/*
		============================
		method : VIEW EMAIL (Load Email by id)
		============================
	*/

	public function view_email()
	{
		$id_get = $this->uri->segment(4);

		$id = $this->security->xss_clean($id_get);

		$result = $this->email_m->with_deleted()->get_by('email_id',$id);

		if(!empty($result) && !empty($id))
		{
			$data['data'] = $result;
		}else
		{
			$data['data'] = NULL;
		}

		$this->stencil->data($data);
		$this->stencil->paint('contact/detail_outbox');
	}

	/*
		=======================================================================
		method : COMPOSE (create new email)
		=======================================================================
	*/
	
	public function compose()
	{
		$data = array(
			'id' 		=> '',
			'email'		=> '',
			'subject'	=> '',
			'content'	=> ''
		);

		$this->stencil->data($data);
		$this->stencil->paint('contact/form');
	}

	/*
		=======================================================================
		method : REPLY (reply message)
		=======================================================================
	*/
	public function reply($message_id)
	{
		$id = $this->security->xss_clean(strip_tags($message_id));

		$result = $this->message_m->get_custom_by('email','message_id',$id);
		
			$data = array(
				'id' 		=> '',
				'email'		=> $result->email,
				'subject'	=> '',
				'content'	=> ''
			);

			$this->stencil->data($data);
			$this->stencil->paint('contact/form');
		
	}

	/*
		=======================================================================
		method : EDIT (Edit Draft / Sent Email)
		=======================================================================
	*/
	public function edit_email($email_id)
	{
		$id = $this->security->xss_clean($email_id);
		$result = $this->email_m->get_by('email_id',$id);

		if(!empty($result))
		{
			$data = array(
				'id' 		=> $id,
				'email'		=> $result->email_to,
				'subject'	=> $result->subject,
				'content'	=> $result->content
			);
		}else
		{
			$data = NULL;
		}

		$this->stencil->data($data);
		$this->stencil->paint('contact/form');
	}

	/*
		=======================
		method : DELETE INBOX
		=======================
	*/

	public function delete_message()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id_msg = $_GET['id'];
		$id     = $this->security->xss_clean($id_msg);

		if(!empty($id))
		{
			$q = $this->message_m->delete_message($id);
			if($q)
			{
				$this->session->set_flashdata('notif-success','Data has been successfully deleted.');
				
				$data = array(
					'status' => TRUE
				);

				echo json_encode($data);
			}
			else
			{
				$data = array(
					'status' => FALSE,
					'msg' => 'Failed Delete.'
				);

				echo json_encode($data);
			}
		}
		else if(empty($id))
		{			
			$data = array(
				'status' => FALSE,
				'msg'    => 'ID Null. System Error'
			);

			echo json_encode($data);
		}
	}


	/*
		======================================================
		method : DELETE MANY MESSAGE ()
		======================================================
	*/
	public function delete_many_message()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->message_m->delete_many_message($id);

		if($q == TRUE)
		{
			$this->session->set_flashdata('notif-success', 'Data has been successfully deleted.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Delete');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

	/*
		======================================================
		method : DELETE EMAIL ()
		======================================================
	*/
	public function delete_email()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id_msg = $_GET['id'];
		$id     = $this->security->xss_clean($id_msg);

		if(!empty($id))
		{
			$q = $this->email_m->delete($id);
			if($q)
			{
				$this->session->set_flashdata('notif-success','Data has been successfully deleted.');
				
				$data = array(
					'status' => TRUE
				);

				echo json_encode($data);
			}
			else
			{
				$data = array(
					'status' => FALSE,
					'msg' => 'Failed Delete.'
				);

				echo json_encode($data);
			}
		}
		else if(empty($id))
		{			
			$data = array(
				'status' => FALSE,
				'msg'    => 'ID Null. System Error'
			);

			echo json_encode($data);
		}
	}

	/*
		======================================================
		method : DELETE MANY EMAIL ()
		======================================================
	*/
	public function delete_many_email()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->email_m->delete_many($id);

		if($q)
		{
			$this->session->set_flashdata('notif-success', 'Data has been successfully deleted.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Delete');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

	/*
		============================================================
		method : _UPDATE STATUS ()
		===========================================================
	*/

	public function _update_status($id)
	{
		$data = array('status'=>'read');

		$this->message_m->update($id,$data);
	}

	/*
		============================================================
		method : MARK READ ()
		===========================================================
	*/

	public function mark_read()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id = $this->input->post('data',TRUE);

		$data = array('status'=>'read');
		$q = $this->message_m->update_many($id,$data);

		if($q)
		{
			$this->session->set_flashdata('notif-success', 'message been successfully mark read.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Process');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

	/*
		============================================================
		method : MARK UNREAD ()
		===========================================================
	*/

	public function mark_unread()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id = $this->input->post('data',TRUE);

		$data = array('status'=>'unread');
		$q = $this->message_m->update_many($id,$data);

		if($q)
		{
			$this->session->set_flashdata('notif-success', 'message been successfully mark unread.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Process');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

	/*
		============================================================
		method : MOVE TRASH ()
		===========================================================
	*/

	public function move_trash()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$id = $this->input->post('data',TRUE);

		$q = $this->message_m->delete_many($id);

		if($q)
		{
			$this->session->set_flashdata('notif-success', 'Data has been successfully moved trash.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Moved');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

	/*
		============================================================
		method : SEND EMAIL ()
		===========================================================
	*/
	protected function _send_email($post)
	{
		//load library email
		$this->load->library('email');

		//initialize email company
		$email = company('email');
		$name  = company('company_name');
		$data['content'] 	= $this->input->post('content');
		$body = $this->load->view('email/template',$data,TRUE);

		$this->email->from($email,$name)
					->to($post['email_to'])
					->subject($post['subject'])
					->message($body);

		if($this->email->send())
		{
			$return = array(
				'status' => TRUE,
				'msg'	 => 'successfully sent email'
			);

			return $return;
		}
		else
		{
			$return = array(
				'status' => FALSE,
				'msg'	 => show_error($this->email->print_debugger()),
			);

			return $return;
		}
	}


	/*
		=============================================================
		method : SAVE (Proses validation form and insert/update data)
		=============================================================
	*/

	public function save()
	{
		if (!$this->input->is_ajax_request()) redirect('sk-admin/contact','refresh');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$id 		= $this->input->post('id');
			$email  	= $this->input->post('email');
			$subject 	= $this->input->post('subject');
			$content 	= $this->input->post('content');
			$submit 	= $this->input->post('submit');

				
			if(empty($id))
			{
				$post = array(
					'email_id'	=> NULL,
					'author_id'	=> $this->ion_auth->get_user_id(),
					'email_to'	=> strip_tags($email,ENT_QUOTES),
					'subject'	=> strip_tags($subject,ENT_QUOTES),
					'content'	=> htmlspecialchars($content,ENT_QUOTES,"UTF-8")
				);

				if($submit == 'send')
				{
					$check = $this->_send_email($post);
					
					if($check['status'] == FALSE)	//if FALSE
					{
						$data = array(
							'status' => FALSE,
							'msg'	 => $check['msg']
						);

						echo json_encode($data);
					}
					else
					{
						$arr = array('status'=>'sent');
						$insert = array_merge($post,$arr);
						$this->email_m->insert($insert);

						$this->session->set_flashdata('notif-success',$check['msg']);

						$data = array(
							'status' => TRUE,
							'msg'	=> $check['msg']
						);
						echo json_encode($data);
					}
						
						
				}elseif ($submit == 'draft')
				{
					$arr = array('status'=>'draft');
					$insert = array_merge($post,$arr);
					$this->email_m->insert($insert);


					$this->session->set_flashdata('notif-success', 'successfully saved draft');

					$data = array(
						'status' => TRUE,
					);

					echo json_encode($data);
				}else
				{
					$this->session->set_flashdata('notif-error', 'Failed Process');

					$data = array(
						'status' => TRUE,
					);
				}
			}
			else
			{
				$post = array(
					'email_to'		=> strip_tags($email,ENT_QUOTES),
					'subject'	=> strip_tags($subject,ENT_QUOTES),
					'content'	=> htmlspecialchars($content,ENT_QUOTES,"UTF-8")
				);

				if($submit == 'send')
				{
					//proses send email
					$check = $this->_send_email($post);
					
					if($check['status'] == FALSE)	//if FALSE
					{
						echo json_encode($check);
					}
					else
					{
						$arr = array('status'=>'sent');
						$insert = array_merge($post,$arr);
						$this->email_m->update($id,$insert);

						$this->session->set_flashdata('notif-success',$check['msg']);

						echo json_encode($check);
					}
						
				}elseif ($submit == 'draft')
				{
					$this->email_m->update($id,$post);
				}else
				{
					$this->session->set_flashdata('notif-error', 'Failed Process');

					$data = array(
						'status' => TRUE,
					);
				}
			} 
		}
	}




}

	/* End of file contact.php */
/* Location: ./application/controllers/sk-admin/contact.php */
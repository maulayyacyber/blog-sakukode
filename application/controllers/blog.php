<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->theme('frontend');
		$this->stencil->title('Blog');
		$this->load->library(array('pagination','disqus'));

		$this->stencil->layout('blog_layout');
		$this->stencil->slice('head');
		$this->stencil->slice('navbar');
		$this->stencil->slice('sidebar');
		$this->stencil->slice('contact');
		$this->stencil->slice('script');

		$this->stencil->js('frontend/js/jquery.highlight');
		$this->stencil->css('frontend/css/jquery.highlight');

		$this->load->helper('text');

		//$this->load->model(array('service_m','portofolio_m','team_m','client_m'));
		$this->load->model(array('blog_article_m','blog_category_m','category_article_m'));
	}

	public function index($page_number=1)
	{
		$limit = 7;
		$total = $this->blog_article_m->count_all();

		$config['base_url']			= base_url().'blog/post'; 
		$config['total_rows']		= $total;
		$config['per_page']			= $limit;
		//$config['first_link'] 		= '<span class="fg-darkBrown"><i class="icon-arrow-left-5"></i> First &nbsp;</span>';
		//$config['last_link'] 		= '<span class="fg-darkBrown">&nbsp; Last <i class="icon-arrow-right-5"></i></span>';
		$config['prev_link']		= '<span class="newest">newest &nbsp; <i class="fa fa-angle-right"></i></span>';
		$config['next_link']		= '<span><i class="fa fa-angle-left"></i> &nbsp; oldest</span>';
		$config['full_tag_open'] 	= '<p class="para">';
		$config['full_tag_close'] 	= '</p>';
		$config['use_page_numbers'] = TRUE;
		$config['display_pages']	= FALSE;

		$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

		$this->pagination->initialize($config); 											
		$data['pagination'] = $this->pagination->create_links();	

		$result = $this->blog_article_m->select_all($limit,$offset);

		if($result != NULL){
			$data['posts'] = $result;
		}else{
			$data['posts'] = NULL;
		}
		
		$this->stencil->data($data);
		$this->stencil->paint('post_page');
	
	}

	public function category($slug,$page_number=1)
	{
		if(!isset($slug)) redirect('blog');

		$limit = 5;
		$row = $this->blog_category_m->get_by('category_url',$slug);

		$category_id = $row->category_id;
		$total = $this->category_article_m->count_by('category_id',$category_id);

		$config['base_url']			= base_url().'blog/category/'.$slug; 
		$config['total_rows']		= $total;
		$config['uri_segment']		= 4;
		$config['per_page']			= $limit;
		$config['prev_link']		= '<span class="newest">newest &nbsp; <i class="fa fa-angle-right"></i></span>';
		$config['next_link']		= '<span><i class="fa fa-angle-left"></i> &nbsp; oldest</span>';
		$config['full_tag_open'] 	= '<p class="para">';
		$config['full_tag_close'] 	= '</p>';
		$config['use_page_numbers'] = TRUE;
		$config['display_pages']	= FALSE;

		$offset = ($page_number  == 1) ? 0 : ($page_number * $config['per_page']) - $config['per_page'];

		$this->pagination->initialize($config); 											
		$data['pagination'] = $this->pagination->create_links();	

		$result = $this->blog_article_m->select_by_category($limit,$offset,$category_id);

		if($result != NULL){
			$data['posts'] = $result;
		}else{
			$data['posts'] = NULL;
		}
		
		$this->stencil->data($data);
		$this->stencil->paint('post_page');
	}

	public function search()
	{
		$limit = 5;
		$this->load->library('security');
		$keyword = $this->security->xss_clean($_GET['key']);
		$data['keyword'] = strip_tags($keyword);
		$check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));

		if(!empty($keyword) && $check > 3):
			$offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;

			$total = $this->blog_article_m->total_search($keyword);
			//config paging
			$config['base_url'] 	= base_url().'blog/search?key='.$keyword;
			$config['total_rows']	= $total;
			$config['per_page']		= $limit;
			$config['page_query_string'] = TRUE;
			$config['use_page_numbers'] = TRUE;
			$config['display_pages']	= FALSE;
			$config['query_string_segment'] = 'page';
			$config['uri_segment']  = 3;
			$config['full_tag_open'] = '<p class="para">';
			$config['full_tag_close'] = '</p>';
			//$config['first_link'] = '&laquo; Awal';
			//$config['last_link'] = 'Akhir &raquo;';
			$config['prev_link']	= '<span class="newest">newest &nbsp; <i class="fa fa-angle-right"></i></span>';
			$config['next_link']	= '<span><i class="fa fa-angle-left"></i> &nbsp; oldest</span>';
			
			$this->pagination->initialize($config); 											
			$data['pagination'] = $this->pagination->create_links();

			$result = $this->blog_article_m->select_by_search(strip_tags($keyword),$limit,$offset);

			if(!empty($result))
			{
				$data['posts'] = $result->result();
			}
			else
			{
				$data['posts'] = '';
			}
		else:
			$data['posts']   = '';
		endif; 
		
		$this->stencil->data($data);
		$this->stencil->paint('post_page');
	
	}


	public function detail($y,$m,$slug)
	{
		$this->load->model('related_post_m');		
		$post = $this->blog_article_m->select_one($slug);

		$this->stencil->meta(array(
	            'author' => $post->first_name.' '.$post->last_name,
	            'description' => word_limiter(htmlspecialchars_decode($post->content),50),
	            'keywords' => $post->keyword
	    ));

		$data['post']	 = $post;
		$data['linkedpost'] = ($this->related_post_m->linked_post($post->article_id) != NULL) ? $this->related_post_m->linked_post($post->article_id) : NULL ;
		$data['disqus']  = $this->disqus->get_html();

		$this->stencil->data($data);
		$this->stencil->paint('post_single_page');
		
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */
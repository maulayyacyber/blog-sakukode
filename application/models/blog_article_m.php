<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_article_m extends MY_Model {

	public $primary_key = 'article_id';
	protected $soft_delete = TRUE;

	public $belongs_to = array( 'users'=>array('model'=>'user_m','primary_key'=>'author_id') );

	public $before_create = array( 'created_at', 'updated_at' , 'author_by' );
    public $before_update = array( 'updated_at', 'author_by' );

     protected function author_by($row)
    {
    	$row['author_id'] = $this->ion_auth->get_user_id();
    	return $row;
    }

	public function add_article($filename)
	{
		$title 			= ucwords($this->input->post('title'));
		$slug 			= strtolower(url_title($title));
		$keyword		= $this->input->post('keyword');
		$status 		= $this->input->post('status');
		$content		= $this->input->post('content');

		$data = array(
			'article_id'		=> NULL,
			'article_title'		=> strip_tags($title,ENT_QUOTES),
			'article_url'		=> strip_tags($slug,ENT_QUOTES),
			'keyword'			=> strip_tags(strtolower($keyword),ENT_QUOTES),
			'content'			=> htmlspecialchars($content,ENT_QUOTES,"UTF-8"),
			'status'			=> strip_tags($status,ENT_QUOTES),
			'picture'			=> strip_tags($filename,ENT_QUOTES)
		);

		$id = $this->insert($data);
		return $id;
	}
	
	public function update_article($id)
	{
		$title 			= ucwords($this->input->post('title'));
		$slug 			= strtolower(url_title($title));
		$keyword		= $this->input->post('keyword');
		$status 		= $this->input->post('status');
		$content		= $this->input->post('content');

		$data = array(
			'article_title'		=> strip_tags($title,ENT_QUOTES),
			'article_url'		=> strip_tags($slug,ENT_QUOTES),
			'keyword'			=> strip_tags(strtolower($keyword),ENT_QUOTES),
			'content'			=> htmlspecialchars($content,ENT_QUOTES,"UTF-8"),
			'status'			=> strip_tags($status,ENT_QUOTES)
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$file,$path)
	{
		$data = array(
			'picture' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}

	public function select_post($key,$id)
	{
		$this->db->select('article_id,article_title');
		$this->db->like('article_title',$key);
		$this->db->where_not_in('article_id',$id);

		return $this;
	}	

	public function select_all($limit,$offset)
	{
		$query = $this->db->select('a.article_title,a.article_url,a.updated_at,a.keyword,a.picture,a.content,a.deleted,b.first_name,b.last_name')
				 		  ->from('blog_articles a')
				 		  ->join('users b','a.author_id=b.id')
				 		  ->limit($limit,$offset)
				 		  ->where('a.deleted',0)
				 		  ->where('a.status','publish')
				 		  ->order_by('a.updated_at','DESC')
				 		  ->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else
		{
			return NULL;
		}

	}

	public function select_by_category($limit,$offset,$category_id)
	{
		$query = $this->db->select('a.article_title,a.article_url,a.updated_at,a.keyword,a.picture,a.content,a.deleted,b.first_name,b.last_name')
				 		  ->from('blog_articles a')
				 		  ->join('users b','a.author_id=b.id')
				 		  ->join('category_articles c','a.article_id=c.article_id')
				 		  ->limit($limit,$offset)
				 		  ->where('a.status','publish')
				 		  ->where('c.category_id',$category_id)
				 		  ->where('a.deleted',0)
				 		  ->order_by('a.updated_at','DESC')
				 		  ->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else
		{
			return NULL;
		}

	}

	public function select_one($slug)
	{
		$query = $this->db->select('a.article_id,a.article_title,a.article_url,a.updated_at,a.keyword,a.picture,a.content,a.deleted,b.first_name,b.last_name')
				 		  ->from('blog_articles a')
				 		  ->join('users b','a.author_id=b.id')
				 		  ->where('a.deleted',0)
				 		  ->where('a.article_url',$slug)
				 		  ->get();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}else
		{
			return NULL;
		}

	}

	public function total_search($keyword)
	{
		$query = $this->db->like('keyword',$keyword)
				 		  ->or_like('article_title',$keyword)
				 		  ->where('status','publish')
				 		  ->where('deleted',0)
				 		  ->get('blog_articles');

		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return NULL;
		}
	}

	public function select_by_search($keyword,$limit,$offset)
	{
		$query = $this->db->select('a.article_title,a.article_url,a.updated_at,a.keyword,a.picture,a.content,a.deleted,b.first_name,b.last_name')
				 		  ->from('blog_articles a')
				 		  ->join('users b','a.author_id=b.id')
				 		  ->limit($limit,$offset)
				 		  ->like('a.article_title',$keyword)
				 		  ->or_like('a.keyword',$keyword)
				 		  ->where('a.status','publish')
				 		  ->where('a.deleted',0)
				 		  ->limit($limit,$offset)
				 		  ->order_by('a.updated_at','DESC')
				 		  ->get();

		if($query->num_rows() > 0)
		{
			return $query;
		}
		else
		{
			return NULL;
		}
	}
}

/* End of file blog_article_m.php */
/* Location: ./application/models/blog_article_m.php */
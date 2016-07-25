<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_article_m extends MY_Model {

	
	public function select($id)
	{
		$this->db->select('a.category_id,b.category_name');
		$this->db->from('category_articles a');
		$this->db->join('blog_categories b','a.category_id=b.category_id');
		$this->db->where('a.article_id',$id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}else
		{
			return NULL;
		}
	}

}

/* End of file category_article_m.php */
/* Location: ./application/models/category_article_m.php */
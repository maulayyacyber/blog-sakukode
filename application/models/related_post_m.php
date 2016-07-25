<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Related_post_m extends MY_Model {

	public function linked_post($id)
	{
		$this->db->select('a.related_id id,b.article_title title,b.picture,b.article_url slug,b.updated_at');
		$this->db->from('related_posts a');
		$this->db->join('blog_articles b','a.related_id=b.article_id');
		$this->db->where('a.parent_id',$id);
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

/* End of file related_post_m.php */
/* Location: ./application/models/related_post_m.php */
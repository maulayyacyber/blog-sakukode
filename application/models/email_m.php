<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_m extends MY_Model {

	public $primary_key = 'email_id';
	protected $soft_delete = TRUE;

	public $belongs_to = array( 'users' => array( 'model'=>'user_m','primary_key' => 'author_id' ) );

	
	

}

/* End of file email_m.php */
/* Location: ./application/models/email_m.php */
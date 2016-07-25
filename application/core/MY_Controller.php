<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
 
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->nocache();
        //load library and helper
        $this->load->helper(array('dateindo','text','mail','html'));
        //set slices head,header and sidebar
        $this->stencil->theme('backend');
        $this->stencil->slice('head');
        $this->stencil->slice('header');
        $this->stencil->slice('sidebar');
        //set layout admin
        $this->stencil->layout('default');
        $this->stencil->js('backend/js/plugins/input-mask/jquery.inputmask');
        $this->load->library(array('ion_auth'));
        $this->logged_in();
        $this->check_group();
    }

    public function logged_in()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('sk-admin', 'refresh');
        }
    }

    public function check_group()
    {
        $class = $this->router->fetch_class();
        $id = $this->ion_auth->get_user_id();    
        $groups = $this->ion_auth->get_users_groups($id)->row();
        $group_id = $groups->id;

        $query = $this->db->select('*')->where('controller',$class)->where('group_id',$group_id)->get('menu_groups');

        if($query->num_rows != 1)
        {
            redirect('sk-admin/dashboard');
        }
       
    }

    protected function check_data($tb,$cond = array())
    {
    	$q = $this->db->get_where($tb,$cond);
    	
    	if($q->num_rows() > 0)
    	{
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }

    protected function style_table()
    {
        //set css and js
        $this->stencil->css('backend/css/datatables/dataTables.bootstrap');
        $this->stencil->js('backend/js/plugins/datatables/jquery.dataTables');
        $this->stencil->js('backend/js/plugins/datatables/dataTables.bootstrap');
    }

    protected function _button($id,$type=array())
    {  
        $class  = $this->router->fetch_class();
        
        foreach($type as $k => $v)
        {
            switch ($v) {
                case 'view':
                    $attribute = array(
                        'class' => 'btn btn-xs btn-flat btn-info',
                        'title' => 'View detail'
                    );

                    $btn_view = anchor('sk-admin/'.$class.'/view/'.$id, '<i class="ion ion-search"></i>', $attribute);
                    break;

                case 'edit':
                    $attribute = array(
                        'class' => 'btn btn-xs btn-flat bg-olive',
                        'title' => 'Edit data'
                    );

                    $btn_edit = anchor('sk-admin/'.$class.'/edit/'.$id, '<i class="ion ion-edit"></i>', $attribute);
                    break;

                case 'picture':
                    $attribute = array(
                        'class' => 'btn btn-xs btn-flat bg-maroon',
                        'title' => 'Change Picture'
                    );

                    $btn_pict = anchor('sk-admin/'.$class.'/change-picture/'.$id, '<i class="ion ion-image"></i>', $attribute);
                    break;
                case 'icon':
                    $attribute = array(
                        'class' => 'btn btn-xs btn-flat bg-navy',
                        'title' => 'Change Icon'
                    );

                    $btn_icon = anchor('sk-admin/'.$class.'/change-icon/'.$id, '<i class="ion ion-image"></i>', $attribute);
                    break;

                case 'delete':
                    
                    $attribute = array(
                        'class'   => 'btn btn-xs btn-flat btn-danger btn-del',
                        'id'      => $id,
                        'title'   => 'Delete Data',
                        'type'    => 'button',
                        'content' => '<i class="ion ion-trash-a"></i>'
                    );

                    $btn_del = form_button($attribute);
                    break;                   

                default:
                    return NULL;
                    break;
            }
        }

        $btn1 = (!empty($btn_view)) ? $btn_view : '';
        $btn2 = (!empty($btn_edit)) ? $btn_edit : '';
        $btn3 = (!empty($btn_pict)) ? $btn_pict : '';
        $btn4 = (!empty($btn_icon)) ? $btn_icon : '';
        $btn5 = (!empty($btn_del)) ? $btn_del : '';

        return $btn1.' '.$btn2.' '.$btn3.' '.$btn4.' '.$btn5;            
    }

    protected function _img($src,$width='',$height='')
    {
        $w = (!empty($width)) ? $width : '100%';
        $h = (!empty($height)) ? $height : '100%';
        $attribute = array(
            'src'   => $src,
            'alt'   => '',
            'width' => $w,
            'height'=> $h 
        );

        $img = img($attribute);

        return $img;
    }

    protected function _resize_image($config = array(),$data = array())
    {
        $image_config["image_library"] = "gd2";
        $image_config["source_image"] = $data["full_path"];
        $image_config['create_thumb'] = FALSE;
        $image_config['maintain_ratio'] =TRUE;
        $image_config['new_image'] = $config['new_path'].'/'. $data["file_name"];
        $image_config['quality'] = "100%";
        $image_config['width'] = $config['width'];
        $image_config['height'] = $config['width'];
        $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($image_config['width'] / $image_config['height']);
        $image_config['master_dim'] = ($dim > 0)? "height" : "width";

        $this->load->library('image_lib');
        $this->image_lib->initialize($image_config);

        if(!$this->image_lib->resize()) {
            $errors =  $this->image_lib->display_errors();
            $result = array(
                'status' => FALSE,
                'msg'   => $errors
                );

            return $result;
        }else {
            $image_config['image_library'] ='gd2';
            $image_config['source_image']= $config['new_path'].'/'. $data["file_name"];
            $image_config['new_image'] = $config['new_path'].'/'. $data["file_name"];
            $image_config['quality'] = "100%";
            $image_config['maintain_ratio'] = FALSE;
            $image_config['width'] = $config['width'];
            $image_config['height'] = $config['height'];
            $image_config['x_axis'] = $config['x_axis'];
            $image_config['y_axis'] = $config['y_axis'];

            $this->image_lib->clear();
            $this->image_lib->initialize($image_config);

            if(!$this->image_lib->crop()) {
                $errors =  $this->image_lib->display_errors();

                $result = array(
                    'status' => FALSE,
                    'msg'   => $errors
                    );

                return $result;

            }else {

                $result = array(
                    'status' => TRUE,
                    'filename' => $data['file_name']
                    );

                return $result;
            }
        }
    }
}
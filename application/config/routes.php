<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['blog/post'] = "blog/index";
$route['blog/post/(:any)'] ="blog/index/$1";
$route['blog/category'] = "blog/category";
$route['blog/category/(:any)/(:num)'] = "blog/category/$1/$2";
$route['blog/search'] = "blog/search";
$route['blog/(:any)/(:any)/(:any)'] = "blog/detail/$1/$2/$3";
$route['sk-admin'] = "auth/login";
$route['sk-admin/login'] = "auth/login";
$route['sk-admin/dashboard/edit-company/(:any)'] = "sk-admin/dashboard/edit_company/$1";
$route['sk-admin/dashboard/user-profile'] = "sk-admin/dashboard/user_profile";
$route['sk-admin/dashboard/edit-profile'] = "sk-admin/dashboard/edit_user";
$route['sk-admin/dashboard/change-password'] = "sk-admin/dashboard/change_password";
$route['sk-admin/dashboard/change-logo/(:any)'] = "sk-admin/dashboard/change_logo/$1";
$route['sk-admin/(:any)/change-picture/(:any)'] = "sk-admin/$1/change_picture/$2";
$route['sk-admin/service/change-icon/(:any)'] = "sk-admin/service/change_icon/$1";
$route['sk-admin/contact/inbox'] = "sk-admin/contact/index";
$route['blog/post'] = "blog/index";
$route['blog/post/detail'] = "blog/detail";
$route['blog/post/(:num)'] = "blog/index/$1";
$route['blog/post/detail/(:any)'] = "blog/detail/$1";
$route['404_override'] = 'error';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
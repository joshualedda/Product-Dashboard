<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login
$route['login'] = 'users';
//register
$route['register'] = 'users/register';
//logout
$route['logout'] = 'users/logout';


//products list
$route['default_controller'] = 'products';

//product add
$route['products/new'] = 'products/addProduct';
//product create
$route['products/create'] = 'products/createProduct';

//product view
$route['product/show/(:num)'] = 'Products/show/$1';

//reviews
$route['review'] = 'reviews/create';
//reply
$route['reply'] = 'replies/create';









//product edit test purpsoes
$routes['products/updateProduct/(:num)'] = 'Products/updateProduct/$1';



//admin dashboard
$route['dashboard/admin']= 'dashboards';





//profile
$route['profile']= 'dashboards/profile';
//update profile
$route['update/profile']= 'dashboards/updateProfile';
//update password
$route['changePassword']= 'dashboards/changePassword';


//user dashboard
$route['dashboard']= 'dashboards';



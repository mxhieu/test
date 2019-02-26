<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//Danh mục sp
$route['^(:any)-c(:num)$'] = 'product/catalog_product/$2';
$route['^(:any)-c(:num)/(:num)$'] = 'product/catalog_product/$2/$3';
//Chi tiết sp
$route['^(:any)/(:any)-c(:num)p(:num).html$'] = 'product/detail/$4';
//Thanh toán
$route['thanh-toan.html$'] = 'cart';
//Nội dung tin tức
$route['^bai-viet/(:any)-n(:num).html$'] = 'news/detail/$2';
$route['^lien-he.html$'] = 'contact/add_contact';
//Trang chủ tin tức
$route['^bai-viet$'] = 'news/index';
$route['^bai-viet/(:num)$'] = 'news/index/$1';
$route['^tim-kiem?$'] = 'product/search';
$route['^tim-kiem/(:num)$'] = 'product/search/$1';
//Sản phẩm hot
$route['^san-pham-ban-chay$'] = 'product/type_product/tp1';
$route['^san-pham-ban-chay/(:num)$'] = 'product/type_product/tp1/$1';
//Sản phẩm mới
$route['^san-pham-moi$'] = 'product/type_product/tp2';
$route['^san-pham-moi(/(:num))?$'] = 'product/type_product/tp2/$1';

//Đăng kí
$route['^dang-ki.html$'] = 'customer/register';

//Đăng nhập
$route['^dang-nhap.html$'] = 'customer/login';

//quên mật khẩu
$route['^quen-mat-khau.html$'] = 'customer/forget_password';

//Thông tin khách hàng
$route['^thong-tin-tai-khoan.html$'] = 'customer/info_cus';

//Thông tin đặt hàng
$route['^thong-tin-dat-hang.html$'] = 'customer/cus_order';

//Chi tiết đặt hàng
$route['^chi-tiet-dat-hang/(:num)$'] = 'customer/cus_order_detail/$1';


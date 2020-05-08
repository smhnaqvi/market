<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Page/index';
$route['login'] = 'Login';


/** pages */
$route['home'] = 'Page/index';
$route['markets'] = 'Page/markets';
$route['categories'] = 'Page/categories';
$route['basket'] = 'Page/basket';
$route['page/about'] = 'Page/about';
$route['page/contact'] = 'Page/contact';
$route['page/product/(:num)'] = 'Page/product/$1';

$route['market/(:num)/products'] = 'Market/products/$1';
$route['market/(:num)/category'] = 'Market/category/$1';


/** category */
$route['panel/category/manage'] = 'Panel/Category/index';
$route['panel/category/add-new']["POST"] = 'Panel/Category/store';
$route['panel/category/update']["POST"] = 'Panel/Category/update';
$route['panel/category/(:num)/delete']["GET"] = 'Panel/Category/delete/$1';

$route['panel/category/(:num)/manage-subcategories']["GET"] = 'Panel/Category/indexSubCategories/$1';
$route['panel/category/(:num)/add-new-subcategory']["POST"] = 'Panel/Category/storeSubCategory/$1';
$route['panel/category/(:num)/update-subcategory']["GET"] = 'Panel/Category/updateSubCategory/$1';
$route['panel/category/(:num)/delete-subcategory']["GET"] = 'Panel/Category/deleteSubCategory/$1';


$route['panel'] = 'Panel/Main/index';
$route['panel/login'] = 'Login/index';
$route['panel/logout'] = 'Login/logout';

/** product */
$route['panel/product/manage'] = 'Panel/Product/index';
$route['panel/product/add-new']['POST'] = 'Panel/Product/store';

/** market */
$route['panel/market/manage'] = 'Panel/Market/index';
$route['panel/market/add-new']['POST'] = 'Panel/Market/store';

$route['panel/market/(:num)/products'] = 'Panel/Market/marketProducts/$1';
$route['panel/market/(:num)/activation'] = 'Panel/Market/activation/$1';
$route['panel/market/(:num)/add-product'] = 'Panel/Market/assignProduct/$1';


/** order */
$route['panel/order/manage'] = 'Panel/Order/index';





/** api */
$route['api/getSubCategory'] = 'Panel/Category/apiGetSubCategory';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

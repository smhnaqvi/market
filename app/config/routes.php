<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "routes_api.php";

$route['default_controller'] = 'Page/index';

$route['login/adminLogin']['POST'] = 'Login/adminLogin';
$route['panel/login'] = 'Page/panelLogin';


/** pages */
$route['home'] = 'Page/index';
$route['products'] = 'Page/products';
$route['categories'] = 'Page/categories';
$route['category/(:num)'] = 'Page/category/$1';
$route['scp/(:num)'] = 'Page/subCategoryProducts/$1';
$route['sub-categories/(:num)'] = 'Page/subCategories/$1';
$route['basket'] = 'Basket/index';
$route['page/about'] = 'Page/about';
$route['page/contact'] = 'Page/contact';
$route['page/product/(:num)'] = 'Page/product/$1';
$route['search'] = 'Page/search';

$route['market/(:num)'] = 'Market/products/$1';
$route['market/(:num)/category'] = 'Market/category/$1';

$route['order/new-request']['POST'] = 'Order/newRequest';

/** category */
$route['panel/category/manage'] = 'Panel/Category/index';
$route['panel/category/add-new']["POST"] = 'Panel/Category/store';
$route['panel/category/(:num)/edit']["GET"] = 'Panel/Category/index/$1';
$route['panel/category/update']["POST"] = 'Panel/Category/update';
$route['panel/category/(:num)/delete']["GET"] = 'Panel/Category/delete/$1';

/** subcategories */
$route['panel/category/(:num)/manage-subcategories']["GET"] = 'Panel/Category/indexSubCategories/$1';
$route['panel/category/(:num)/add-new-subcategory']["POST"] = 'Panel/Category/storeSubCategory/$1';
$route['panel/category/(:num)/update-subcategory']["GET"] = 'Panel/Category/updateSubCategory/$1';
$route['panel/category/(:num)/delete-subcategory']["GET"] = 'Panel/Category/deleteSubCategory/$1';
$route['panel/category/(:num)/subcategory-products']["GET"] = 'Panel/Category/productsSubCategory/$1';


$route['panel'] = 'Panel/Main/index';
$route['panel/logout'] = 'Login/logout';

/** product */
$route['panel/product/manage'] = 'Panel/Product/index';
$route['panel/product/add-new']['POST'] = 'Panel/Product/store';
$route['panel/product/(:num)/edit'] = 'Panel/Product/editProduct/$1';
$route['panel/product/update']["POST"] = 'Panel/Product/update';
$route['panel/product/delete/(:num)']["GET"] = 'Panel/Product/delete/$1';

/** market */
$route['panel/market/manage'] = 'Panel/Market/index';
$route['panel/market/add-new']['POST'] = 'Panel/Market/store';
$route['panel/market/add-product'] = 'Panel/Market/assignProduct';
$route['panel/market/(:num)/products'] = 'Panel/Market/marketProducts/$1';
$route['panel/market/(:num)/activation'] = 'Panel/Market/activation/$1';


/** order */
$route['panel/order/manage'] = 'Panel/Order/index';
$route['panel/order/(:num)/delivered'] = 'Panel/Order/delivered/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** api basket **/
$route['api/v1/basket/get']["GET"] = 'API/getBasket';
$route['api/v1/basket/addItem']["POST"] = 'API/addItemBasket';
$route['api/v1/basket/update']["POST"] = 'API/updateBasketItems';
$route['api/v1/basket/removeItem']["GET"] = 'API/removeItemBasket';
$route['api/v1/products/list']["GET"] = 'API/getProductsList';

$route['api/getSubCategory'] = 'Panel/Category/apiGetSubCategory';
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define("STATUS_TRUE" ,0);
define("STATUS_FALSE" ,1);
define("PRODUCT_CART" , "product_cart");
define("ORDER_MAIN" , "order_main");
define("ORDER_CART" , "order_cart");
define("MEMBER" , "member");
define("TASK_WHEN_ORDER_CREATED" , 1);
define("TASK_WHEN_ORDER_SHIPPED" , 2);
define("TASK_WHEN_ORDER_REFUND" , 3);
define("TASK_WHEN_TWO_DAYS_AFTER_ORDER_SHIPPED" , 4);
define("TASK_WHEN_PAYMENT_CONFIRMED" , 5);

define("GET_BASE_INFO"                      ,"get_base_info");
define("GET_PRODUCT_CATEGORY_LIST"          ,"get_category_list");
define("GET_PRODUCT_LIST_BY_CATEGORY_ID"    ,"get_product_list_by_category_id");
define("GET_PRODUCT_INFO_BY_PRODUCT_ID"     ,"get_product_info_by_product_id");
define("GET_PRODUCT_ATTR_LIST_BY_MODEL_ID"  ,"get_product_attr_list_by_model_id");
define("GET_PRODUCT_IMAGE_LIST_BY_MODEL_ID" ,"get_product_image_list_by_model_id");
define("GET_PRODUCT_INFO_BY_ATTR_ID_ARRAY"  ,"get_product_info_by_attr_id_array");

define("GET_ARTICLE_VIA_ALIAS"  ,"get_article_via_alias");

define("SET_CART" ,"set_cart");
define("GET_CART" ,"get_cart");
define("VOID_CART" ,"void_cart");
define("SET_ORDER" ,"set_order");
define("UPDATE_ORDER" ,"update_order");
define("SET_INVOICE" ,"set_invoice");

define("GET_TOKEN" ,"get_token");

define("LOGIN" ,"login");
define("REGISTER" ,"register");
define("RESET_PASSWORD" ,"reset_password");

define("API_POST_VARIABLE", "data");
define("API_URL_VARIABLE", "url");
define("API_KEY_VARIABLE", "key");
define("API_TOKEN_VARIABLE", "token");
define("API_CODE_VARIABLE", "code");
define("API_COMPANY_VARIABLE", "company");
define("API_LANG_VARIABLE", "lang");
define("API_IP_VARIABLE", "ip");
define("API_COMMAND_VARIABLE", "command");
define("CTRL_PRODUCT", "../controllers/ctrl_product");
define("CTRL_MEMBER", "../controllers/ctrl_member");
define("CTRL_ARTICLE", "../controllers/ctrl_article");
define("CTRL_ORDER", "../controllers/ctrl_order");
define("CTRL_CART", "../controllers/ctrl_cart");
define("CTRL_BASE_INFO", "../controllers/ctrl_base");


/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
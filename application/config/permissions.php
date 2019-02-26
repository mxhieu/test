<?
$config['member_order'] = array(
	'members' => array('profile'),
	'orders'  => array('index','order_delivery','order_success','order_cancel','load_order_index','load_order_delivery','load_order_success','load_order_cancel','detail','done','cancel','order_return','seen','cancel_product','return_product','increase_qty','descrease_qty'),
);
$config['member_user']= array(
	'members' => array('profile'),
	'catalog' => array('index','add','edit','load_catalog','load_lock_catalog','lock_catalog','lock','unlock','appearance','disappearance'),
	'product' => array('index','add','edit','load_product','load_lock_product','load_out_of_product','lock_product','check_default','lock','unlock','out_of_product','add_quantity'),
	'provider'=> array('index','add','edit','load_provider','load_lock_provider','lock_provider','lock','unlock'),
	'slide'   => array('index','add','edit','load_slide','load_lock_slide','lock_slide','lock','unlock'),
	'news'    => array('index','add','edit','load_news','load_lock_news','lock_news','unlock','appearance','disappearance'),
	'contact' => array('load_contact','load_seen','seen','hasseen','index'),
);
$config['member_master_admin']= array(
	'members' => array('profile','load_members','load_account_lock','index','account_lock','check_username','add','edit','lock','unlock'),
	'catalog' => array('index','add','edit','load_catalog','load_lock_catalog','lock_catalog','lock','unlock','appearance','disappearance'),
	'product' => array('index','add','edit','load_product','load_lock_product','load_out_of_product','lock_product','check_default','lock','unlock','out_of_product','add_quantity'),
	'provider'=> array('index','add','edit','load_provider','load_lock_provider','lock_provider','lock','unlock'),
	'slide'   => array('index','add','edit','load_slide','load_lock_slide','lock_slide','lock','unlock'),
	'news'    => array('index','add','edit','load_news','load_lock_news','lock_news','unlock','appearance','disappearance'),
	'contact' => array('load_contact','load_seen','seen','hasseen','index'),
	'orders'  => array('index','order_delivery','order_success','order_cancel','load_order_index','load_order_delivery','load_order_success','load_order_cancel','detail','done','cancel','order_return','seen','cancel_product','return_product','increase_qty','descrease_qty'),
	'info'    => array('index'),
);
?>
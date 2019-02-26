<?php
class Home extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('catalog_model');
		$this->load->model('slide_model');
	}
	function index(){

		/**
		 * Danh sách điều kiện
		 * $input_slide điều kiện của slide
		 * $input_hot_pro diều kiện của SP hot
		 * $input_news diều kiện của tin tức
		 * $input_new_pro diều kiện của SP mới
		 * $input_catalog diều kiện của danh mục sản phẩm
		 */
		$input_slide = array();
		$input_slide['where'] = array('status'=>1);
		$input_slide['order'] = array('position','asc');
		$input_hot_pro = array();
		$input_hot_pro['where'] = array('status'=>1);
		$input_hot_pro['order'] = array('bought','DESC');
		$input_hot_pro['limit'] = array('5','0');

		$input_news = array();
		$input_news['where'] = array('status'=>1);
		$input_news['limit'] = array('3','0');
		
		$input_new_pro = array();
		$input_new_pro['where'] = array('status'=>1);
		$input_new_pro['order'] = array('id','DESC');
		$input_new_pro['limit'] = array('5','0');

		$input_catalog = array();
		$input_catalog['where'] = array('show_index'=>1);
		$input_catalog['limit'] = array('6','0');	
		$input_catalog['order'] = array('position','asc');
		//Danh sách slide
		$list_slide = $this->slide_model->get_list($input_slide);
		$this->data['list_slide'] = $list_slide;

		//Danh sách SP bán chạy

		$list_hot_pro = $this->product_model->get_list($input_hot_pro);
		$this->data['list_hot_pro'] = $list_hot_pro;
		
		//Danh sách SP hot
		
		$list_new_pro = $this->product_model->get_list($input_new_pro);
		$this->data['list_new_pro'] = $list_new_pro;
		
		//Danh sách tin tức
		$this->load->model('news_model');
		$list_news = $this->news_model->get_list($input_news);
		$this->data['list_news'] = $list_news;
		$id = '';		
		
		//Menu hiển thị kèm hình phía dưới slide
		$list_catalog = $this->catalog_model->get_list($input_catalog);
		$this->data['list_catalog'] = $list_catalog;
		
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		//Hiển thị view
		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/main',$this->data);
	}
	
	
	

}
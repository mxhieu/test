<?php 
class MY_Controller extends CI_Controller{
	//Biến gửi dữ liệu sang bên view
	public $data = array();

	function __construct(){
		//Kế thừa từ CI_Controller
		parent::__construct();
		$controller = $this->uri->segment(1);

		switch ($controller) {
			case 'admin':
			{
				$this->info_dashboard();
				$this->check_login();	
				$this->info_header();
				break;
			}
			default:
			{
				$this->check_login_cus();
				//MẶC ĐỊNH GỌI CÁC PHƯƠNG THỨC
				
				//Danh sách menu(menu-PC)
				$menu = $this->get_category();
				$this->data['menu'] = $menu;
				
				//Menu danh danh mục cha(menu-mobile)
				$menu_mobile = $this->catalog_model->get_category();
				$this->data['menu_mobile'] = $menu_mobile;
				
				//Toggle navigation mobile
				$toggle = $this->get_category_mobile();
				$this->data['toggle'] = $toggle;
				
				//các dạnh mục cha
				$this->load->model('catalog_model');
				$input = array();
				$input['where'] = array('parent_id'=>0,'status'=>1);
				$list_parent_cat = $this->catalog_model->get_list($input);
				$this->data['list_parent_cat'] = $list_parent_cat;
				
				//form select lấy selected
				$id_cat = intval($this->input->get('search-product'));
				$this->data['id_cat'] = $id_cat;
				
				//Từ khóa và danh mục tìm kiếm
				$key ='';
				$this->data['key'] = $key;
				
				$id_cat = intval($this->input->get('search-product'));
				$id_cat = ($this->uri->segment(4)) ? $this->uri->segment(4) : $id_cat;
				$this->data['id_cat'] = $id_cat;
				//Các meta
				$this->load->model('info_model');
				$info_web = $this->info_model->get_info(1);
				$id_1 = $this->uri->rsegment(3);
				$action1 = $this->uri->rsegment(2);
				$news = $this->uri->rsegment(1);
				//Danh mục sản phẩm
				if($id_1 != '' && $action1 == 'catalog_product' && $news!="news")
				{
					$info_cat = $this->catalog_model->get_info($id_1);
					$title = $info_cat->name;
					$this->data['title'] = $title;
					
					$keyword = $info_cat->keyword;
					$this->data['keyword'] = $keyword;
					
					$description = $info_cat->description;
					$this->data['description'] = $description;
				}
				//Chi tiết sản phẩm
				elseif($id_1 != '' && $action1 == 'detail' && $news!="news")
				{
					$this->load->model('product_model');
					$info_product = $this->product_model->get_info($id_1);
					$title = $info_product->name;
					$this->data['title'] = $title;
					
					$keyword = $info_product->keyword;
					$this->data['keyword'] = $keyword;
					
					$description = $info_product->description;
					$this->data['description'] = $description;
				}
				elseif($id_1 != '' && $action1 == 'detail' && $news=="news")
				{
					$this->load->model('news_model');
					$info_news = $this->news_model->get_info($id_1);
					$title = $info_news->name;
					$this->data['title'] = $title;
					
					$keyword = $info_news->keyword;
					$this->data['keyword'] = $keyword;
					
					$description = $info_news->description;
					$this->data['description'] = $description;
				}
				else
				{
					
					$title = $info_web->title;
					$this->data['title'] = $title;
					
					$keyword = $info_web->keyword;
					$this->data['keyword'] = $keyword;
					
					$description = $info_web->description;
					$this->data['description'] = $description;
				}
				
				$domain = $info_web->domain;
				$this->data['domain'] = $domain;
				
				$logo = $info_web->logo;
				$this->data['logo'] = $logo;
				
				$phone = $info_web->phone;
				$this->data['phone'] = $phone;
				
				$fanpage = $info_web->fanpage;
				$this->data['fanpage'] = $fanpage;
				
				$address = $info_web->address;
				$this->data['address'] = $address;
				
				$email = $info_web->email;
				$this->data['email'] = $email;
				
				$email = $info_web->email;
				$this->data['email'] = $email;
				//Danh sách thành phố
				$query = $this->db->get('provinces'); 
				$list_provinces = $query->result();
				$this->data['list_provinces'] = $list_provinces;
				//pre($_SESSION);

			}
		}
	}
	
	private function info_dashboard()
	{
		$this->load->model('order_detail_model');
		$this->load->model('orders_model');
		$total_m_1 = 0;$total_m_2 = 0;$total_m_3 = 0;$total_m_4 = 0;
		$total_m_5 = 0;$total_m_6 = 0;$total_m_7 = 0;$total_m_8 = 0;
		$total_m_9 = 0;$total_m_10 = 0;$total_m_11 = 0;$total_m_12 = 0;
		$input = array();
		$input['where'] = array('status'=>1);
		$list_order_detail_dashboard = $this->order_detail_model->get_list($input);
		
		
		$this->data['list_order_detail_dashboard'] = $list_order_detail_dashboard;
		//Thời gian từ 0 giờ ngày hôm nay tới 24h ngày hôm nay
		$day = date('d',time());
		$month = date('m',time());
		$year = date('Y',time());
		$start_day = mktime(0,0,0,$month,$day,$year);
		$end_day = mktime(24,0,0,$month,$day,$year);
		
		$total_h_1_8 = 0;
		$total_h_9_16 = 0;
		$total_h_17_24 = 0;
		$input_day['where'] = array('status' => 3,'created_success >' => $start_day,'created_success <' => $end_day);
		$list_order_detail_day = $this->orders_model->get_list($input_day);
		
		foreach($list_order_detail_day as $row)
		{
			if(date('H',$row->created_success)>=0 && date('H',$row->created_success)<=7)
			{
				$total_h_1_8 += $row->total;
			}
			if(date('H',$row->created_success)>8 && date('H',$row->created_success)<=15)
			{
				$total_h_9_16 += $row->total;
			}
			if(date('H',$row->created_success)>16&& date('H',$row->created_success)<=23)
			{
				$total_h_17_24 += $row->total;
			}
		}

		$this->data['total_h_1_8'] = $total_h_1_8;
		$this->data['total_h_9_16'] = $total_h_9_16;
		$this->data['total_h_17_24'] = $total_h_17_24;
		
		$total_day = 0;
		foreach($list_order_detail_day as $row)
		{
			$total_day += $row->total;
		}

		$sale_day = $this->order_detail_model->count_order_success($start_day,$end_day);
		//pre($sale_day);
		$this->data['sale_day'] = $sale_day;
		$this->data['total_day'] = $total_day;

		//Tháng hiện tại
		$total_d_1_10 = 0;
		$total_d_11_20 = 0;
		$total_d_21_end = 0;
		$start_month = mktime(0,0,0,$month,1,$year);
		$end_month = mktime(0,0,0,$month+1,$day,$year);
		$input_month['where'] = array('status' => 3,'created_success >' => $start_month,'created_success <' => $end_month);
		$list_order_detail_month = $this->orders_model->get_list($input_month);
		foreach($list_order_detail_month as $row)
		{
			if(date('d',$row->created_success)>1 && date('d',$row->created_success)<=11)
			{
				$total_d_1_10 += $row->total;
			}
			if(date('d',$row->created_success)>11 && date('d',$row->created_success)<=21)
			{
				$total_d_11_20 += $row->total;
			}
			if(date('d',$row->created_success)>21 && date('d',$row->created_success)<=31)
			{
				$total_d_21_end += $row->total;
			}
			
		}
		
		$this->data['total_d_1_10'] = $total_d_1_10;
		$this->data['total_d_11_20'] = $total_d_11_20;
		$this->data['total_d_21_end'] = $total_d_21_end;
		
		$total_month = 0;
		foreach($list_order_detail_month as $row)
		{
			$total_month += $row->total;
		}
		//Số lương bán trong ngày
		$sale_month = $this->order_detail_model->count_order_success($start_month,$end_month);

		$this->data['sale_month'] = $sale_month;
		$this->data['total_month'] = $total_month;

		//năm hiện tại
		$start_year = mktime(0,0,0,1,1,$year);
		$end_year = mktime(0,0,0,1,1,$year+1);
		$input_year['where'] = array('status' => 3,'created_success >' => $start_year,'created_success <' => $end_year);
		$list_order_detail_year = $this->orders_model->get_list($input_year);

		//Biểu đồ doanh thu của năm
		foreach($list_order_detail_year as $row)
		{
			if(date('m',$row->created_success)==1)
			{
				
				$total_m_1 += $row->total;
			}
			if(date('m',$row->created_success)==2)
			{
				
				$total_m_2 += $row->total;
			}
			if(date('m',$row->created_success)==3)
			{
				
				$total_m_3 += $row->total;
			}
			if(date('m',$row->created_success)==4)
			{
				
				$total_m_4 += $row->total;
			}
			if(date('m',$row->created_success)==5)
			{
				
				$total_m_5 += $row->total;
			}
			if(date('m',$row->created_success)==6)
			{
				
				$total_m_6 += $row->total;
			}
			if(date('m',$row->created_success)==7)
			{
				
				$total_m_7 += $row->total;
			}
			if(date('m',$row->created_success)==8)
			{
				$total_m_8 += $row->total;
			}
			if(date('m',$row->created_success)==9)
			{
				$total_m_9 += $row->total;
			}
			if(date('m',$row->created_success)==10)
			{
				$total_m_10 += $row->total;
			}
			if(date('m',$row->created_success)==11)
			{
				$total_m_11 += $row->total;
			}
			if(date('m',$row->created_success)==12)
			{
				$total_m_12 += $row->total;
			}
		}
		$this->data['total_m_1'] = $total_m_1;
		$this->data['total_m_2'] = $total_m_2;
		$this->data['total_m_3'] = $total_m_3;
		$this->data['total_m_4'] = $total_m_4;
		$this->data['total_m_5'] = $total_m_5;
		$this->data['total_m_6'] = $total_m_6;
		$this->data['total_m_7'] = $total_m_7;
		$this->data['total_m_8'] = $total_m_8;
		$this->data['total_m_9'] = $total_m_9;
		$this->data['total_m_10'] = $total_m_10;
		$this->data['total_m_11'] = $total_m_11;
		$this->data['total_m_12'] = $total_m_12;
		//Kết thúc biểu đồ
		$total_year = 0;
		foreach($list_order_detail_year as $row)
		{
			$total_year += $row->total;
		}
		//Số lương bán trong ngày
		$sale_year = $this->order_detail_model->count_order_success($start_year,$end_year);
		$this->data['sale_year'] = $sale_year;
		$this->data['total_year'] = $total_year;
		
		//Tài khoản
		$this->load->model('members_model');	
		$input_member = array();
		$input_member['where'] = array('status'=>1);
		$list_members = $this->members_model->get_list($input_member);
		$total_members = count($list_members);
		$this->data['total_members'] = $total_members;
		
		//sản phẩm
		$this->load->model('product_model');	
		$input_product = array();
		$input_product['where'] = array('status'=>1);
		$list_product = $this->product_model->get_list($input_product);
		$total_product = count($list_product);
		$this->data['total_product'] = $total_product;
		//Danh sách sản phẩm hết số lương.
		$input_o_p = array();
		$input_o_p['where'] = array('quantity'=>0);
		$list_out_of_p = $this->product_model->get_list($input_o_p);
		
		$total_o_p = count($list_out_of_p);
		$this->data['total_o_p'] = $total_o_p;
		$this->data['list_out_of_p'] = $list_out_of_p;
		
		//Hóa đơn
		$this->load->model('orders_model');	
		$input_order = array();
		$input_order['where'] = array('status'=>1);
		$list_order = $this->orders_model->get_list($input_order);
		$total_order = count($list_order);
		$this->data['total_order'] = $total_order;
		
		//Liên hệ
		$this->load->model('contact_model');	
		$input_contact = array();
		$input_contact['where'] = array('status'=>1);
		$list_contact = $this->contact_model->get_list($input_contact);
		$total_contact = count($list_contact);
		$this->data['total_contact'] = $total_contact;
		
		$this->data['day'] = $day;
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		$this->load->model('info_model');
		$info_web = $this->info_model->get_info(1);
		$emailuser = $info_web->emailuser;
		$this->data['emailuser'] = $emailuser;
		
		$emailpwd = $info_web->emailpwd;
		$this->data['emailpwd'] = $emailpwd;
	}
	
	private function info_header()
	{
		
		$table = $this->uri->rsegment(1);
		$this->data['table'] = $table;
		
		//tên action 
		$action = $this->uri->rsegment(2);
		$this->data['action'] = $action;
		
		//Từ khóa tìm kiếm
		$search_text = '';
		$this->data['search_text'] = $search_text;
		$this->load->model('orders_model');
		$input_order = array();
		$input_order['where'] = array('status'=>1);
		$input_order['order'] = array('id','desc');
		$input_order['limit'] = array(5,0);
		//Tổng đơn hàng
		$total_orders = $this->orders_model->get_total($input_order);
		
		//Danh sách đơn hàng mới.
		$list_order_header = $this->orders_model->get_list($input_order);
		
		$this->data['list_order_header'] = $list_order_header;
		$this->data['total_orders'] = $total_orders;
		
		//Thông tin ý kiến
		$this->load->model('contact_model');
		$input_contact= array();
		$input_contact['where'] = array('status'=>1);
		$input_contact['order'] = array('id'=>'desc');
		$input_contact['limit'] = array(5,0);
		$total_contact = $this->contact_model->get_total($input_contact);
		
		//Danh sách đơn hàng mới.
		$list_contact = $this->contact_model->get_list($input_contact);
		$this->data['list_contact'] = $list_contact;
		$this->data['total_contact'] = $total_contact;
		
		//Thêm class active vào menu
		$active = $this->uri->segment(2);
		$this->data['active'] = $active;
	}
	
	private function check_login_cus(){
		$controller = $this->uri->rsegment("2");
		$controller = strtolower($controller);
		$login = $this->session->userdata("cus_login");
		if($login && ($controller == "login" || $controller == "register"))
		{
			redirect(base_url());
		}
		if(!$login && ($controller == "info_cus"||$controller == "cus_order"))
		{
			redirect(base_url("index.php/customer/login"));
		}
	}
	
	//Kiểm tra tài khoản đã đăng nhập chưa.
	private function check_login(){
		$controller = $this->uri->rsegment("1");
		$controller = strtolower($controller);
		$login = $this->session->userdata("login");
		if(!$login && $controller != "login")
		{
			redirect(admin_url("login"));
		}
		if($login && $controller == "login")
		{
			redirect(admin_url());
		}
		elseif(!in_array($controller,array('login','home'))) //Trang mặc nhiên được truy cập
		{
			$admin_id = $this->session->userdata('admin_id');
			$admin_root = $this->config->item('root_admin');
			if($admin_id != $admin_root)
			{
				$permissions_admin = $this->session->userdata('permissions');
				$controller = $this->uri->rsegment(1);

				$action = $this->uri->rsegment(2);
				//pre($action);
				$check = true;
				if(!isset($permissions_admin->{$controller}))
				{
					$check = false;
				}
				$permissions_action = $permissions_admin->{$controller};
				//pre($permissions_action);
				if(!in_array($action,$permissions_action))
				{
					$check = false;
				}
				if(!$check)
				{
					$this->session->set_flashdata('message','<script>swal("Thất bại!", "Bạn không có quyền truy cập!", "error")</script>');
					redirect(admin_url("home"));
				}
			}
		}
	}
	
	//Menu cho PC
	function get_category()
    {
        $str = "";
        $this->load->model('catalog_model');
        $categorys = $this->catalog_model->get_category();
        if(!empty($categorys))
		{
			foreach ($categorys as $category)
			{
			
				$sub_categorys  =   $this->catalog_model->get_subcategory($category->id);
				if($sub_categorys)
				{
					$str .= '<li class="dropdown">';
					$str .= '<a href="'.base_url().'index.php/'.$category->slug.'-c'.$category->id.'" class="dropdown-toggle">'.$category->name.'<b class="caret"></b></a>';
					$str .= $this->get_subcategory($category->id,$i = 0);
					$str .= "</li>";
				}
				else
				{
					$str .= '<li><a href="'.base_url().'index.php/'.$category->slug.'-c'.$category->id.'">'.$category->name.'</a></li>';
				}
			}
		}
        return $str;
    }
    function get_subcategory($category_ids,$i = 0)
    {
        $str = "";
        $sub_categorys  =   $this->catalog_model->get_subcategory($category_ids);
        //kiem tra get subcategory co ton tai hay không
        if($sub_categorys)
		{
           $str .= '<ul class="dropdown-menu">';
                foreach ($sub_categorys as $sub_category)
                {
                    //kiem tra con parent hay ko
                    $str .='<li class="menu-item">';
                    $str .= '<a href="'.base_url().'index.php/'.$sub_category->slug.'-c'.$sub_category->id.'">'.$sub_category->name.'<p class="pull-right">❯</p> </a>';
                    if($sub_category->id)
                    {
                        $str .= $this->last_subcategory($sub_category->id,$i++);
                    }
                    $str .= "</li>";

                }
           $str .= "</ul>";
        }
        return $str;
    }
	function last_subcategory($category_ids,$i = 0)
    {
        $str = "";
        $sub_categorys  =$this->catalog_model->get_subcategory($category_ids);
        if($sub_categorys)
		{
           $str .= '<div class="size"><ul class="mega-menu-sub">';
                foreach ($sub_categorys as $sub_category)
                {
                    //kiem tra con parent hay ko
                    $str .='<li class="mega-menu-item">';
                    $str .= '<a href="'.base_url().'index.php/'.$sub_category->slug.'-c'.$sub_category->id.'">'.$sub_category->name.'</a>';
                    if($sub_category->id)
                    {
                        $str .= $this->get_subcategory($sub_category->id,$i++);
                    }
                    $str .= "</li>";

                }
           $str .= "</ul></div>";
        }
        return $str;
    }
	
	//Menu cho Mobile
	function get_category_mobile()
    {
		$j=1;
        $str = "";
        $this->load->model('catalog_model');
        $categorys = $this->catalog_model->get_category();
        if(!empty($categorys))
		{
			foreach ($categorys as $category)
			{
				$dem = $j++;
				$sub_categorys  =   $this->catalog_model->get_subcategory($category->id);
				if($sub_categorys)
				{
					$str .= '<button class="w3-button w3-block w3-left-align the1" onclick="myAccFunc'.$dem.'()">';
					$str .= $category->name.'<a class="xxx" id="xoay1" href=""><svg class="svg-inline--fa fa-angle-down fa-w-10 xxx" style="float: right;" aria-hidden="true" data-prefix="fa" data-icon="angle-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path></svg><!-- <i class="fa fa-angle-down xxx" style="float: right;"></i> --></a>';
					$str .= "</button>";
					$str .= '<div id="demoAcc'.$dem.'" class="w3-hide w3-white w3-card">';
					$str .= $this->get_subcategory_mobile($category->id,$i = 0);
					$str .= "</div>";
					$str .= '<script>
								function myAccFunc'.$dem.'(){var e=document.getElementById("demoAcc'.$dem.'");-1==e.className.indexOf("w3-show")?(e.className+=" w3-show",e.previousElementSibling.className+=" w3-green"):(e.className=e.className.replace(" w3-show",""),e.previousElementSibling.className=e.previousElementSibling.className.replace(" w3-green",""))}
							</script>';
				}
				else
				{
					$str .= '<a href="'.base_url('index.php/').$category->slug.'-c'.$category->id.'" class="w3-bar-item w3-button item1">'.$category->name.'</a>';
				}
				
			}
			
		}
        return $str;
    }
    function get_subcategory_mobile($category_ids,$i = 0)
    {
		$j=2;
        $str = "";
        $sub_categorys  =   $this->catalog_model->get_subcategory($category_ids);
        //kiem tra get subcategory co ton tai hay không
        if($sub_categorys)
		{
 
                foreach ($sub_categorys as $sub_category)
                {
                    //kiem tra con parent hay ko
                    $str .='<button class="w3-button w3-block w3-left-align the2 addcss">
								<a href="'.base_url('index.php/').$sub_category->slug.'-c'.$sub_category->id.'">'.$sub_category->name.'</a>
							</button>';
                    $str .= '<div id="demoAcc" class="w3-hide w3-white w3-card demo">';
                    if($sub_category->id)
                    {
                        $str .= $this->last_subcategory_mobile($sub_category->id,$i++);
                    }
                    $str .= "</div>";

                }

        }
        return $str;
    }
	function last_subcategory_mobile($category_ids,$i = 0)
    {
        $str = "";
        $sub_categorys  =$this->catalog_model->get_subcategory($category_ids);
        if($sub_categorys)
		{
                foreach ($sub_categorys as $sub_category)
                {
                    //kiem tra con parent hay ko
                    $str .='<a href="" class="w3-bar-item w3-button" style="background-color: #225689;">'.$sub_category->name.'</a>';
                }
        }
        return $str;
    }
	
}
?>

<?
class Orders extends MY_Controller{
	
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('order_detail_model');
		$this->load->model('customer_model');
		$this->load->library('sendmail_library');
	}

	function load_order_index()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('orders/index'));
	}
	
	
	function load_order_delivery()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('orders/order_delivery'));
	}
	
	function load_order_success()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('orders/order_success'));
	}
	
	function load_order_cancel()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('orders/order_cancel'));
	}
	
	function index($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->orders_model->get_total_row(1,$search_text);
			if($total>0)
			{
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> đơn hàng được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('orders/load_order_index').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có đơn hàng được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->orders_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		$total_rows = $this->orders_model->get_total_row(1,$search_text);
		
		$this->load->library("pagination");
		$config['base_url'] = admin_url("orders/index"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;
		//$config['uri_segment'] = 4;
		//Phân trang theo số trang 1 2 3 4
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}
		$config['next_link'] ="trang kế tiếp";
		$config['pre_link'] ="trang trước";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";

		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";

		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		//phương thức khởi tạo cấu hình phân trang
		$this->pagination->initialize($config);
		
		$input['limit'] = array($config['per_page'],$rowno);
		$list_order = $this->orders_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		//Tổng tiền khách hàng phải thanh toán (trừ tiền cho các sản phẩm bị hủy )
		foreach($list_order as $row)
		{
			$total = $this->order_detail_model->total_pay_order($row->id);
			$row->total_pay = $total;
		}

		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_order'] = $list_order;

		$this->data['temp'] = 'admin/orders/index';
		$this->load->view("admin/main",$this->data);
	}
	

	//Đơn hàng đang giao
	function order_delivery($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->orders_model->get_total_row(2,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> đơn hàng được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('order/load_order_delivery').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có đơn hàng được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->orders_model->get_total_row(2,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		$total_rows = $this->orders_model->get_total_row(2,$search_text);
		
		$this->load->library("pagination");
		$config['base_url'] = admin_url("orders/order_delivery"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;
		//$config['uri_segment'] = 4;
		//Phân trang theo số trang 1 2 3 4
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}
		$config['next_link'] ="trang kế tiếp";
		$config['pre_link'] ="trang trước";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";

		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";

		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		//phương thức khởi tạo cấu hình phân trang
		$this->pagination->initialize($config);
		
		$input['limit'] = array($config['per_page'],$rowno);
		$list_order = $this->orders_model->get_like(2,$search_text,$config['per_page'],$rowno);

		foreach($list_order as $row)
		{
			$total = $this->order_detail_model->total_pay_order($row->id);
			$row->total_pay = $total;
		}
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_order'] = $list_order;
		

		//load view
		$this->data['temp'] = 'admin/orders/order_delivery';
		$this->load->view("admin/main",$this->data);
	}
	
	//Danh sách đơn hàng giao thành công
	function order_success($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->orders_model->get_total_row(3,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> đơn hàng được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('order/load_order_delivery').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có đơn hàng được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->orders_model->get_total_row(3,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		$total_rows = $this->orders_model->get_total_row(3,$search_text);
		
		$this->load->library("pagination");
		$config['base_url'] = admin_url("orders/load_order_success"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;
		//$config['uri_segment'] = 4;
		//Phân trang theo số trang 1 2 3 4
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}
		$config['next_link'] ="trang kế tiếp";
		$config['pre_link'] ="trang trước";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";

		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";

		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		//phương thức khởi tạo cấu hình phân trang
		$this->pagination->initialize($config);
		
		$input['limit'] = array($config['per_page'],$rowno);
		$list_order = $this->orders_model->get_like(3,$search_text,$config['per_page'],$rowno);

		foreach($list_order as $row)
		{
			$total = $this->order_detail_model->total_pay_order($row->id);
			$row->total_pay = $total;
		}

		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_order'] = $list_order;
		//load view
		$this->data['temp'] = 'admin/orders/order_success';
		$this->load->view("admin/main",$this->data);
	}
	
		
	//Đanh sách đơn hàng bị hủy
	function order_cancel($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->orders_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Có <strong> '.$total.'</strong> đơn hàng được tìm thấy.
							  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
								<a href="'.admin_url('order/load_order_cancel').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Không có đơn hàng được tìm thấy.
							  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->orders_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		$total_rows = $this->orders_model->get_total_row(0,$search_text);
		
		$this->load->library("pagination");
		$config['base_url'] = admin_url("orders/order_cancel"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;
		//$config['uri_segment'] = 4;
		//Phân trang theo số trang 1 2 3 4
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}
		$config['next_link'] ="trang kế tiếp";
		$config['pre_link'] ="trang trước";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";

		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";

		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		//phương thức khởi tạo cấu hình phân trang
		$this->pagination->initialize($config);
		
		$input['limit'] = array($config['per_page'],$rowno);
		$list_order = $this->orders_model->get_like(0,$search_text,$config['per_page'],$rowno);

		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_order'] = $list_order;
		//load view
		$this->data['temp'] = 'admin/orders/order_cancel';
		$this->load->view("admin/main",$this->data);
	}
	
	function detail()
	{
		$id_order = $this->uri->segment(4);
		$info_order = $this->orders_model->get_info($id_order);
		
		//Chi tiết đơn hàng
		if($info_order->status != 0)
		{
			if($this->order_detail_model->get_order_null($id_order))
			{
				//Danh sách đơn hàng
				$list_order_detail = $this->order_detail_model->get_order_detail(1,$id_order);
				
				//Thông tin khách hàng.
				$info_orders = $this->orders_model->get_info($id_order);
				$data = array('status'=>'0');
				if($this->orders_model->update($id_order,$data))
				{
					if($this->sendmail_library->send_mail($list_order_detail,$info_orders,0))
					{
						foreach($list_order_detail as $order_detail)
						{
							$this->product_model->descrease_qty($order_detail->id_product,$order_detail->quantity);
						}
						$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Đơn hàng hủy thành công và gửi mail cho khách hàng
																  </div>');
						redirect(admin_url("orders/index"));
					}
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Thao tác thất bại, vui lòng thử lại.
															  </div>');
						redirect(admin_url("orders/index"));
				}
			}
		}
		$query = $this->db->get_where('order_detail',array('id_order' => $id_order));
		$this->db->order_by('status DESC');
		$list_order_detail = $query->result();
		$this->data['list_order_detail'] = $list_order_detail;
		
		//Tổng số lượng
		$total_rows = count($list_order_detail);
		$this->data['total_rows'] = $total_rows;
		
		//Thông tin đơn hàng.
		$info_orders = $this->orders_model->get_info($id_order);

		$this->data['info_orders'] = $info_orders;
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		//load view
		$this->data['temp'] = 'admin/orders/order_detail';
		$this->load->view("admin/main",$this->data);
	}
	
	
	//Đã giao thành công
	function done()
	{
		//Danh sach order
		$id_order = intval($this->uri->segment(4));
		$info_order = $this->orders_model->get_info($id_order);
		if(!$info_order)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders"));
		}
		//Danh sách đơn hàng
		$list_order_detail = $this->order_detail_model->get_order_detail(1,$id_order);
		
		//Thông tin khách hàng/
		$info_orders = $this->orders_model->get_info($id_order);
		$data = array('status'=>'3','created_success'=>time());
		if($this->orders_model->update($id_order,$data))
		{	if($this->sendmail_library->send_mail($list_order_detail,$info_orders,3))
			{
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Đơn hàng giao dịch thành công và gửi mail cho khách hàng
																  </div>');
				redirect(admin_url("orders"));
			}
			else
			{
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Gửi mail thất bại, nhưng đơn hàng đã giao thành công, vui lòng kiểm tra lại email gửi.
													  </div>');
				redirect(admin_url("orders"));
			}
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders"));
		}
	}

	//hủy đơn hàng
	function cancel()
	{
		// Mã khách hàng
		$id_order = intval($this->uri->segment(4));
		$info_order = $this->orders_model->get_info($id_order);
		
		//Danh sách đơn hàng
		$list_order_detail = $this->order_detail_model->get_order_detail(1,$id_order);
		
		//Thông tin khách hàng.
		$info_orders = $this->orders_model->get_info($id_order);

		if(!$info_order)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
		
		$data = array('status'=>'0');
		if($this->orders_model->update($id_order,$data))
		{
			
				//Cập nhật tất trạng thái order_detail về 0
				if($this->order_detail_model->update_detail_stt_0($id_order))
				{
					$input = array();
					$input['where'] = array('id_order'=>$id_order);
					$list_all_order_detail = $this->order_detail_model->get_list($input);
					if($this->sendmail_library->send_mail($list_all_order_detail,$info_orders,0))
					{
						foreach($list_order_detail as $order_detail)
						{
							$this->product_model->descrease_qty($order_detail->id_product,$order_detail->quantity);
						}
						$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																			Đơn hàng đã hủy và gửi mail cho khách hàng
																		  </div>');
						redirect(admin_url("orders/index"));
					}
				}
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
	}
	
	//Mua lại đơn hàng
	function order_return()
	{
		// Mã khách hàng
		$id_order = intval($this->uri->segment(4));
		//Thông tin order
		$info_order = $this->orders_model->get_info($id_order);
		
		$list_order_detail = $this->order_detail_model->get_order_detail(0,$id_order);

		if(!$info_order)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
		$data = array('status'=>'1');

		if($this->orders_model->update($id_order,$data))
		{	
			//Nếu đơn hàng được khôi phục thì sản phẩm cũng được khôi phục
			if($this->order_detail_model->update_stt_order_detail($id_order))
			{
				foreach($list_order_detail as $order_detail)
				{
					$this->product_model->increase_qty($order_detail->id_product,$order_detail->quantity);
				}
			}
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Đơn hàng đã được khôi phục vui lòng kiểm tra trong đơn hàng mới.
																  </div>');
			redirect(admin_url("orders/order_cancel"));
		}
	}
	//đơn hàng đã xem
	function seen()
	{
		//Thông tin order
		$id_order = intval($this->uri->segment(4));
		$info_order = $this->orders_model->get_info($id_order);
		
		//Danh sách chi tiết đơn hàng
		$query = $this->db->get_where('order_detail',array('id_order'=>$id_order));
		$list_order_detail = $query->result();
		
		//Thông tin khách hàng
		$info_order = $this->orders_model->get_info($id_order);

		if(!$info_order)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
		$data = array('status'=>'2');
		if($this->orders_model->update($id_order,$data))
		{		
			if($this->sendmail_library->send_mail($list_order_detail,$info_order,2))
			{
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Bạn đã xem và duyệt đơn hàng, đồng thời đã gửi mail thông báo đến khách hàng.
																  </div>');
				redirect(admin_url("orders/order_delivery"));
			}
			else
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Gửi mail thất bại, nhưng đơn hàng vẫn được giao, vui lòng kiểm tra tài khoản email.
													  </div>');
				redirect(admin_url("orders/index"));
			}
				
		}
	}
	
	//Bỏ đơn hàng
	function cancel_product()
	{
		$id_product = intval($this->uri->segment(4));
		$id_order = intval($this->uri->segment(5));
		$query = $this->db->get_where('order_detail',array('id_product' => $id_product, 'id_order' => $id_order,'status'=>1));
		$info_order_detail = $query->row();
		if(!$info_order_detail)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
		$data = array();
		$data = array('status' => 0);
		


		if($this->db->update('order_detail', $data, array('id_product' => $id_product,'id_order' => $id_order)))
		{
			$total = $this->order_detail_model->total_pay_order($id_order);
			$data_order= array();
			$data_order =array ('total'=>$total);
			if($this->db->update('orders', $data_order, array('id' => $id_order)))
			{
				$this->product_model->descrease_qty($id_product,$info_order_detail->quantity);
				$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																		Bạn đã hủy thành công sản phẩm.
																	  </div>');
				redirect(admin_url("orders/detail/".$id_order));
			}
			else
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Gửi mail thất bại, nhưng đơn hàng vẫn bị hủy, vui lòng kiểm tra tài khoản email.
													  </div>');
				redirect(admin_url("orders/index"));
			}
		}
	}
	
	//Lây lại sản phẩm
	function return_product()
	{
		$id_product = intval($this->uri->segment(4));
		$id_order = intval($this->uri->segment(5));
		$query = $this->db->get_where('order_detail',array('id_product' => $id_product, 'id_order' => $id_order));
		$info_order_detail = $query->row();
		if(!$info_order_detail)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Thao tác thất bại, vui lòng thử lại.
													  </div>');
			redirect(admin_url("orders/index"));
		}
		$data = array();
		$data = array('status' => 1);
		
		if($this->db->update('order_detail', $data, array('id_product' => $id_product,'id_order' => $id_order)))
		{
			$this->product_model->increase_qty($id_product,$info_order_detail->quantity);
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Sản phẩm đã được mua trở lại.
																  </div>');
			redirect(admin_url("orders/detail/".$id_order));
		}
	}
	
	function fetch()
	{
		$this->load->model('orders_model');
		if(isset($_POST['view'])){
		if($_POST["view"] != '')
		{
			$this->orders_model->update_rule(array('view'=>0), array('view'=>1));
			//$update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
			//mysqli_query($con, $update_query);
		}
		$input = array();
		$input['order'] = array('id','desc');
		$input['limit'] = array('5','0');
		$list_order = $this->orders_model->get_list($input);
		pre($list_order);
		//$query = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
		//$result = mysqli_query($con, $query);
		$output = '';
		if(count($list_order) > 0)
		{
		foreach($list_order as $row)
		 {
		   $output .= '
		   	<p>Tổng giá trị đơn hàng: <span style="color:red!important">'.number_format($row->total).' vnđ<span></p>								
			<p><span>Lúc '. date('H:i:s',$row->created).', ngày '.date('d/m/Y',$row->created).'</span></p>
		   ';

		 }
		}
		else{
			 $output .= '
			 <p>Không có đơn hàng được tìm thấy.</p>
			 ';
			 
		}


		$input_status = array();
		$input_status['where'] = array('view'=>0);
		$list_status_order = $this->orders_model->get_list($input_status);
		//$status_query = "SELECT * FROM comments WHERE comment_status=0";
		//$result_query = mysqli_query($con, $status_query);
		$count = count($list_status_order);
		$data = array(
			'notification' => $output,
			'unseen_notification'  => $count
		);
		
		echo json_encode($data);
		
		}


	}

}
?>
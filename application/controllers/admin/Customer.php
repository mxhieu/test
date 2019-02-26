<?

class customer extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
	}

	function load_customer()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->set_userdata('search');
		}
		redirect(admin_url('customer'));
	}
	
	function load_account_cus_lock()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->set_userdata('search');
		}
		redirect(admin_url('customer/account_cus_lock'));
	}
	
	function index($rowno = 0)
	{
		//nếu tìm kiếm bằng true
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->customer_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Có <strong> '.$total.'</strong> tài khoản được tìm thấy.
							  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
								<a href="'.admin_url('customer/load_customer').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Không có tài khoản được tìm thấy.
							  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->customer_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		$this->data['message'] = $message;
		$total_rows = $this->customer_model->get_total_row(1,$search_text);
		$this->data['search_text'] = $search_text;
		//Phân trang
		
		$this->data['total_rows'] = $total_rows;
		$this->load->library("pagination");
		$config['base_url'] = admin_url("customer/index"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;

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
		


		$list_member = $this->customer_model->get_like(1,$search_text,$config['per_page'],$rowno);
		//Danh sách biến được gửi sang view
		$this->data['total_rows'] = $total_rows;
		$this->data['list_member'] = $list_member;
		$this->data['message'] = $message;
		//master layout
		$this->data['temp'] = 'admin/customer/index';
		$this->load->view('admin/main',$this->data);
	}

	//Tai khoan bi khoa
	function account_cus_lock($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->customer_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> tài khoản được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('customer/load_customer').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có tài khoản được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->customer_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		$this->data['message'] = $message;
		$total_rows = $this->customer_model->get_total_row(0,$search_text);
		$this->data['search_text'] = $search_text;
		//Phân trang
		
		$this->data['total_rows'] = $total_rows;
		$this->load->library("pagination");
		$config['base_url'] = admin_url("customer/account_lock"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = $this->per_page;

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
		$list_member = $this->customer_model->get_like(0,$search_text,$config['per_page'],$rowno);
	
		//Danh sách biến được gửi sang view
		$this->data['total_rows'] = $total_rows;
		$this->data['list_member'] = $list_member;
		$this->data['message'] = $message;
		//master layout
		$this->data['temp'] = 'admin/customer/lock_account_cus';
		$this->load->view('admin/main',$this->data);
	}



	
	function lock()
	{
		$id = intval($this->uri->segment(4));
		$info_member = $this->customer_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$data = array('status'=>'0');
		if($this->customer_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Thành công!</strong> Bạn đã khóa thành công tài khoản.
														  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> khóa tài khoản thất bại.
													  </div>');
		}
		redirect(admin_url("customer/load_account_cus"));
	}
	
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_member = $this->customer_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$data = array('status'=>'1');
		if($this->customer_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Thành công!</strong> Bạn đã mở khóa thành công tài khoản.
														  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> mở khóa tài khoản thất bại.
													  </div>');
		}
		redirect(admin_url("customer/account_cus_lock"));
	}
	
	function reset_password()
	{
		$id = intval($this->uri->segment(4));
		$info_member = $this->customer_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$data = array('password' => md5(123456));
		if($this->customer_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Thành công!</strong> Bạn đã đặt lại mật khẩu thành công, mật khẩu mặt định là 123456.
														  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> đặt lại mật khẩu thất bại.
													  </div>');
		}
		redirect(admin_url("customer/index"));
	}
}
?>

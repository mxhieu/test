<?
class Members extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('members_model');
	}

	function load_members()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->set_userdata('search');
		}
		redirect(admin_url('members'));
	}
	
	function load_account_lock()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->set_userdata('search');
		}
		redirect(admin_url('members/account_lock'));
	}
	
	function index($rowno = 0)
	{
		//nếu tìm kiếm bằng true
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->members_model->get_total_row(1,$search_text);
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
																<a href="'.admin_url('members/load_members').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có tài khoản được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->members_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		$this->data['message'] = $message;
		$total_rows = $this->members_model->get_total_row(1,$search_text);
		$this->data['search_text'] = $search_text;
		//Phân trang
		
		$this->data['total_rows'] = $total_rows;
		$this->load->library("pagination");
		$config['base_url'] = admin_url("members/index"); //Link hiển thị danh sách sản phẩm
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
		


		$list_member = $this->members_model->get_like(1,$search_text,$config['per_page'],$rowno);
		//Danh sách biến được gửi sang view
		$this->data['total_rows'] = $total_rows;
		$this->data['list_member'] = $list_member;
		$this->data['message'] = $message;
		//master layout
		$this->data['temp'] = 'admin/members/index';
		$this->load->view('admin/main',$this->data);
	}

	//Tai khoan bi khoa
	function account_lock($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->members_model->get_total_row(0,$search_text);
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
																<a href="'.admin_url('members/load_members').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có tài khoản được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->members_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		$this->data['message'] = $message;
		$total_rows = $this->members_model->get_total_row(0,$search_text);
		$this->data['search_text'] = $search_text;
		//Phân trang
		
		$this->data['total_rows'] = $total_rows;
		$this->load->library("pagination");
		$config['base_url'] = admin_url("members/account_lock"); //Link hiển thị danh sách sản phẩm
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
		$list_member = $this->members_model->get_like(0,$search_text,$config['per_page'],$rowno);
	
		//Danh sách biến được gửi sang view
		$this->data['total_rows'] = $total_rows;
		$this->data['list_member'] = $list_member;
		$this->data['message'] = $message;
		//master layout
		$this->data['temp'] = 'admin/members/account_lock';
		$this->load->view('admin/main',$this->data);
	}

	function check_username(){
		$username = $this->input->post("username");
		$where = array("username" => $username);
		if($this->members_model->check_exists($where))
		{
			//trả về thông báo lỗi
			$this->form_validation->set_message("check_username","tài khoản đã tồn tại");
			return false;	
		}
		return true;
	}
	function add()
	{
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->load->library("upload_library");
			$this->form_validation->set_rules('email','email','required|min_length[8]|max_length[200]|valid_email|callback_check_email');
			$this->form_validation->set_rules('name','Tên','required|min_length[8]|max_length[100]');
			$this->form_validation->set_rules('username','Tài khoản','required|min_length[6]|max_length[50]|callback_check_username|alpha_dash');
			$this->form_validation->set_rules('password','Mật khẩu','required');
			$this->form_validation->set_rules('repassword',' Nhập lại mật khẩu','required|matches[password]');
			if($this->form_validation->run())
			{
				$image='';
				$image_upload = $this->upload_library->upload('./upload/member','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				if($image_upload =='')
					$image = "no_img.jpg";
				$name = $this->input->post("name");
				$username = $this->input->post("username");
				$password = $this->input->post("password");
				$email = $this->input->post("email");
				$data = array(
					'name' => $name,
					'username' => $username,
					'email' => $email,
					'password' => md5($password),
					'image' => $image,
					'created' => time(),
				);
				$this->config->load('permissions',true);
				$config_permissions = $this->config->item('permissions');
				$permissions = $this->input->post('permissions');

				if($permissions =='order')
				{
					$data['permissions'] = json_encode($config_permissions['member_order']);
					$data['id_group'] = 1;
				}
				if($permissions =='user_admin')
				{
					$data['permissions'] = json_encode($config_permissions['member_user']);
					$data['id_group'] = 2;
				}
				if($permissions =='master_admin')
				{
					$data['permissions'] = json_encode($config_permissions['member_master_admin']);
					$data['id_group'] = 0;
				}
				if($this->members_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn thêm thành công tài khoản.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> thêm tài khoản thất bại.
															  </div>');
					
				}
				redirect(admin_url("members"));
				
			}
			//echo " <script>alert('run that bai')</script>";
		}
		//In ra mãng quyền.


		
		$this->data['temp'] = 'admin/members/add';
		$this->load->view('admin/main',$this->data);
	}

	function edit()
	{
		$id = intval($this->uri->segment(4));
		$info_member = $this->members_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$this->data['info_member'] = $info_member;
		$info_member->permissions = json_decode($info_member->permissions);
		//pre($info_member);
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->load->library("upload_library");
			$this->load->library("upload_library");
			$this->form_validation->set_rules('name','Tên','required|min_length[8]|max_length[100]');
			$this->form_validation->set_rules('username','Tài khoản','required|min_length[6]|max_length[50]|callback_check_username|alpha_dash');
			$this->form_validation->set_rules('password','Mật khẩu','required');
			$this->form_validation->set_rules('repassword',' Nhập lại mật khẩu','required|matches[password]');
			$password = $this->input->post("password");
			if($password)
			{
				$this->form_validation->set_rules("password","Mật khẩu","min_length[6]");
				$this->form_validation->set_rules("repassword","Nhập lại mật khẩu","matches[password]");
			}
			if($this->form_validation->run())
			{
				$image='';
				$image_upload = $this->upload_library->upload('./upload/member','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				$name = $this->input->post("name");
				$username = $this->input->post("username");
				
				
				$email = $this->input->post("email");
				$data = array(
					'name' => $name,
					'username' => $username,
					'email' => $email,
					'created' => time(),
				);
				$this->config->load('permissions',true);
				$config_permissions = $this->config->item('permissions');
				$permissions = $this->input->post('permissions');
				if($permissions =='order')
				{
					$data['permissions'] = json_encode($config_permissions['member_order']);
					$data['id_group'] = 1;
				}
				if($permissions =='user_admin')
				{
					$data['permissions'] = json_encode($config_permissions['member_user']);
					$data['id_group'] = 2;
				}
				if($permissions =='master_admin')
				{
					$data['permissions'] = json_encode($config_permissions['member_master_admin']);
					$data['id_group'] = 0;
				}
				if($password)
				{
					$data['password'] = md5($password);
				}
				if($image)
				{
					$data['image'] = $image;
				}
				if($this->members_model->update($info_member->id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Thành công!</strong> Bạn đã cập nhật thành công.
														  </div>');
				}
			}
			redirect(admin_url("members"));
		}
		
		$this->config->load('permissions',true);
		$config_permissions = $this->config->item('permissions');
		$this->data['config_permissions'] = $config_permissions;
		
		$this->data['temp'] = 'admin/members/edit';
		$this->load->view('admin/main',$this->data);
	}

	function lock()
	{
		$id = intval($this->uri->segment(4));
		if($id==1)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> Bạn không thể xóa tài khoản root.
													  </div>');
		}
		else
		{
			$info_member = $this->members_model->get_info($id);
			if(!$info_member)
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
			}
			$data = array('status'=>'0');
			if($this->members_model->update($id,$data))
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
		}
		redirect(admin_url("members"));
	}
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_member = $this->members_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$data = array('status'=>'1');
		if($this->members_model->update($id,$data))
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
		redirect(admin_url("members/account_lock"));
	}
	
	function profile()
	{
		$id = $_SESSION['admin_id'];
		$info_member = $this->members_model->get_info($id);
		if(!$info_member)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tài khoản.
											  </div>');
		}
		$this->data['info_member'] = $info_member;
		$info_member->permissions = json_decode($info_member->permissions);
		//pre($info_member);
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->load->library("upload_library");
			$this->form_validation->set_rules('name','Tên','required|min_length[8]');
			$this->form_validation->set_rules('username','Tài khoản','required|min_length[6]');
			$password = $this->input->post("password");
			if($password)
			{
				$this->form_validation->set_rules("password","Mật khẩu","min_length[6]");
				$this->form_validation->set_rules("repassword","Nhập lại mật khẩu","matches[password]");
			}
			if($this->form_validation->run())
			{
				$image='';
				$image_upload = $this->upload_library->upload('./upload/member','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				$name = $this->input->post("name");
				$username = $this->input->post("username");
				
				
				$email = $this->input->post("email");
				$data = array(
					'name' => $name,
					'username' => $username,
					'email' => $email,
					'created' => time(),
				);

				if($password)
				{
					$data['password'] = md5($password);
				}
				if($image)
				{
					$data['image'] = $image;
				}
				if($this->members_model->update($info_member->id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Thành công!</strong> Bạn đã cập nhật thành công.
														  </div>');
				}
			}
			redirect(admin_url("members"));
		}
		//master layout
		$this->data['temp'] = 'admin/members/profile';
		$this->load->view('admin/main',$this->data);
	}
	
	function check_email()
	{
		$email = $this->input->post("email");
		$where = array("email" => $email);
		if($this->members_model->check_exists($where))
		{
			//trả về thông báo lỗi
			$this->form_validation->set_message("check_email","Email đã tồn tại");
			return false;	
		}
		return true;
	}
}
?>
<?
class Provider extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('provider_model');
	}
	
	function load_provider()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/provider/index');
	}
	
	function load_lock_provider()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/provider/lock_provider');
	}
	
	function index($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->provider_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> nhà cung cấp được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('provider/load_provider').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có nhà cung cấp được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->provider_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->provider_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("provider/index"); //Link hiển thị danh sách sản phẩm
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
		$list_provider = $this->provider_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_provider'] = $list_provider;

		$this->data['temp'] = 'admin/provider/index';
		$this->load->view('admin/main',$this->data);
	}


	function lock_provider($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->provider_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> nhà cung cấp được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('provider/load_lock_provider').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có nhà cung cấp được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->provider_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->provider_model->get_total_row(0,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("provider/lock_provider"); //Link hiển thị danh sách sản phẩm
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
		$list_provider = $this->provider_model->get_like(0,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_provider'] = $list_provider;

		$this->data['temp'] = 'admin/provider/lock_provider';
		$this->load->view('admin/main',$this->data);
	}


	function add()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên nhà cung cấp','required|max_length[200]');
			$this->form_validation->set_rules('phone','Số điện thoại','numeric');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[500]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[500]');
			if($this->form_validation->run())
			{
				$name = $this->input->post('name');
				$phone = $this->input->post('phone');
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$address = $this->input->post('address');
				$data = array('name'=>$name,
							  'phone'=>$phone,
							  'keyword' => $keyword,
							  'address' => $address,
							  'description'=>$description,
							  'created' => time()
							);
				if($this->provider_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã thêm thành công nhà cung cấp.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	<strong>Thất bại!</strong> Thêm nhà cung cấp thất bại.
															  </div>');
				}
				redirect(admin_url("provider"));
			}
			
		}

		$this->data['temp'] = 'admin/provider/add';
		$this->load->view('admin/main',$this->data);
	}

	function edit()
	{
		$id = intval($this->uri->segment(4));
		$info_provider = $this->provider_model->get_info($id);
		if(!$info_provider)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> Không có nhà cung cấp.
													</div>');
			redirect(admin_url("provider"));
		}
		$this->data['info_provider'] = $info_provider;

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên nhà cung cấp','required|max_length[200]');
			$this->form_validation->set_rules('phone','Số điện thoại','numeric');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[500]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[500]');
			if($this->form_validation->run())
			{
				$name = $this->input->post('name');
				$phone = $this->input->post('phone');
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$address = $this->input->post('address');
				$data = array('name'=>$name,
							  'phone'=>$phone,
							  'keyword' => $keyword,
							  'address' => $address,
							  'description'=>$description,
							  'created' => time()
							);
				if($this->provider_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã cập nhật thành công nhà cung cấp.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> cập nhật nhà cung cấp thất bại.
															</div>');
				}
				redirect(admin_url("provider"));
			}
			
		}
		$this->data['temp'] = 'admin/provider/edit';
		$this->load->view('admin/main',$this->data);
	}

	function lock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->provider_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có nhà cung cấp');</script>";
		}
		$data = array('status'=>'0');
		if($this->provider_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã khóa thành công nhà cung cấp.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> Khóa nhà cung cấp thất bại.
															</div>');
		}
		redirect(admin_url("provider"));
	}
	
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->provider_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có nhà cung cấp');</script>";
		}
		$data = array('status'=>'1');
		if($this->provider_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã mở khóa thành công nhà cung cấp.
													  </div>');
			
		}		
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong>mở khóa nhà cung cấp thất bại.
															</div>');
		}
		redirect(admin_url("provider/lock_provider"));
	}
}
?>
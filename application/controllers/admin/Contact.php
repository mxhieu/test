<?
class Contact extends MY_Controller
{
	
	var $per_page = 10;
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
	}

	function load_contact()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/contact/index');
	}
	
	function load_seen()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/contact/seen');
	}
	
	function index($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->contact_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Có <strong> '.$total.'</strong> ý kiến được tìm thấy.
								  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
								<a href="'.admin_url('contact/load_contact').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Không có ý kiến được tìm thấy.
							  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->contact_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->contact_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("contact/index"); //Link hiển thị danh sách sản phẩm
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
		$list_contact = $this->contact_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_contact'] = $list_contact;
		
		$this->data['temp'] = 'admin/contact/index';
		$this->load->view('admin/main',$this->data);
	}
	
	
	function seen($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->contact_model->get_total_row(0,$search_text);
			if($total>0)
			{
				$message =  '<div class="alert alert-success alert-dismissible">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									Có <strong> '.$total.'</strong> ý kiến được tìm thấy.
								  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
								<a href="'.admin_url('contact/load_contact').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Không có ý kiến được tìm thấy.
							  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->contact_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->contact_model->get_total_row(0,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("contact/seen"); //Link hiển thị danh sách sản phẩm
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
		$list_contact = $this->contact_model->get_like(0,$search_text,$config['per_page'],$rowno);

		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_contact'] = $list_contact;
		
		$this->data['temp'] = 'admin/contact/seen';
		$this->load->view('admin/main',$this->data);
	}
	function hasseen()
	{
		$id = intval($this->uri->segment(4));
		$info_contact = $this->contact_model->get_info($id);
		if(!$info_contact)
		{
			$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> thao tác thất bại.
													  </div>');
			redirect(admin_url("contact"));
													  
		}
		$data = array('status'=>'0');
		if($this->contact_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã xem ý kiến.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> xem ý kiến thất bại.
													  </div>');
		}
		redirect(admin_url("contact"));
	}
	
	function reply()
	{
		$id = intval($this->uri->segment(4));
		$info_cus = $this->contact_model->get_info($id);
		if(!$info_cus)
		{
			$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> Không có ý kiến được yêu cầu.
													  </div>');
			redirect(admin_url('contact'));
		}
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title','tiêu đề','required|max_length[200]|min_length[10]');
			$this->form_validation->set_rules('content','Nội dung','required|max_length[1000]');
			if($this->form_validation->run())
			{
				$email = $this->input->post('email');
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				if($this->contact_model->reply_message($title,$content,$email))
				{
					$data = array('status'=>'0');
					$this->contact_model->update($id,$data);
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã trả lời thành công cho khách hàng.
													  </div>');
				}
				else
				{
					$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> trả lời thất bại.
													  </div>');
				}
				redirect(admin_url('contact'));
			}
		}
		
		$this->data['info_cus'] = $info_cus;
		$this->data['temp'] = 'admin/contact/reply';
		$this->load->view('admin/main',$this->data);
	}
}
?>
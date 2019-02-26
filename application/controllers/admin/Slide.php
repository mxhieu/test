<?
class Slide extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("slide_model");
	}

	function load_slide()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('slide'));
	}
	
	function load_lock_slide()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('slide/lock_slide'));
	}
	
	function index($rowno = 0)
	{

	$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->slide_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> slide được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('slide/load_slide').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có slide được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->slide_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->slide_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("slide/index"); //Link hiển thị danh sách sản phẩm
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
		$list_slide = $this->slide_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_slide'] = $list_slide;
	
		/**
		 * Hiển thị view
		 */
		$this->data['temp'] = 'admin/slide/index';
		$this->load->view('admin/main',$this->data);
	}

	function lock_slide($rowno = 0)
	{

	$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->slide_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> slide được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('slide/load_slide').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có slide được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->slide_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->slide_model->get_total_row(0,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("slide/index"); //Link hiển thị danh sách sản phẩm
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
		$list_slide = $this->slide_model->get_like(0,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_slide'] = $list_slide;
	
		/**
		 * Hiển thị view
		 */
		$this->data['temp'] = 'admin/slide/lock_slide';
		$this->load->view('admin/main',$this->data);
	}
	
	function add()
	{
		$this->load->library('upload_library');
		//Danh sách nhà cung cấp
		$input = array();
		$input['where'] = array('status'=>1);
		$this->load->model('slide_model');
		$list_slide = $this->slide_model->get_list($input);
		$this->data['list_slide'] = $list_slide;

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[100]');
			$this->form_validation->set_rules('link','Link','required|max_length[200]');

			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$link = $this->input->post("link");
				$position = $this->input->post("position");
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/slide/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				$data = array(
					'name' => $name,
					'link' => $link,
					'position' => $position,
					'image' => $image,
					'author' => $_SESSION['name'],
					'created' => time()
				);
				
				if($this->slide_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Thêm thành công slide.
																  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Thao tác thất bại
															  </div>');
				}
				redirect(admin_url("slide"));
			}
		}
		$this->data['temp'] = 'admin/slide/add';
		$this->load->view('admin/main',$this->data);
	}

	function edit()
	{
		$this->load->library('upload_library');
		$id = intval($this->uri->segment(4));
		$info_slide = $this->slide_model->get_info($id);
		$this->data['info_slide'] = $info_slide;
		if(!$info_slide)
		{
			$this->session->set_flashdata('message','<script>swal("Oops!", "Không có slide!", "error");</script>');
			redirect(admin_url("slide"));
		}
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[100]');
			$this->form_validation->set_rules('link','Link','required|max_length[200]');

			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$link = $this->input->post("link");
				$position = $this->input->post("position");
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/slide/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}

				$data = array(
					'name' => $name,
					'link' => $link,
					'created' => time()
				);
				if($position !='')
				{
					$data['position'] = $position;
				}
				if($image !='')
				{
					$image_link = './upload/slide/'.$info_slide->image;
					if(file_exists($image_link))
					{
						unlink($image_link);
					}
					$data['image'] = $image;
				}
				if($this->slide_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Cập nhật thành công slide.
																  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Thao tác thất bại
															  </div>');
					
				}
				redirect(admin_url("slide"));
			}
		}
		$this->data['temp'] = 'admin/slide/edit';
		$this->load->view('admin/main',$this->data);
	}

	function lock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->slide_model->get_info($id);
		if(!$info_catalog)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có slide.
										  </div>');
		}
		$data = array('status'=>'0');
		if($this->slide_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã khóa thành công slide.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> khóa slide thất bại.
													  </div>');
		}
		redirect(admin_url("slide"));
	}
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->slide_model->get_info($id);
		if(!$info_catalog)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có slide.
										  </div>');
		}
		$data = array('status'=>'1');
		if($this->slide_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã mở khóa thành công slide.
													  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> mở khóa slide thất bại.
													  </div>');
		}
		redirect(admin_url("slide/lock_slide"));
	}
}
?>
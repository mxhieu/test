<?
class News extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	function load_news()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('news'));
	}
	
	function load_lock_news()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect(admin_url('news/lock_news'));
	}
	
	function index($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->news_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> tin tức được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('news/load_news').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có tin tức được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->news_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->news_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("news/index"); //Link hiển thị danh sách sản phẩm
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
		$list_news = $this->news_model->get_like(1,$search_text,$config['per_page'],$rowno);

		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_news'] = $list_news;


		$this->data['temp'] = 'admin/news/index';
		$this->load->view('admin/main',$this->data);
	}
	
	function lock_news($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->news_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> tin tức được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('news/load_news').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có tin tức được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->news_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}

		$total_rows = $this->news_model->get_total_row(0,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("news/lock_news"); //Link hiển thị danh sách sản phẩm
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
		$list_news = $this->news_model->get_like(0,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list_news'] = $list_news;

		$this->data['temp'] = 'admin/news/lock_news';
		$this->load->view('admin/main',$this->data);
	}

	function add()
	{
		$this->load->library('upload_library');

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên tin tức','required|max_length[200]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[500]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[500]');
			$this->form_validation->set_rules('content','Nội dung','required');
			if($this->form_validation->run())
			{
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/news/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				if($image_upload =='')
					$image = "no_img.jpg";
				$name = $this->input->post('name');
				$id_parent_cat = $this->input->post('id_parent_cat');
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$content = $this->input->post('content');
				$data = array('name' =>($name),
							  'slug' =>convert_to_slug($name),
							  'keyword' => ($keyword),
							  'description' => ($description),
							  'content' => ($content),
							  'created' => time(),
							  'author' => ($_SESSION['name']),
							  'image' => $image
				);
				if($this->news_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã thêm thành công tin tức.
															  </div>');
					redirect(admin_url("news"));
				}
				else
				{
					$this->session->set_flashdata('message',' <div class="alert alert-danger alert-dismissible fade in">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	<strong>Thất bại!</strong> Thêm nhà cung cấp thất bại.
															  </div>');
					redirect(admin_url("news"));
				}
				
			}
		}
		
		$this->data['temp'] = 'admin/news/add';
		$this->load->view('admin/main',$this->data);
	}

	function edit()
	{
		$this->load->library('upload_library');
		$id = intval($this->uri->segment(4));
		$info_news = $this->news_model->get_info($id);
		$this->data['info_news'] = $info_news;

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên tin tức','required|max_length[200]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[500]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[500]');
			$this->form_validation->set_rules('content','Nội dung','required');
			if($this->form_validation->run())
			{
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/news/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				$name = $this->input->post('name');
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$content = $this->input->post('content');
				$data = array('name' =>$name,
							  'slug' =>convert_to_slug($name),
							  'keyword' => $keyword,
							  'description' => $description,
							  'content' => $content, 		
							  'created' => time()
				);
				if($image !='')
				{
					$data['image'] = $image;
				}
				if($this->news_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã cập nhật thành công tin tức.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	<strong>Thất bại!</strong> Cập nhật tin tức thất bại.
															  </div>');
				}
				redirect(admin_url("news"));
			}
		}

		$this->data['temp'] = 'admin/news/edit';
		$this->load->view('admin/main',$this->data);
	}

	function lock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->news_model->get_info($id);
		if(!$info_catalog)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tin tức.
										  </div>');
		}
		$data = array('status'=>'0');
		if($this->news_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã khóa thành công tin tức.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> khóa tin tức thất bại.
													  </div>');
		}
		redirect(admin_url("news"));
	}
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->news_model->get_info($id);
		if(!$info_catalog)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Thất bại!</strong> không có tin tức.
										  </div>');
		}
		$data = array('status'=>'1');
		if($this->news_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã mở khóa thành công tin tức.
													  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> mở khóa tin tức thất bại.
													  </div>');
		}
		redirect(admin_url("news/lock_news"));
	}
	function appearance()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->news_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có danh mục');</script>";
		}
		$data = array('hot'=>'1');
		if($this->news_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> bài viết trở thành bài viết nổi bật.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> thao tác thất bại.
													  </div>');
		}
		redirect(admin_url("news"));
	}
	function disappearance()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->news_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có danh mục');</script>";
		}
		$data = array('hot'=>'0');
		if($this->news_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> bài viết hết nổi bật.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> thao tác thất bại.
													  </div>');
		}
		redirect(admin_url("news"));
	}

}
?>
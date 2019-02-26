<?
class Catalog extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("catalog_model");
		$this->load->model("product_model");
	}
	
	function index($rowno = 0)
	{
		//nếu tìm kiếm bằng true
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->catalog_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> danh mục được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('catalog/load_catalog').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có danh mục được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->catalog_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		}
		
		
		$total_rows = $this->catalog_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("catalog/index"); //Link hiển thị danh sách sản phẩm
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
		$list = $this->catalog_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['list'] = $list;
		
		/**
		 * Hiển thị view
		 */
		$this->data['temp'] = 'admin/catalog/index';
		$this->load->view('admin/main',$this->data);
		
	}
	
	//Chuyển trang khi nhấn vào nút quản lý chung và xóa session tìm kiếm
	function load_catalog()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/catalog/index');
	}
	
	//Chuyển trang khi nhấn vào nút danh mục khóa và xóa session tìm kiếm
	function load_lock_catalog()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/catalog/lock_catalog');
		
	}
	
	function lock_catalog($rowno = 0)
	{

		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->catalog_model->get_total_row(0,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> danh mục được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('catalog/load_lock_catalog').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có danh mục được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->catalog_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		}

		//Tổng số danh mục
		$total_rows = $this->catalog_model->get_total_row(0,$search_text);
		
		//Phân trang
		$this->load->library("pagination");
		$config['base_url'] = admin_url("catalog/lock_catalog"); //Link hiển thị danh sách sản phẩm
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
		
		$list = $this->catalog_model->get_like(0,$search_text,$config['per_page'],$rowno);
		
		//Danh sách biến được gửi qua view
		$this->data['total_rows'] = $total_rows;
		$this->data['message'] = $message;
		$this->data['search_text'] = $search_text;
		$this->data['list'] = $list;
		
		/**
		 * Hiển thị view
		 */
		$this->data['temp'] = 'admin/catalog/lock_catalog';
		$this->load->view('admin/main',$this->data);
	}
	
	function add()
	{
		$this->load->library('upload_library');
		$input['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input);
		foreach($catalogs as $row)
		{
			//Danh mục con
			$input_sub['where'] = array('parent_id'=>$row->id);
			$subs = $this->catalog_model->get_list($input_sub);
			$row->subs = $subs;
			foreach($row->subs as $sub)
			{
				$input_last_sub['where'] = array('parent_id'=>$sub->id);
				$last_subs = $this->catalog_model->get_list($input_last_sub);
				$sub->subs = $last_subs;
			}
		}
		$this->data['catalogs'] = $catalogs;
	
		/**
		 * Thêm dữ liệu
		 */
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[200]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[400]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[400]');

			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$parent_id = $this->input->post("parent_catalog");
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/catalog/','image');
				if(isset($image))
				{
					$image = $image_upload;
				}
				if($image_upload =='')
					$image = "no_img.jpg";
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$position = $this->input->post('position');
				$data = array(
					'name' => $name,
					'slug' => convert_to_slug($name),
					'keyword' =>$keyword,
					'description' => $description,
					'image' => $image,
					'author' => $_SESSION['name'],
					'created' => time(),
					'parent_id' => $parent_id
				);
				if(isset($position))
					$data['position'] = $position;
				if($this->catalog_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã thêm thành công danh mục.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> Thêm danh mục thất bại.
															  </div>');
					
				}
				redirect(admin_url("catalog"));
				
			}
		}
		/**
		 * Hiển thị view
		 */
		$this->data['temp'] = 'admin/catalog/add';
		$this->load->view('admin/main',$this->data);
	}

	function lock()
	{
		//Thông tin danh mục
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->catalog_model->get_info($id);
		
		$input_catalog = array();
		$input_catalog['where'] = array('status' => 1,'parent_id'=>$id);
		$list_catalog = $this->catalog_model->get_list($input_catalog);
		if(!empty($list_catalog))
		{
			foreach($list_catalog as $catalog)
			{
				//Danh mục gốc và danh mục cha
				$input = array();
				$input['where'] = array('id' => $catalog->parent_id , 'status'=>1);
				$list_product = $this->product_model->get_list($input);
				
				//Nếu có tồn tại danh mục con và danh mục có sp sẽ không được khóa
				if(!empty($list_product) || !empty($list_catalog))
				{
					$this->session->set_flashdata('message','<script>swal("Oops!", "Khóa thất bại, vui lòng khóa sản phẩm hoặc danh mục con  để khóa danh mục!", "error");</script>');
					redirect(admin_url("catalog"));
				}
			}
		}
		//pre($list_catalog);
		//Danh mục cấp 3
		$input = array();
		$input['where'] = array('id_cat' => $id,'status'=>1);
		$list_subs_product = $this->product_model->get_list($input);
		if(!empty($list_subs_product))
		{
			$this->session->set_flashdata('message','<script>swal("Oops!", "Khóa thất bại, vui lòng khóa sản phẩm để khóa danh mục!", "error");</script>');
			redirect(admin_url("catalog"));
		}

		$data = array('status'=>'0');
		if($this->catalog_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã ẩn danh mục thành công.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> bạn đã ẩn danh mục thất bại.
													</div>');
		}
		redirect(admin_url("catalog"));
	}
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->catalog_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có danh mục');</script>";
		}
		$data = array('status'=>'1');
		if($this->catalog_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Bạn đã hiện danh mục thành công.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> bạn đã hiện danh mục thất bại, danh mục không được xuất hiện.
													</div>');
		}
		redirect(admin_url("catalog/lock_catalog"));
	}
	function edit()
	{
		$this->load->library('upload_library');
		$id = intval($this->uri->segment(4));
		$info = $this->catalog_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> không có danh mục.
													</div>');
			redirect(admin_url("catalog"));
		}
		$info_parent = $this->catalog_model->get_info($info->parent_id);
		$this->data['info_parent'] = $info_parent;
		$this->data['info'] = $info;

		//danh sách catalog
		$input['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input);
		foreach($catalogs as $row)
		{
			//Danh mục con
			$input_sub['where'] = array('parent_id'=>$row->id);
			$subs = $this->catalog_model->get_list($input_sub);
			$row->subs = $subs;
			foreach($row->subs as $sub)
			{
				$input_last_sub['where'] = array('parent_id'=>$sub->id);
				$last_subs = $this->catalog_model->get_list($input_last_sub);
				$sub->subs = $last_subs;
			}
		}
		$this->data['catalogs'] = $catalogs;
		
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[200]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[400]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[400]');

			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$parent_id = $this->input->post("parent_catalog");
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$position = $this->input->post('position');
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/catalog/','image');
				if(isset($image))
				{
					$image = $image_upload;
				}
				$data = array(
					'name' => $name,
					'slug' => convert_to_slug($name),
					'keyword' =>$keyword,
					'description' => $description,
					'created' => time(),
					'parent_id' => $parent_id
				);
				if($image!='')
				{
					$data['image'] = $image;
				}
				if(isset($position))
					$data['position'] = $position;
				if($this->catalog_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã cập nhật thành công danh mục.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> bạn đã cập nhật thất bại.
															</div>');
					
				}
				redirect(admin_url("catalog"));
				
			}
	}
	$this->data['temp'] = 'admin/catalog/edit';
	$this->load->view('admin/main',$this->data);
	}

	//Xuất hiện ở trang chủ hay không
	function appearance()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->catalog_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có danh mục');</script>";
		}
		$data = array('show_index'=>'1');
		if($this->catalog_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Danh mục đã là danh mục nổi bật.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> danh mục không được nổi bật.
													</div>');
		}
		redirect(admin_url("catalog"));
	}
	
	function disappearance()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->catalog_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có danh mục');</script>";
		}
		$data = array('show_index'=>'0');
		if($this->catalog_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công!</strong> Danh mục không còn là danh mục nổi bật.
													  </div>');
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại!</strong> danh mục không được nổi bật.
													</div>');
		}
		redirect(admin_url("catalog"));
	}
	
}
?>
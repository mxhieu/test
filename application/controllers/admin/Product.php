<?
class Product extends MY_Controller
{
	var $per_page = 10;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
	}

	function load_product()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/product/index');
	}
	
	function load_lock_product()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/product/lock_product');
	}
	
	function load_out_of_product()
	{
		if(isset($_SESSION['search']))
		{
			$this->session->unset_userdata('search');
		}
		redirect('index.php/admin/product/out_of_product');
	}
	
	function index($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->product_model->get_total_row(1,$search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> sản phẩm được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('product/load_product').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có sản phẩm được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->product_model->get_total_row(1,$search_text);
			}
			$message = $this->session->flashdata('message');
		};
		$total_rows = $this->product_model->get_total_row(1,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("product/index"); //Link hiển thị danh sách sản phẩm
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
		$list_product = $this->product_model->get_like(1,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['list_product'] = $list_product;
		$this->data['total_rows'] = $total_rows;
		//Thông báo
		$this->data['message'] = $message;
		//Load view
		$this->data['temp'] = 'admin/product/index';
		$this->load->view('admin/main',$this->data);
	}

	function lock_product($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->product_model->get_total_row(0,$search_text);
			if($total>0)
			{
				$message =  '<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	Có <strong> '.$total.'</strong> sản phẩm được tìm thấy.
																  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('product/load_lock_product').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có sản phẩm được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->product_model->get_total_row(0,$search_text);
			}
			$message = $this->session->flashdata('message');
		};
		$total_rows = $this->product_model->get_total_row(0,$search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("product/index"); //Link hiển thị danh sách sản phẩm
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
		$list_product = $this->product_model->get_like(0,$search_text,$config['per_page'],$rowno);
		
		$this->data['search_text'] = $search_text;
		$this->data['list_product'] = $list_product;
		$this->data['total_rows'] = $total_rows;
		//Thông báo
		$this->data['message'] = $message;
		//Load view
		$this->data['temp'] = 'admin/product/lock_product';
		$this->load->view('admin/main',$this->data);
	}

	//Phương thức kiểm tra có phải dropdown là mặc định
	function check_default($post_string)
	{
	  return $post_string == '0' ? FALSE : TRUE;
	}

	function add()
	{
		$this->load->library('upload_library');
		$this->load->model('catalog_model');
		/**
		 * Danh muc
		 */
		$input_catalog['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input_catalog);
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
	
		//Danh sách nhà cung cấp
		$input = array();
		$input['where'] = array('status'=>1);
		$this->load->model('provider_model');
		$list_provider = $this->provider_model->get_list($input);
		$this->data['list_provider'] = $list_provider;

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[100]');
			$this->form_validation->set_rules('quantity','Số lượng','required|numeric|greater_than[0]');
			$this->form_validation->set_rules('price','Gía','required|numeric|greater_than[0]');
			$this->form_validation->set_rules('discount','Giảm giá','numeric|greater_than_equal_to[0]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[100]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[200]');
			$this->form_validation->set_rules('provider','Nhà cung cấp','required|callback_check_default');
			$this->form_validation->set_rules('id_cat','Danh mục','required|callback_check_default');
  			$this->form_validation->set_message('check_default', 'Vui lòng chọn');
			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$provider = $this->input->post("provider");
				$price = $this->input->post("price");
				$discount = $this->input->post("discount");
				$quantity = $this->input->post("quantity");
				$style = $this->input->post("style");
				$origin = $this->input->post("origin");
				$element = $this->input->post("element");
				$uses = $this->input->post("uses");
				$usage_medicine = $this->input->post("usage_medicine");
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/product/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				if($image_upload =='')
					$image = "no_img.jpg";
				$image_list = array();
				$image_list = $this->upload_library->multi_upload('./upload/product/','image_list');
				$image_list = json_encode($image_list);
				$id_cat = $this->input->post("id_cat");
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$content = $this->input->post('content');
				//$id_provider = $this->input->post('id_provider');
				$price = $price - ($price*$discount/100);
				$data = array(
					'name' => $name,
					'slug' => convert_to_slug($name),
					'price' => $price,
					'discount' => $discount,
					'quantity' => $quantity,
					'image' => $image,
					'image_list' => $image_list,
					'id_cat' => $id_cat,
					'id_provider' => $provider,
					'style' =>$style,
					'origin' =>$origin,
					'element' =>$element,
					'uses' =>$uses,
					'keyword'=>$keyword,
					'usage_medicine' =>$usage_medicine,
					'description' => $description,
					'created' => time(),
					'author' => $_SESSION['name'],
					'content' => $content
				);
				if($this->product_model->create($data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	<strong>Thành công! </strong> bạn đã thêm thành công sản phẩm.
																  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại! </strong> bạn đã thêm thất bại sản phẩm.
															  </div>');
					
				}
				redirect(admin_url("product"));
				
			}
		}
		$this->data['temp'] = 'admin/product/add';
		$this->load->view('admin/main',$this->data);
	}

	function edit()
	{
		$this->load->library('upload_library');
		$id = intval($this->uri->segment(4));
		$info_product = $this->product_model->get_info($id);
		if(!$info_product)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại! </strong> không có sản phẩm được tìm thấy.
															  </div>');
			redirect(admin_url("product"));
		}
		$this->data['info_product'] = $info_product;

		$this->load->model('catalog_model');
		$input_catalog['where'] = array('parent_id' => 0);
		$catalogs = $this->catalog_model->get_list($input_catalog);
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

		//Danh sách nhà cung cấp
		$input = array();
		$input['where'] = array('status'=>1);
		$this->load->model('provider_model');
		$list_provider = $this->provider_model->get_list($input);
		
		$this->data['list_provider'] = $list_provider;

		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên','required|max_length[100]');
			$this->form_validation->set_rules('quantity','Số lượng','required|numeric|greater_than[0]');
			$this->form_validation->set_rules('price','Gía','required|numeric|greater_than[0]');
			$this->form_validation->set_rules('discount','Giảm giá','numeric|greater_than_equal_to[0]');
			$this->form_validation->set_rules('keyword','Từ khóa','required|max_length[100]');
			$this->form_validation->set_rules('description','Mô tả','required|max_length[200]');
			$this->form_validation->set_rules('provider','Nhà cung cấp','required|callback_check_default');
			$this->form_validation->set_rules('id_cat','Danh mục','required|callback_check_default');
  			$this->form_validation->set_message('check_default', 'Vui lòng chọn');
			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$provider = $this->input->post("provider");
				$price = $this->input->post("price");
				$discount = $this->input->post("discount");
				$style = $this->input->post("style");
				$origin = $this->input->post("origin");
				$element = $this->input->post("element");
				$uses = $this->input->post("uses");
				$usage_medicine = $this->input->post("usage_medicine");
				$image = '';
				$image_upload = $this->upload_library->upload('./upload/product/','image');
				if(isset($image_upload))
				{
					$image = $image_upload;
				}
				$image_list = array();
				$image_list = $this->upload_library->multi_upload('./upload/product/','image_list');
				$image_list_json = json_encode($image_list);
				$id_cat = $this->input->post("id_cat");
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$content = $this->input->post('content');
				$price = $price - ($price*$discount/100);
				//$id_provider = $this->input->post('id_provider');
				$data = array(
					'name' => $name,
					'slug' => convert_to_slug($name),
					'price' => $price,
					'discount' => $discount,
					'id_cat' => $id_cat,
					'id_provider' => $provider,
					'style' =>$style,
					'origin' =>$origin,
					'element' =>$element,
					'uses' =>$uses,
					'keyword'=>$keyword,
					'usage_medicine' =>$usage_medicine,
					'description' => $description,
					'created' => time(),
					'content' => $content
				);
				if(!empty($image_list))
				{
					$data['image_list'] = $image_list_json;
				}
				if($image!='')
				{
					$data['image'] = $image;
				}
				if($this->product_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																	<strong>Thành công! </strong> bạn đã cập nhật thành công sản phẩm.
																  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại! </strong> bạn đã cập nhật thất bại sản phẩm.
															  </div>');
				}
				redirect(admin_url("product"));
				
			}
		}

		
		$this->data['temp'] = 'admin/product/edit';
		$this->load->view('admin/main',$this->data);
	}

	

	function lock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->product_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có sản phẩm');</script>";
		}
		$data = array('status'=>'0');
		if($this->product_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công! </strong> bạn ẩn thành công sản phẩm.
													  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại! </strong> bạn đã ẩn thất bại sản phẩm.
													  </div>');
		}
		redirect(admin_url("product"));
	}
	function unlock()
	{
		$id = intval($this->uri->segment(4));
		$info_catalog = $this->product_model->get_info($id);
		if(!$info_catalog)
		{
			echo "<script>alert('không có sản phẩm');</script>";
		}
		$data = array('status'=>'1');
		if($this->product_model->update($id,$data))
		{
			$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thành công! </strong> bạn đã hiện thành công sản phẩm.
													  </div>');
			
		}
		else
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<strong>Thất bại! </strong> bạn đã hiện sản phẩm thất bại.
													  </div>');
		}
		redirect(admin_url("product/lock_product"));
	}
	
	function out_of_product($rowno = 0)
	{
		$search_text = "";
		if($this->input->post())
		{	
			$search_text = $this->input->post('s');
			$this->session->set_userdata(array("search"=>$search_text));
			$total = $this->product_model->get_total_oop($search_text);
			if($total>0)
			{
				
				$message =  '<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								Có <strong> '.$total.'</strong> sản phẩm được tìm thấy.
							  </div>';
			}
			else
			{
				$message = '<div class="alert alert-danger alert-dismissible fade in">
																<a href="'.admin_url('product/load_product').'" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có sản phẩm được tìm thấy.
															  </div>';
			}
		}
		else
		{
			if($this->session->userdata('search') != NULL)
			{
				$search_text = $this->session->userdata('search');
				$total = $this->product_model->get_total_oop($search_text);
			}
			$message = $this->session->flashdata('message');
		};
		$total_rows = $this->product_model->get_total_oop($search_text);
		
		//Phân trang

		$this->load->library("pagination");
		$config['base_url'] = admin_url("product/out_of_product"); //Link hiển thị danh sách sản phẩm
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
		$list_product = $this->product_model->get_out_of_product($search_text,$config['per_page'],$rowno,$bouht=true);
		
		$this->data['search_text'] = $search_text;
		$this->data['list_product'] = $list_product;
		$this->data['total_rows'] = $total_rows;
		//Thông báo
		$this->data['message'] = $message;

		$this->data['temp'] = 'admin/product/out_of_product';
		$this->load->view('admin/main',$this->data);
	}
	
	function add_quantity()
	{
		$this->load->library('upload_library');
		$id = intval($this->uri->segment(4));
		$info_product = $this->product_model->get_info($id);
		if(!$info_product)
		{
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																Không có sản phẩm được tìm thấy.
															  </div>');
			redirect(admin_url("product"));
		}
		$this->data['info_product'] = $info_product;
		if($this->input->post())
		{
			$this->form_validation->set_rules('quantity','Số lương','required|numeric|greater_than[0]');

			if($this->form_validation->run())
			{
				
				$quantity =$this->input->post("quantity");
				//$id_provider = $this->input->post('id_provider');
				$data = array(
					'quantity' => $quantity,
				);
				if($this->product_model->update($id,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													<strong>Thành công! </strong>sản phẩm đã được bán trở lại.
												  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại! </strong>thêm số lượng thất bại.
															  </div>');
				}
				redirect(admin_url("product/out_of_product"));
			}
		}
		$this->data['temp'] = 'admin/product/add_quantity';
		$this->load->view('admin/main',$this->data);
	}
}
?>
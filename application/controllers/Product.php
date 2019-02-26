<?
class Product extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('catalog_model');
	}

	function detail()
	{
		//Lấy thông tin sản phẩm theo id
		$id = intval($this->uri->rsegment(3));
		$info_product = $this->product_model->get_info($id);
		if(!$info_product)
		{
			redirect(base_url());
		}
		$this->data['info_product'] = $info_product;
		$info_catalog = $this->catalog_model->get_info($info_product->id_cat);
		$this->data['info_catalog'] = $info_catalog;
		//Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;

		$this->breadcrumbs->push('Trang chủ','/');
		if($info_catalog->parent_id!=0)
		{
			$info_parent_cat = $this->catalog_model->get_info($info_catalog->parent_id);
			if($info_parent_cat->parent_id!=0)
			{
				//Thuc pham chu nang
				$info_parent_cat1 = $this->catalog_model->get_info($info_parent_cat->parent_id);
				$this->breadcrumbs->push($info_parent_cat1->name,'index.php/'.$info_parent_cat1->slug.'-c'.$info_parent_cat1->id.'.html');
			}
			//Con thuc pham chuc nang
			$this->breadcrumbs->push($info_parent_cat->name, 'index.php/'.$info_parent_cat->slug.'-c'.$info_parent_cat->id.'.html');
		}
		//Danh muc hien tai.
		$this->breadcrumbs->push($info_catalog->name, 'index.php/'.$info_catalog->slug.'-c'.$info_catalog->id.'.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//Tag của sản phẩm
		$tag_product = $this->fetch_keyword($info_product->keyword);
		$this->data['tag_product'] = $tag_product;
		//Danh sách hình
		$image_list = json_decode($info_product->image_list);
		$this->data['image_list'] = $image_list;
		//Hiển thị view
		$this->data['temp'] = 'site/product/detail';
		$this->load->view('site/main',$this->data);
	}
	
	function fetch_keyword($info_product="")
	{
		$rs='';
		$keyword=array();
		$keyword = explode(',',$info_product);
		for($i=0;$i<count($keyword);$i++)
		{
		if(trim($keyword[$i])!="")
			$rs.='<a href="'.base_url().'index.php/product/search?keysearch='.$keyword[$i].'&search-product=0">'.$keyword[$i].'</a>';
		}
		
		return $rs;
	}
	
	function catalog_product($id_cat,$rowno = 0)
	{
		
		//Thông tin danh mục
		$id_cat = intval($this->uri->rsegment(3));
		//pre($id_cat);
		$info_catalog = $this->catalog_model->get_info($id_cat);
		if(!$info_catalog)
		{
			echo '<script>alert("Không có danh mục")</script>';
			redirect(base_url());
		}
	
		$this->data['info_catalog'] = $info_catalog;

		//Danh mục cùng cấp dưới banner
		$list_subcatalog = $this->catalog_model->get_subcategory($id_cat);
		$this->data['list_subcatalog'] = $list_subcatalog;
		
		$this->load->library("pagination");
		 // Tổng số sản phẩm.
		$config['base_url'] = base_url("index.php/".$info_catalog->slug.'-c'.$info_catalog->id.""); //Link hiển thị danh sách sản phẩm
		$config['per_page'] = 12;
		$config["uri_segment"] =2;
		$config['first_link'] = 'Trang đầu';
		$config['last_link'] = 'Trang cuối';
		$config['use_page_numbers'] = TRUE;
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
		
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}

		//Danh sách danh mục
		$parent_id = $info_catalog->parent_id;
		$input = array();
		$input['where']  = array('id' => $parent_id,'status'=>1);
		$catalog_list = $this->catalog_model->get_list($input);
		foreach($catalog_list as $rows)
		{
			//Danh muc con
			$input['where'] = array('parent_id'=>$rows->id,'status'=>1);
			$subs = $this->catalog_model->get_list($input);
			$rows->subs = $subs;
			foreach($rows->subs as $last_subs)
			{
				//Danh mục cấp 3
				$input['where'] = array('parent_id'=>$last_subs->id,'status'=>1);
				$content_sub = $this->catalog_model->get_list($input);
				$last_subs->subs = $content_sub;
			}
		}
		
		//Lấy danh sách sản phẩm theo danh mục
		$input = array();
		$input_catalog = array();
		$input_catalog['where'] = array('parent_id' => $id_cat,'status'=>1);
		$catalog_subs = $this->catalog_model->get_list($input_catalog);
		if(!empty($catalog_subs))
		{
			$catalog_sub_id = array();
			foreach($catalog_subs as $subs)
			{
				$catalog_sub_id[] = $subs->id;
			}
		
			//SP của menu cấp 2
			$input_sub = array();
			$input_sub = array('status'=>1);
			$total_rows = $this->product_model->count_get_list_product($input_sub,$catalog_sub_id);
			$config['total_rows'] = $total_rows;
			$list_product = $this->product_model->get_list_product($input_sub,$catalog_sub_id,$config['per_page'],$rowno);
		}
		else
		{
			//SP của menu cấp 3
			$input = array('id_cat'=> $id_cat,'status'=>1);
			$total_rows = $this->product_model->count_get_list_product($input,'');
			$config['total_rows'] = $total_rows;
			$list_product = $this->product_model->get_list_product($input,'',$config['per_page'],$rowno);
		}

		$this->pagination->initialize($config);
		
		$total = count($list_product);
		
		$this->data['total'] = $total;

		//Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;

		$this->breadcrumbs->push('Trang chủ','/');
		if($info_catalog->parent_id!=0)
		{
			$info_parent_cat = $this->catalog_model->get_info($info_catalog->parent_id);
			if($info_parent_cat->parent_id!=0)
			{
				//Thuc pham chu nang
				$info_parent_cat1 = $this->catalog_model->get_info($info_parent_cat->parent_id);
				$this->breadcrumbs->push($info_parent_cat1->name,'index.php/'.$info_parent_cat1->slug.'-c'.$info_parent_cat1->id.'.html');
			}
			//Con thuc pham chuc nang
			$this->breadcrumbs->push($info_parent_cat->name, 'index.php/'.$info_parent_cat->slug.'-c'.$info_parent_cat->id.'.html');
		}
		//Danh muc hien tai.
		$this->breadcrumbs->push($info_catalog->name, 'index.php/'.$info_catalog->slug.'-c'.$info_catalog->id.'.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//Danh sách sp
		$this->data['list_product'] = $list_product;
		//Danh mục con
		$this->data['catalog_subs'] = $catalog_subs;
		//Danh mục cha
		$this->data['catalog_list'] = $catalog_list;
		//pre($catalog_list);
		//Hiển thị view
		$this->data['temp'] = 'site/product/catalog_product';
		$this->load->view('site/main',$this->data);
	}
	function search($rowno = 0)
	{
		//trang thái mở khóa Status = 1
		$input_cat = array();
		$input_cat['where'] = array('parent_id'=>0,'status'=>1);

		//breadcrumbs
		$this->load->library('breadcrumbs');
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Kết quả tìm kiếm','index.php/tim-kiem');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//mãng danh id danh mục cấp 3
		$last_id_subs = array();
		//Danh sách danh mục cha
		$list_catalog = $this->catalog_model->get_list($input_cat);

		//Từ khóa nhập từ form tìm kiếm
		$key = "";
		if($this->input->get() != NULL )
		{
		  $key = $this->input->get('keysearch');
		  $this->session->set_userdata(array("keysearch"=>$key));
		}
		else
		{
		  if($this->session->userdata('keysearch') != NULL)
		  {
			$key = $this->session->userdata('keysearch');
		  }
		}
	
		
		$this->load->library("pagination");
		 // Tổng số sản phẩm.
		$config['base_url'] = base_url("index.php/tim-kiem"); //Link hiển thị danh sách sản phẩm
		$config['per_page'] = 10;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = 'Trang đầu';
		$config['last_link'] = 'Trang cuối';
		$config['next_link'] ="Trang kế tiếp";
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
		
		if($rowno != 0)
		{
		  $rowno = ($rowno-1) * $config['per_page'];
		}
		
		//phương thức khởi tạo cấu hình phân trang
		

		//Điều kiện tìm kiếm theo tên và từ khóa
		//Mã loại sản phẩm
		
		$id_cat = "";
		if($this->input->get() != NULL )
		{
		  $id_cat = $this->input->get('search-product');
		  $this->session->set_userdata(array("id_cat"=>$id_cat));
		}
		else
		{
		  if($this->session->userdata('id_cat') != NULL)
		  {
			$id_cat = $this->session->userdata('id_cat');
		  }
		}
		
		
		$input ='';
		$catalog = $this->catalog_model->get_info($id_cat);
		//Nếu có chọn loại sản phẩm
		if(!empty(($catalog)))
		{
			if($catalog->parent_id == 0)
			{
				$input_catalog = array();
				$input_catalog['where'] = array('parent_id' => $id_cat,'status'=>1);
				$catalog_subs = $this->catalog_model->get_list($input_catalog);
				if(!empty($catalog_subs))
				{
					$input = $key;
					$catalog_sub_id = array();
					//Danh mục cấp 2
					foreach($catalog_subs as $subs)
					{
						$input_cat = array();
						$input_cat['where'] = array('parent_id'=>$subs->id,'status'=>1);
						//Danh mục cấp 3
						$last_catalog = $this->catalog_model->get_list($input_cat);
						foreach($last_catalog as $last_subs)
						{
							//Mãng id danh mục con
							$last_id_subs[]= $last_subs->id;
						}
					}
					$total_rows = $this->product_model->count_result($key,$last_id_subs);
					$config['total_rows'] = $total_rows;
					$this->db->where_in('id_cat',$last_id_subs);
					$list_product = $this->product_model->select_like($input,$last_id_subs,$config['per_page'],$rowno);
					foreach($list_product as $row)
					{
						$cat_name = $row->id_cat;
						$row->cat_name = convert($cat_name,'catalog_model','','name',false);
					}
				}
				else
				{
					$list_product = '';
					$total_rows = 0;
				}
			}
		}
		else
		{
			//Loại là tất cả
			$total_rows = $this->product_model->count_result($key);
			$config['total_rows'] = $total_rows;
			$input = $key;
			$list_product = $this->product_model->select_like($input,'',$config['per_page'],$rowno);
			foreach($list_product as $row)
			{
				$cat_name = $row->id_cat;
				$row->cat_name = convert($cat_name,'catalog_model','','name',false);
			}
		}
		$this->pagination->initialize($config);
		//Đếm số lượng sản phẩm
		$total = $total_rows;
		

		//Hiển thị $list_product ra view
		$this->data['list_product'] = $list_product;
		$this->data['list_catalog'] = $list_catalog;
		$this->data['key'] = $key;
		$this->data['id_cat'] = $id_cat;
		$this->data['total'] = $total;
		
		//Hiển thị ra view
		$this->data['temp'] = 'site/product/search';
		$this->load->view('site/main',$this->data);
	}
	function get_autocomplete()
	{
		$key = $this->input->get('term');
		$input = array();
		$input['like'] = array('name',$key);
		$input['limit'] = array(5,0);
		$product_list = $this->product_model->get_list($input);
		//Xử lý auto complete
		$result = array();
		foreach($product_list as $row)
		{
			$item = array();
			$item['id'] = $row->id;
			$item['label'] = $row->name;
			$item['value'] = $row->name;
			$result[] = $item;
		}
		die(json_encode($result));
	}
	
	//SẢN PHẨM BÁN CHẠY VÀ SẢN PHẨM MỚI
	function type_product($type='',$rowno =0)
	{
		$type = $this->uri->rsegment(3);
		//Breadcrumbs
		$this->load->library('breadcrumbs');
		$this->breadcrumbs->push('Trang chủ','/');

		$list_product = array();
		if($type == 'tp1')
		{
			$input_hot_pro = array();
			$input_hot_pro['where'] = array('quantity >'=> 0,'bought >'=> 3,'status'=>1);
			$input_hot_pro['order'] = array('bought','DESC');
			$total_hot_pro = $this->product_model->get_total($input_hot_pro);
			
			$this->load->library("pagination");
			$config['base_url'] = base_url("index.php/san-pham-ban-chay"); //Link hiển thị danh sách sản phẩm
			$config['total_rows'] = $total_hot_pro; // Tổng số sản phẩm.
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
			$config['per_page'] = 12;
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
			$this->db->limit($config['per_page'],$rowno);

			$list_product = $this->product_model->get_list($input_hot_pro);
			$this->breadcrumbs->push('Sản phẩm bán chạy', 'index.php/san-pham-ban-chay.html');
			$breadcrumbs = $this->breadcrumbs->show();
		}
		if($type == 'tp2')
		{
			$input_new_pro = array();
			$input_new_pro['where'] = array('quantity >'=> 0,'status'=>1);
			$input_new_pro['order'] = array('id','DESC');
			$total_new_pro = $this->product_model->get_total($input_new_pro);
			
			$this->load->library("pagination");
			$config['base_url'] = base_url("index.php/san-pham-moi"); //Link hiển thị danh sách sản phẩm
			$config['total_rows'] = $total_new_pro; // Tổng số sản phẩm.
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
			$config['per_page'] = 12;
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
			$this->db->limit($config['per_page'],$rowno);
			$list_product = $this->product_model->get_list($input_new_pro);
			$this->breadcrumbs->push('Sản phẩm mới', 'index.php/san-pham-moi.html');
			$breadcrumbs = $this->breadcrumbs->show();
		}
		
		$input_cat = array();
		$input_cat['where'] = array('status'=>1,'parent_id'=>0);
		$list_catalog = $this->catalog_model->get_list($input_cat);
		foreach($list_catalog as $cat)
		{
			$input_sub_cat = array();
			$input_sub_cat['where'] = array('status'=>1,'parent_id'=>$cat->id);
			$sub_cat = $this->catalog_model->get_list($input_sub_cat);
			$cat->subs = $sub_cat;
			foreach($cat->subs as $last_cat)
			{
				$input_last_cat = array();
				$input_last_cat['where'] = array('status'=>1,'parent_id'=>$last_cat->id);
				$list_last_cat = $this->catalog_model->get_list($input_last_cat);
				$last_cat->subs = $list_last_cat;
			}
		}
		
		$this->data['list_catalog'] = $list_catalog;
		$this->data['breadcrumbs'] = $breadcrumbs;
		$this->data['list_product'] = $list_product;
		$this->data['type'] = $type;
		//Hiển thị ra view
		$this->data['temp'] = 'site/product/type_product';
		$this->load->view('site/main',$this->data);
	}
	
}
?>
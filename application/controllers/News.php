<?
class News extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}
	
	function index($rowno = 0)
	{
		$input = array();
		$input['where'] = array('status' => 1);
		$total_rows = $this->news_model->get_total($input);
		$this->load->library("pagination");
		$config['base_url'] = base_url("index.php/bai-viet"); //Link hiển thị danh sách sản phẩm
		$config['total_rows'] = $total_rows; // Tổng số sản phẩm.
		$config['use_page_numbers'] = TRUE; //Hiển thị số trang trên url 1 2 3 4
		$config['per_page'] = 1;
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

		//Bài viết được hiển thị
		
		$input['where'] = array('status' => 1);
		$list_news = $this->news_model->get_list($input);
		$this->data['list_news'] = $list_news;
		//Bài viết nổi bật
		$input_hot = array();
		$input_hot['where'] = array('hot' => 1,'status' => 1);
		$input_hot['limit'] = array(2,0);
		$list_hot_news = $this->news_model->get_list($input_hot);
		$this->data['list_hot_news'] = $list_hot_news;
		
		//Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;

		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Bài viết','index.php/bai-viet.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//Hiển thị view
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'site/news/index';
		$this->load->view('site/main',$this->data);
	}
	
	function detail()
	{
		$id = intval($this->uri->rsegment(3));
		$info_news = $this->news_model->get_info($id);
		if(!$info_news)
		{
			redirect(base_url());
		}
		//Thông tin chi tiết
		$this->data['info_news'] = $info_news;
		
		//Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;

		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Bài viết','index.php/bai-viet.html');
		$this->breadcrumbs->push($info_news->name,'index.php/bai-viet/'.$info_news->slug.'-n'.$id.'.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		//Tin tức liên quan.
		$input = array();
		$input['where'] = array('status' => 1);
		$input['limit'] = array(3,0);
		$list_related_news = $this->news_model->get_list($input);
		$this->data['list_related_news'] = $list_related_news;
		
		//Tag từ khóa
		$tag_keyword = $this->fetch_keyword($info_news->keyword);
		$this->data['tag_keyword'] = $tag_keyword;
		
		//Tin tức nổi bật
		$input_hot = array();
		$input_hot['where'] = array('hot' => 1,'status' => 1);
		$input_hot['limit'] = array(5,0);
		$list_hot_news = $this->news_model->get_list($input_hot);
		$this->data['list_hot_news'] = $list_hot_news;
		//Thông báo và hiển thị view
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'site/news/detail';
		$this->load->view('site/main',$this->data);
	}
	
	function fetch_keyword($info_news)
	{
		$rs='';
		$keyword=array();
		$keyword = explode(',',$info_news);
		for($i=0;$i<count($keyword);$i++)
		{
		if(trim($keyword[$i])!="")
			$rs.='<li><a href="'.base_url().'index.php/news/search?keysearch='.$keyword[$i].'&search-product=0">'.$keyword[$i].'</a></li>';
		}
		
		return $rs;
	}

	//Tìm kiếm dựa vào tag
	function search()
	{
		//Từ khóa tìm kiếm
		$key = $this->input->get('keysearch');
		//Danh sách tin tức
		$list_news = $this->news_model->select_like($key);

		//tổng số lượng tin tức
		$total = count($list_news);

		//Trả biến ra view
		$this->data['list_news'] = $list_news;
		$this->data['total'] = $total;
		$this->data['key'] = $key;
		//Hiển thị view
		$this->data['temp'] = 'site/news/search';
		$this->load->view('site/main',$this->data);
	}
}
?>
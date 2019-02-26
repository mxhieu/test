<?
class Info extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('info_model');
	}

	function index()
	{
		if($this->uri->segment(2) == 'info')
		{
			$info_web = $this->info_model->get_info(1);
				
		}
		//pre($info_web);
		$this->data['info_web'] = $info_web;
		$this->load->library('upload_library');
		if($this->input->post())
		{
			$this->form_validation->set_rules('title', 'Tiêu đề', 'required|min_length[5]|max_length[80]');
			$this->form_validation->set_rules('domain', 'Tên miền', 'required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('keyword', 'Từ khóa', 'required|min_length[5]|max_length[200]');
			$this->form_validation->set_rules('description', 'Mô tả', 'required|min_length[5]|max_length[200]');
			$this->form_validation->set_rules('domain', 'Tên miền', 'required|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'required|min_length[5]|max_length[200]');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
			$this->form_validation->set_rules('fanpage', 'fanpage', 'required|max_length[200]');
			$this->form_validation->set_rules('phone', 'Điện thoại', 'required|numeric|min_length[9]|max_length[12]');
			$this->form_validation->set_rules('account_email', 'Tài khoản email', 'required|valid_email');
			$this->form_validation->set_rules('pass_email', 'Mật khẩu email', 'required');
			if($this->form_validation->run()) 
			{
				$title = $this->input->post('title');
				$domain = $this->input->post('domain');
				$slogan = $this->input->post('slogan');
				$keyword = $this->input->post('keyword');
				$description = $this->input->post('description');
				$address = $this->input->post('address');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$fanpage = $this->input->post('fanpage');
				$hotline = $this->input->post('hotline');
				$fax = $this->input->post('fax');
				$account_email = $this->input->post('account_email');
				$pass_email = $this->input->post('pass_email');
				$logo_upload = $this->upload_library->upload('./upload/info','logo');
				if(isset($logo_upload))
				{
					$logo = $logo_upload;
				}
				if($logo_upload =='')
					$logo = "no_img.jpg";
				$data = array();
				$data = array('title' => $title,
							  'domain' => $domain,
							  'slogan' =>$slogan,
							  'keyword'=> $keyword,
							  'description' =>$description,
							  'address' => $address,
							  'email' => $email,
							  'fanpage' => $fanpage,
							  'phone' => $phone,
							  'hotline' => $hotline,
							  'fax' => $fax,
							  'emailuser' => $account_email,
							  'emailpwd' =>$pass_email,
							  'created' =>time(),
				);
				if($logo!='')
				{
					$data['logo'] = $logo;
				}
				if($this->info_model->update(1,$data))
				{
					$this->session->set_flashdata('message','<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thành công!</strong> Bạn đã cập nhật thành công thông tin website.
															  </div>');
				}
				else
				{
					$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade in">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Thất bại!</strong> cập nhật thông tin website thất bại.
															  </div>');
				}
			} 
			redirect(admin_url());
		}

		$this->data['temp'] = 'admin/info/index';
		$this->load->view('admin/main',$this->data);
	}
}
?>
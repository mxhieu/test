<?
class Contact extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
	}
	function add_contact()
	{
		$input = array();
		$input['where'] = array('status'=>1);
		$list_contact = $this->contact_model->get_list($input);
		
		//Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;

		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Liên hệ','index.php/lien-he.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;

		$this->load->library('form_validation');
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Họ tên','required|max_length[40]');
			$this->form_validation->set_rules('phone','sđt','required|numeric|min_length[9]|max_length[12]');
			$this->form_validation->set_rules('address','Địa chỉ','required|max_length[100]');
			$this->form_validation->set_rules('email','email','required|valid_email');
			$this->form_validation->set_rules('content','Nội dung','required|max_length[200]');
			if($this->form_validation->run())
			{
				$name = $this->input->post('name');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$address = $this->input->post('address');
				$content = $this->input->post('content');
				$data = array('name' =>$name,
							  'phone' =>$phone,
							  'email' => $email,
							  'address' => $address,
							  'content' => $content,
							  'created' => time(),
				);
				if($this->contact_model->create($data))
				{
					echo "<script>alert('Cảm ơn những ý kiến đóng góp của bạn.')</script>";
				}
				else
				{
					echo "<script>alert('Thất bại.')</script>";
				}
			}
		}
		
		//Hiển thị view
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'site/contact/add_contact';
		$this->load->view('site/main',$this->data);
	}
}
?>
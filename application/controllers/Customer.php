<?
class Customer extends MY_Controller
{
function index(){
		if($this->input->post())
		{
			$this->form_validation->set_rules("login","login","callback_check_login");
			if($this->form_validation->run())
			{
				//Đánh dấu user đã đăng nhập
				$this->session->set_userdata("login",true);
				redirect(base_url());
			}
		}
		$this->load->view("site/home/index");
	}

	//kiểm tra đăng nhập
	function check_login(){
		$this->load->model('customer_model');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$password = md5($password);
		$where = array('username' => $username, 'password' => $password);
		$customer = $this->customer_model->get_info_rule($where);
		if($customer)
		{
			$info_member = array('cus_id'=> $customer->id,
								 'cus_name'    => $customer->name,
								 'cus_username'=> $customer->username,
								 'cus_id_provices' => $customer->id_provices,
								 'cus_id_wards' => $customer->id_wards,
								 'cus_phone' => $customer->phone,
								 'cus_address' => $customer->address,
								 'cus_email' => $customer->email,
								 
								 
			);
			$this->session->set_userdata($info_member);
			return true;
		}
		$this->form_validation->set_message("check_login","đăng nhập thất bai, thử lại");
		return false;
	}
	
	function info_cus()
	{
		$this->load->model('customer_model');
		if(isset($_SESSION['cus_id']))
		{
			$id = $_SESSION['cus_id'];
			$info_cus = $this->customer_model->get_info($id);
			if(!$info_cus)
			{
				echo "<script>alert('không có tài khoản')</script>";
			}
			$query = $this->db->get_where('wards', array('id' => $_SESSION['cus_id_wards']));
			$info_wards = $query->row();
			$this->data['info_cus'] = $info_cus;
			$this->data['info_wards'] = $info_wards;
			if($this->input->post())
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('name','Tên','required|min_length[8]');
				$this->form_validation->set_rules('email','email','required|min_length[8]|max_length[200]|valid_email');
				$this->form_validation->set_rules('address','Địa chỉ','required|min_length[20]|max_length[200]');
				$this->form_validation->set_rules('phone','Số điện thoại','required|min_length[9]|max_length[12]');
				$this->form_validation->set_rules('username','Tài khoản','required|min_length[6]');

					$this->form_validation->set_rules("password","Mật khẩu","min_length[6]");
					$this->form_validation->set_rules("repassword","Nhập lại mật khẩu","matches[password]");
				
				$this->form_validation->set_rules('city','Tỉnh thành','required|callback_check_default');
				$this->form_validation->set_rules('district','Quận / huyện','required|callback_check_default');
				$this->form_validation->set_message('check_default', 'Vui lòng chọn');
				if($this->form_validation->run())
				{
					$name = $this->input->post("name");
					$address = $this->input->post("address");
					$username = $this->input->post("username");
					$phone = $this->input->post("phone");
					
					$email = $this->input->post("email");
					$id_provices = $this->input->post("city");
					$id_wards = $this->input->post("district");
					$data = array(
						'name' => $name,
						'address' => $address,
						'username' => $username,
						'phone' => $phone,
						'email' => $email,
						'id_provices' => $id_provices,
						'id_wards' => $id_wards,
						'created' => time(),
					);
					if($password)
					{
						$data['password'] = md5($password);
					}
					if($this->customer_model->update($id,$data))
					{
						$this->session->set_flashdata('message','<script>alertify.alert("thông báo","Bạn đã cập nhật thành công tài khoản");</script>');
					}
					else
					{
						$this->session->set_flashdata('message','<script>alertify.alert("thông báo","Bạn đã cập nhật thất bại tài khoản");</script>');
					}
					redirect(base_url());
				}
				
			}
			
		}
		
		//breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Thông tin khách hàng', '/index.php/thanh-toan.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		$this->data['temp'] = 'site/customer/info_cus';
		$this->load->view('site/main',$this->data);
		
		
		
	}
	
	function login()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules("login","login","callback_check_login");
			if($this->form_validation->run())
			{
				//Đánh dấu user đã đăng nhập
				$this->session->set_userdata("cus_login",true);
				redirect(base_url());
			}
		}

		//breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Đăng nhập', '/index.php/thanh-toan.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		$this->data['temp'] = 'site/customer/login';
		$this->load->view('site/main',$this->data);
		
	}

	function check_username()
	{
		$username = $this->input->post("username");
		$where = array("username" => $username);
		if($this->customer_model->check_exists($where))
		{
			//trả về thông báo lỗi
			$this->form_validation->set_message("check_username","tài khoản đã tồn tại");
			return false;	
		}
		return true;
	}
	

	
	function check_default($post_string)
	{
		return $post_string == '0' ? FALSE : TRUE;
	}
	
	function register()
	{
		$this->load->model('customer_model');
		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name','Tên','required|min_length[8]');
			$this->form_validation->set_rules('email','email','required|min_length[8]|max_length[200]|valid_email|callback_check_email');
			$this->form_validation->set_rules('address','Địa chỉ','required|min_length[20]|max_length[200]');
			$this->form_validation->set_rules('phone','Số điện thoại','required|min_length[9]|max_length[12]');
			$this->form_validation->set_rules('username','Tài khoản','required|min_length[6]|callback_check_username|alpha_dash');
			$this->form_validation->set_rules('password','Mật khẩu','required');
			$this->form_validation->set_rules('repassword',' Nhập lại mật khẩu','required|matches[password]');
			$this->form_validation->set_rules('city','Tỉnh thành','required|callback_check_default');
			$this->form_validation->set_rules('district','Quận / huyện','required|callback_check_default');
			$this->form_validation->set_message('check_default', 'Vui lòng chọn');
			if($this->form_validation->run())
			{
				$name = $this->input->post("name");
				$address = $this->input->post("address");
				$username = $this->input->post("username");
				$phone = $this->input->post("phone");
				$password = $this->input->post("password");
				$email = $this->input->post("email");
				$id_provices = $this->input->post("city");
				$id_wards = $this->input->post("district");
				$data = array(
					'name' => $name,
					'address' => $address,
					'username' => $username,
					'phone' => $phone,
					'email' => $email,
					'password' => md5($password),
					'id_provices' => $id_provices,
					'id_wards' => $id_wards,
					'created' => time(),
				);
				if($this->customer_model->create($data))
				{
					$this->session->set_flashdata('message','<script>alertify.alert("Bạn đã trở thành thành viên của cửa hàng H&T");</script>');
				}
				else
				{
					$this->session->set_flashdata('message','<script>alertify.alert("Thất bại");</script>');
					
				}
				redirect(base_url());
			}
			
		}
		//breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs;
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Đăng kí', '/index.php/thanh-toan.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		$this->data['temp'] = 'site/customer/register';
		$this->load->view('site/main',$this->data);
	}
	
		
	function logout()
	{
		$this->session->unset_userdata('cus_id');
		$this->session->unset_userdata('cus_name');
		$this->session->unset_userdata('cus_username');
		$this->session->unset_userdata('cus_id_provices');
		$this->session->unset_userdata('cus_id_wards');
		$this->session->unset_userdata('cus_phone');
		$this->session->unset_userdata('cus_address');
		$this->session->unset_userdata('cus_email');
		$this->session->unset_userdata('cus_login');
		redirect(base_url());
	}
	
	function forget_password()
	{
		$this->load->model('customer_model');
		if($this->input->post())
		{
			$this->form_validation->set_rules("check_email_not_exists","Email","callback_check_email_not_exists");
			if($this->form_validation->run())
			{
				$email = $this->input->post('email');    
				$input = array();
				$input['where'] = array('email' => $email);
				$query = $this->db->get_where('customer',array('email'=>$email));
				$findemail = $query->row();  
				if(count($findemail) > 0)
				{
					$this->customer_model->sendpassword($findemail);        
				}
			}
		}
			
		
		$this->load->library('breadcrumbs');
		// add breadcrumbs;
		$this->breadcrumbs->push('Trang chủ','/');
		$this->breadcrumbs->push('Quên mật khẩu', '/index.php/thanh-toan.html');
		// output
		$breadcrumbs = $this->breadcrumbs->show();
		$this->data['breadcrumbs'] = $breadcrumbs;
		
		$this->data['temp'] = 'site/customer/forget_password';
		$this->load->view('site/main',$this->data);
	}
	
	function check_email()
	{
		$email = $this->input->post("email");
		$where = array("email" => $email);
		if($this->customer_model->check_exists($where))
		{
			//trả về thông báo lỗi
			$this->form_validation->set_message("check_username","Email đã tồn tại");
			return false;	
		}
		return true;
	}
	
	function check_email_not_exists()
	{
		$email = $this->input->post("email");
		$where = array("email" => $email);
		if($this->customer_model->check_exists($where))
		{
			return true;	
		}
		$this->form_validation->set_message("check_email_not_exists","Email không tồn tại");
		return false;
	}
	
	function cus_order()
	{
		$this->load->model('orders_model');
		$this->load->model('order_detail_model');
		if(isset($_SESSION['cus_login']))
		{
			$cus_id = $_SESSION['cus_id'];
			$input = array();
			$input['where'] = array('id_customer'=>$cus_id);
			$input['order'] = array('id','desc');
			$list_order = $this->orders_model->get_list($input);
			$this->data['list_order'] = $list_order;
			$this->load->library('breadcrumbs');
			// add breadcrumbs;
			$this->breadcrumbs->push('Trang chủ','/');
			$this->breadcrumbs->push('Đơn hàng đã đặt', '/index.php/thanh-toan.html');
			//output
			$breadcrumbs = $this->breadcrumbs->show();
			$this->data['breadcrumbs'] = $breadcrumbs;
			
			$this->data['temp'] = 'site/customer/cus_order';
			$this->load->view('site/main',$this->data);
		}
		else
			redirect(base_url());
	}
	function cus_order_detail()
	{
		$this->load->model('order_detail_model');
		if(isset($_SESSION['cus_login']))
		{
			$this->load->model('orders_model');
			$id_order = $this->uri->rsegment(3);
			$info_order = $this->orders_model->get_info($id_order);
			$input = array();
			$input['where'] = array('id_order'=>$id_order);
			$list_order_detail = $this->order_detail_model->get_list($input);
			$total_order = $this->order_detail_model->total_pay_order($id_order);
			
			$this->data['info_order'] = $info_order;
			$this->data['total_order'] = $total_order;
			$this->data['list_order_detail'] = $list_order_detail;
			$this->load->library('breadcrumbs');
			$this->load->library('breadcrumbs');
			// add breadcrumbs;
			$this->breadcrumbs->push('Trang chủ','/');
			$this->breadcrumbs->push('Chi tiết đơn hàng', '/index.php/thanh-toan.html');
			//output
			$breadcrumbs = $this->breadcrumbs->show();
			$this->data['breadcrumbs'] = $breadcrumbs;
			
			$this->data['temp'] = 'site/customer/cus_order_detail';
			$this->load->view('site/main',$this->data);
		}
		else
			redirect(base_url());
		
	}
}
?>
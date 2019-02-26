<?
class Login extends MY_Controller{
	function index(){
		if($this->input->post())
		{
			$this->form_validation->set_rules("login","login","callback_check_login");
			if($this->form_validation->run())
			{
				//Đánh dấu user đã đăng nhập
				$this->session->set_userdata("login",true);
				redirect(admin_url());
			}
		}
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->load->view("admin/login/index",$this->data);
	}

	//kiểm tra đăng nhập
	function check_login(){
		$this->load->model('members_model');
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$password = ($password);
		$where = array('username' => $username, 'password' => $password);
		$member = $this->members_model->get_info_rule($where);
		if($member)
		{
			$this->session->set_userdata("permissions",json_decode($member->permissions));
			$info_member = array('admin_id'=> $member->id,
								 'name'    => $member->name,
								 'username'=> $member->username,
								 'image'   => $member->image,
			);
			$this->session->set_userdata($info_member);
			return true;
		}
		$this->form_validation->set_message("check_login","đăng nhập thất bai, thử lại");
		return false;
	}
}
?>
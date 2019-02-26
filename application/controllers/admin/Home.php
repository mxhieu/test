<?
class Home extends MY_controller{
	function index(){
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = "admin/home/index";
		$this->load->view("admin/main",$this->data);
	}
	
	function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('image');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('permissions');
		redirect(admin_url("login"));
	}
}
?>
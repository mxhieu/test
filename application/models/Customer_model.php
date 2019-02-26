<?
class Customer_model extends MY_Model{

	var $table = "customer";
	
	function get_like($status,$search_text, $per_page, $rowno = 0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $search_text)
				->or_like('id', $search_text)
			->group_end()
			->where('status', $status)
			->order_by('id','desc')
			->limit($per_page, $rowno)
		->get();
		return $query->result();
	}
	
	function get_total_row($status,$input)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $input)
				->or_like('id', $input)
			->group_end()
			->where('status', $status)
		->get();
		return $query->num_rows();
	}
	
	public function sendpassword($data)
	{
		$email = $data->email;
		$query1=$this->db->get_where('customer',array('email'=>$email));
		$row=$query1->row();
		if ($query1->num_rows()>0)
		{
		$passwordplain = "";
		$passwordplain  = rand(999999999,9999999999);
		$newpass = md5($passwordplain);
		$this->db->set('password', $newpass);
		$this->db->where('id', $data->id);
		$this->db->update('customer');
		$mail_message='Xin chào '.$row->name.','. "\r\n";
		$mail_message.='Cảm ơn bạn đã liên hệ về việc quên mật khẩu tại nhà thuốc H&T,<br> mật khẩu mới <b>Password</b> là <b>'.$passwordplain.'</b>'."\r\n";
		$mail_message.='<br>vui lòng thay đổi lại mật khẩu trong lần đăng nhập tiếp theo.';
		$mail_message.='<br>Nhà thuốc H&T, Trân thành cảm ơn';

		$config = array("protocol"=>"smtp",
						"smtp_host"=>"ssl://smtp.googlemail.com",
						"smtp_port"=>465,
						"smtp_user"=>'mxhieu8319972@gmail.com',
						"smtp_pass"=>'gacon66529372'
		);
		$this->load->library("email",$config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->from("mxhieu8319972@gmail.com", "Mai Xuân Hiếu"); // thiết lập địa chỉ email và tên người gửi
		$this->email->to($data->email,$data->name); // thiết lập địa chỉ email và tên người nhận email.
		$this->email->subject("Thư từ nhà thuốc H&T"); // thiết lập tiêu đề gửi email
		$this->email->message($mail_message); // thiết lập nội dung gửi mail
		if(!$this->email->send())
		{
			 $this->session->set_flashdata('message','<script>alert("Lây lại tài khoản thất bại!")</script>');
		}
		else 
		{
		   $this->session->set_flashdata('message','<script>alert("Mật khẩu đã được đến email của bạn!")</script>');
		}
		  redirect(base_url());        
		}
		else
		{  
		 $this->session->set_flashdata('message','<script>alert("Lây lại tài khoản thất bại!")/script>');
		 redirect(base_url());
		}
	}
}
?>
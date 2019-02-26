<?
class Contact_model extends MY_Model{
	var $table = "contact";

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
	
	function reply_message($mail_title,$mail_message,$to_mail)
	{
		$config = array("protocol"=>"smtp",
						"smtp_host"=>"ssl://smtp.googlemail.com",
						"smtp_port"=>465,
						"smtp_user"=>"mxhieu8319972@gmail.com",
						"smtp_pass"=>"gacon66529372"
		);
		$this->load->library("email",$config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->from("mxhieu8319972@gmail.com", "Mai Xuân Hiếu"); // thiết lập địa chỉ email và tên người gửi
		$this->email->to($to_mail," Khách hàng "); // thiết lập địa chỉ email và tên người nhận email.
		$this->email->subject("Thư từ nhà thuốc H&T,".$mail_title.""); // thiết lập tiêu đề gửi email
		$this->email->message($mail_message); // thiết lập nội dung gửi mail
		if(!$this->email->send())
		{
			 return false;
		} 
		else 
		{
		   return true;
		}     
	}
}
?>
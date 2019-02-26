<?
class Members_model extends MY_Model{

	var $table = "members";
	
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

}
?>
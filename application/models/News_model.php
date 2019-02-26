<?
class News_model extends MY_Model{
	var $table = "news";

	function select_like($input)
	{
		$this->db->where('status',1);
		$this->db->like('name',$input);
		$this->db->or_like('keyword',$input);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	
	function get_like($status,$input,$per_page,$rowno=0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $input)
				->or_like('id', $input)
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
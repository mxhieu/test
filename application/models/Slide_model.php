<?
class Slide_model extends MY_Model
{
	var $table='slide';
	
	function get_like($status,$input,$per_page,$rowno=0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $input)
				->or_like('id', $input)
			->group_end()
			->where('status', $status)
			->limit($per_page, $rowno)
			->order_by('position', 'desc')
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
<?
class Provider_model extends MY_Model
{
	var $table = "provider";
	
	function get_like($status,$input,$per_page,$rowno=0)
	{
		$this->db->where('status',$status );
		$this->db->where("(name LIKE '%".$input."%' OR id LIKE '%".$input."%')", NULL, FALSE);
		$this->db->limit($per_page, $rowno);
		$query = $this->db->get($this->table);
		return $query->result();
	}
    function get_total_row($status,$input)
	{
		$this->db->where('status',$status );
		$this->db->where("(name LIKE '%".$input."%' OR id LIKE '%".$input."%')", NULL, FALSE);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
}
?>
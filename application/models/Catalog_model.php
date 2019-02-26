<?
class Catalog_model extends MY_Model{
	var $table = "catalog";

	/**
	 * Lấy danh sách không có order by
	 */
	function get_item()
	{
		$query = $this->db->query('select * from catalog');
		return $query->result();	
	}
	function get_category()
    {
        $this->db->where('parent_id',0);
		$this->db->where('status',1);
		$this->db->order_by('position','desc');
		$this->db->limit(2,0);
        $query = $this->db->get('catalog');
        if($query->result())
        {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    function get_subcategory($id)
    {
        $this->db->where('parent_id',$id);
		$this->db->where('status',1);
		$this->db->order_by('position','desc');
        $query = $this->db->get('catalog');
        if($query->result())
        {
            return $query->result();
        }
        else{
            return FALSE;
        }
    }

    function get_like($status,$search_text, $per_page, $rowno = 0)
	{
		$query = $this->db->select('*')->from($this->table)
			->group_start()
				->like('name', $search_text)
				->or_like('id', $search_text)
			->group_end()
			->where('status', $status)
			->order_by('position','desc')
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
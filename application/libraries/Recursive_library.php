<?
/**
 * Đệ quy
 */
class Recursive_library{
	var $recursive =array();
	function __construct()
	{
		$this->CI = & get_instance();
	}
	function recursive($data,$id1=0,$step='',$temp='')
	{
		if(isset($data) && is_array($data))
		{
			foreach($data as $key => $val)
			{
				if($temp=='')
				{
					if($val->parent_id == $id1)
					{
						$this->recursive[$val->id] = $step.$val->name;
						$this->recursive($data,$val->id,$step.'----','');
						//pre($a);
					}
				}
				if($temp=='view')
				{
					if($val->parent_id == $id1)
					{
						$this->recursive[$val->id] = $val;
						$this->recursive($data,$val->id,$step.'----','view');

					}
				}
			}
		}
		return $this->recursive;	
	}
	

	
}
?>
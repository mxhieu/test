<?
function admin_url($url = ''){
	return base_url('index.php/admin/'.$url);
}
function check_status($table,$id,$status)
{
$verify="";
if($status==1)
$verify="<td class='text-primary'>
	<a href='".admin_url($table.'/lock/').$id."'>
	<i class='fas fa-eye'></i>
	</a>
	</td>";
else
$verify="<td class='text-primary'>
	<a href='".admin_url($table.'/unlock/').$id."'>
	<i class='fas fa-eye-slash'></i>
	</a>
	</td>";
return $verify;
}

function check_show_index($table,$id,$show_index)
{
$verify="";
if($show_index==1)
$verify="<td class='text-primary'>
	<a href='".admin_url($table.'/disappearance/').$id."'>
	<i class='fas fa-star'></i>
	</a>
	</td>";
else
$verify="<td class='text-primary'>
	<a href='".admin_url($table.'/appearance/').$id."'>
	<i class='far fa-star'></i>
	</a>
	</td>";
return $verify;
}

function cancel_product($table,$id_order,$id_product,$status)
{
$verify="";
if($status==1)
$verify="<td class='text-primary'>
	<a href='".admin_url($table."/cancel_product/").$id_product."/".$id_order."'>
	<i style='color:red' class='fas fa-times'></i>
	</a>
	</td>";
else
$verify="<td class='text-primary'>
	<a href='".admin_url($table."/return_product/").$id_product."/".$id_order."'>
	
	<i class='fas fa-reply'></i>
	</a>
	</td>";
return $verify;
}
/**
 * Hàm chuyển đổi id thành các thông tin khác
 * $message lời thông báo nếu id != 0
 * $info thông tin cần lấy
 */
function convert($parent_id=0,$name_model='',$message='',$info='',$catalog = false)
{
	$CI = & get_instance();
	$CI->load->model($name_model);
	if($catalog == true)
	{
		if($parent_id!=0)
		{
			$list_c = $CI->$name_model->get_info($parent_id);
			$value = $list_c->$info;
		}
		else
			$value=$message;
	}
	if($catalog == false)
	{
		$list_c = $CI->$name_model->get_info($parent_id);
		$value = $list_c->$info;
	}
	return $value;
}
//Lọc dữ liệu
function filter($data)
{
	$data=htmlentities($data, ENT_QUOTES, "UTF-8"); //sẽ chuyển các kí tự thích hợp thành các kí tự HTML entiies
	$data=htmlspecialchars($data, ENT_QUOTES); // Chuyển mấy dấu < > thì kí tự trong html	
	$data=strip_tags($data); //loại bỏ các thẻ HTML và PHP ra khỏi chuỗi
	$data=stripcslashes($data); // loại bỏ các dấu backslashes ( \ ) có trong chuỗi
	return $data;
}

//Bỏ mã hóa (thuốc giải)
function safe_display($data)
{
	$data=html_entity_decode($data);
	return $data;
}
?>
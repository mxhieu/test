function validate()
{
	alertify.success("Thêm hàng thành công");
	return false;
}


function buy_success()
{
	alertify.success("Thêm thành công sản phẩm");
	return false;
}


//Bắt buộc nhập từ khóa tìm kiếm
function search_empty()
{
	var search = document.forms['search_product'].keysearch.value;
	if(search=='')
	{
		alertify.error("Vui lòng nhập từ khóa");
		return false;
	}
}
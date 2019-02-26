
<div class="graphs">
<h3 class="blank1">Thêm số lượng thuốc</h3>
<p>
	<a style="margin:5px 0px" href="<?echo admin_url("product/out_of_product")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="quantity">Số lượng:</label>
		<input type="text" name="quantity" class="form-control" id="quantity">
		<div style="color:red ; font-size:10px"><?echo form_error('quantity')?></div>
	</div>
	<input type="submit" name="submit" value="Thêm số lương" class="btn-success btn">
</form>
</div>
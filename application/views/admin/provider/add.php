<div class="graphs">
<h3 class="blank1">Thêm nhà cung cấp</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("provider/add")?>" class="btn btn-success">Thêm nhà cung cấp</a>
	<a style="margin:5px 0px" href="<?echo admin_url("provider")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên nhà cung cấp:</label>
		<input type="text" value="<?echo set_value('name')?>" name="name" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="phone">Điện thoại:</label>
		<input type="text" name="phone" value="<?echo set_value('phone')?>" class="form-control" id="phone">
		<div style="color:red ; font-size:10px"><?echo form_error('phone')?></div>
	</div>
	<div class="form-group">
		<label for="address">Địa chỉ:</label>
		<input type="text" name="address" class="form-control" value="<?echo set_value('address')?>" id="poaddresssition">
		<div style="color:red ; font-size:10px"><?echo form_error('address')?></div>
	</div>
	<div class="form-group">
	  <label for="keyword">Từ khóa (seo):</label>
	  <textarea class="form-control" name="keyword" rows="5" id="keyword"><?echo set_value('keyword')?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Mô tả (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"><?echo set_value('description')?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>

	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>
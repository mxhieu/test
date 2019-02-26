<div class="graphs">
<h3 class="blank1">Thêm slide</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("slide/add")?>" class="btn btn-success">Thêm slide</a>
	<a style="margin:5px 0px" href="<?echo admin_url("slide/load_slide")?>" class="btn btn-success">Quản lý chung</a>
</p>
<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên slide:</label>
		<input type="text" value="<?echo set_value('name')?>" name="name" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="link">Đường dẫn:</label>
		<input type="text" value="<?echo set_value('link')?>" name="link" class="form-control" id="link">
		<div style="color:red ; font-size:10px"><?echo form_error('link')?></div>
	</div>
	<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" value="<?echo set_value('position')?>" name="position" class="form-control" id="position">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<div class="form-group">
		<label for="InputFile">Chọn hình</label>
		<input type="file" name="image" id="image">
		<p class="help-block">Kích cỡ ảnh lưu ý (1678 x 296)px.</p>
	</div>
	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>
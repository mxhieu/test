<div class="graphs">
<h3 class="blank1">Cập nhất slide</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("slide/add")?>" class="btn btn-success">Thêm slide</a>
	<a style="margin:5px 0px" href="<?echo admin_url("slide")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên slide:</label>
		<input type="text" name="name" class="form-control" id="name" value="<?echo $info_slide->name?>">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="link">Đường dẫn:</label>
		<input type="text" name="link" class="form-control" id="link" value="<?echo $info_slide->link?>">
		<div style="color:red ; font-size:10px"><?echo form_error('link')?></div>
	</div>
	<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" name="position" class="form-control" id="position" value="<?echo $info_slide->position?>">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input style="display: inline-block;width: 33.5%;" type="file" name="image" id="image">
		<div style="display: inline-block; width: 30%"><img style='width: 100px' src="<?echo base_url('upload/slide/').$info_slide->image?>"></div>
		<p class="help-block">Example block-level help text here.</p>

	</div>
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
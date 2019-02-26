<div class="graphs">
<h3 class="blank1">Thêm loại tin tức</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("catalog_news/add")?>" class="btn btn-success">Thêm loại tin tức</a>
	<a style="margin:5px 0px" href="<?echo admin_url("catalog_news")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên loại tin tức:</label>
		<input type="text" name="name" value="<?echo $info_catalog_news->name?>" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" name="position" value="<?echo $info_catalog_news->position?>" class="form-control" id="position">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
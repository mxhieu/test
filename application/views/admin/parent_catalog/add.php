
<div class="graphs">
<h3 class="blank1">Thêm danh mục cha (menu)</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("parent_catalog/add")?>" class="btn btn-success">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("parent_catalog")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên danh mục:</label>
		<input type="text" name="name" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
	  <label for="keyword">Keyword (seo):</label>
	  <textarea class="form-control" name="keyword" rows="5" id="keyword"></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Description (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>
		<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" name="position" class="form-control" id="position">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>
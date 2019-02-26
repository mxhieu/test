
<div class="graphs">
<h3 class="blank1">Thêm danh mục thuốc</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("catalog/add")?>" class="btn btn-success">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("catalog")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên danh mục:</label>
		<input type="text" name="name" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
	  <label for="parent_catalog">Danh mục cha:</label>
	  <select class="form-control" name="parent_catalog" id="sel1">
	  <option value="0" class="my_option">Danh mục cha</option>
	  	<?foreach($catalogs as $val):?>			
		        <option class="my_option" value="<?echo $val->id?>"><?echo $val->name?></option>
				<?foreach($val->subs as $sub_val):?>	
				<option class="my_option" value="<?echo $sub_val->id?>">--<?echo $sub_val->name?></option>
					<?foreach($sub_val->subs as $last_val):?>
						<option value="<?echo $last_val->id?>" disabled>----<?echo $last_val->name?></option>
					<?endforeach;?>
				<?endforeach;?>
		<?endforeach;?>
	  </select>
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
	<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" value="<?echo set_value('position')?>" name="position" class="form-control" id="position">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input type="file" name="image" id="image">
		<p class="help-block">Kích cỡ ảnh lưu ý (256 x 254)px.</p>
	</div>
	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>

<div class="graphs">
<h3 class="blank1">Cập nhật mục thuốc</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("catalog/add")?>" class="btn btn-success">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("catalog")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên danh mục:</label>
		<input type="text" name="name" class="form-control" id="name" value="<?echo $info->name?>">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
	  <label for="parent_catalog">Danh mục cha <span>(bạn chỉ được chọn những danh mục cùng cấp với danh mục cha hiện tại)</span></label>
	  <select class="form-control" name="parent_catalog" id="sel1">
	  <option value="0" <?if($info->parent_id!=0){echo "disabled";}else echo "class='my_option'"?>>Danh mục cha</option>
	  <?if($info->parent_id!=0):?>
		  <?foreach($catalogs as $val):?>			
					<option <?if($val->parent_id!=$info_parent->parent_id){ echo "disabled";} else echo 'class="my_option"'?> value="<?echo $val->id?>" <?if($val->id==$info->parent_id) echo "selected"?>><?echo $val->name?></option>
					<?foreach($val->subs as $sub_val):?>	
					<option value="<?echo $sub_val->id?>" <?if($sub_val->parent_id!=$info_parent->parent_id){ echo "disabled";} else echo 'class="my_option"'?> <?if($sub_val->id==$info->parent_id) echo "selected"?>>--<?echo $sub_val->name?></option>
						<?foreach($sub_val->subs as $last_val):?>
							<option value="<?echo $last_val->id?>" disabled <?if($last_val->id==$info->parent_id) echo "selected"?>>----<?echo $last_val->name?></option>
						<?endforeach;?>
					<?endforeach;?>
			<?endforeach;?>
		<?endif;?>
	  </select>
	</div>
	<div class="form-group">
	  <label for="keyword">Keyword (seo):</label>
	  <textarea class="form-control" name="keyword" rows="5" id="keyword"><?echo $info->keyword?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Description (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"><?echo $info->description?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>
	<div class="form-group">
		<label for="position">Vị trí:</label>
		<input type="text" name="position" class="form-control" id="position" value="<?echo $info->position?>">
		<div style="color:red ; font-size:10px"><?echo form_error('position')?></div>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input style="display: inline-block;width: 33.5%;" type="file" name="image" id="image">
		<div style="display: inline-block; width: 30%"><img style='width: 100px' src="<?echo base_url('upload/catalog/').$info->image?>"></div>
		<p class="help-block">Kích cỡ ảnh lưu ý (256 x 254)px..</p>
	</div>
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
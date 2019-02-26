
<div class="graphs">
<h3 class="blank1">Cập nhật thuốc</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("product/add")?>" class="btn btn-success">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("product")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên thuốc:</label>
		<input type="text" name="name" class="form-control" id="name" value="<?echo $info_product->name?>">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
	  <label for="id_cat">Danh mục:</label>
	  <select class="form-control" name="id_cat" id="sel1">
	  	<option value="0" selected="selected">Chọn danh mục</option>
	  	<?foreach($catalogs as $val):?>			
		        <option value="<?echo $val->id?>" disabled><?echo $val->name?></option>
				<?foreach($val->subs as $sub_val):?>	
				<option value="<?echo $sub_val->id?>" disabled >--<?echo $sub_val->name?></option>
					<?foreach($sub_val->subs as $last_val):?>
						<option class="my_option" <?if($last_val->id == $info_product->id_cat) echo "selected"?> value="<?echo $last_val->id?>">----<?echo $last_val->name?></option>
					<?endforeach;?>
				<?endforeach;?>
		<?endforeach;?>
	  </select>
	  <div style="color:red ; font-size:10px"><?echo form_error('id_cat')?></div>
	</div>
	<div class="form-group">
	  <label for="provider">Nhà cung cấp:</label>
	  <select class="form-control" name="provider" id="sel1">
		<?foreach($list_provider as $provider):?>
		    <option <?if($provider->id == $info_product->id_provider) echo "selected"?> value="<?echo $provider->id?>"><?echo $provider->name?></option>
		<?endforeach;?>
	  </select>
	   <div style="color:red ; font-size:10px"><?echo form_error('provider')?></div>
	</div>
	<div class="form-group">
		<label for="price">Gía:</label>
		<input type="text" name="price" class="form-control" id="price" value="<?echo $info_product->price?>">
		<div style="color:red ; font-size:10px"><?echo form_error('price')?></div>
	</div>
	<div class="form-group">
		<label for="discount">Giảm giá:</label>
		<input type="text" name="discount" class="form-control" id="discount" value="<?echo $info_product->discount?>">
		<div style="color:red ; font-size:10px"><?echo form_error('discount')?></div>
	</div>
	<div class="form-group">
		<label for="quantity">Số lượng:</label>
		<input type="text" name="quantity" class="form-control" id="quantity" value="<?echo $info_product->quantity?>">
		<div style="color:red ; font-size:10px"><?echo form_error('quantity')?></div>
	</div>
	<div class="form-group">
		<label for="style">Quy cách:</label>
		<input type="text" name="style" class="form-control" id="style" value="<?echo $info_product->style?>">
		<div style="color:red ; font-size:10px"><?echo form_error('style')?></div>
	</div>
	<div class="form-group">
		<label for="origin">Xuất sứ:</label>
		<input type="text" name="origin" class="form-control" id="origin" value="<?echo $info_product->origin?>">
		<div style="color:red ; font-size:10px"><?echo form_error('origin')?></div>
	</div>
	<div class="form-group">
		<label for="element">Thành phần:</label>
		<input type="text" name="element" class="form-control" id="element" value="<?echo $info_product->element?>">
		<div style="color:red ; font-size:10px"><?echo form_error('element')?></div>
	</div>
	<div class="form-group">
		<label for="uses">Công dụng:</label>
		<input type="text" name="uses" class="form-control" id="uses" value="<?echo $info_product->uses?>">
		<div style="color:red ; font-size:10px"><?echo form_error('uses')?></div>
	</div>
	<div class="form-group">
		<label for="usage_medicine">Liều dùng:</label>
		<input type="text" name="usage_medicine" class="form-control" id="usage_medicine" value="<?echo $info_product->usage_medicine?>">
		<div style="color:red ; font-size:10px"><?echo form_error('usage_medicine')?></div>
	</div>
	<div class="form-group">
	  <label for="content">Nội dung:</label>
	  <textarea class="form-control" name="content" rows="5" id="content"><?echo $info_product->content?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('content')?></div>
	   <script>CKEDITOR.replace( 'content',{
			filebrowserBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserUploadUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserImageBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=1&editor=ckeditor&akey=<?echo md5('123456')?>&fldr='
		} );</script>
	</div>
	
	<div class="form-group">
	  <label for="keyword">Từ khóa (seo):</label>
	  <textarea class="form-control" name="keyword" rows="5" id="keyword"><?echo $info_product->keyword?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Mô tả (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"><?echo $info_product->description?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input style="display: inline-block;width: 33.5%;" type="file" name="image" id="image">
		<div style="display: inline-block; width: 30%"><img style='width: 70px' src="<?echo base_url('upload/product/').$info_product->image?>"></div>
		<p class="help-block">Kích cỡ ảnh lưu ý (300 x 300)px.</p>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Hình ảnh đính kèm</label>
		<input style="display: inline-block;" type="file" name="image_list[]" id="image" multiple="">
		<div style="display: inline-block; width: 30%">
			<?$image_list = json_decode($info_product->image_list)?>
			<?if(is_array($image_list)):?>
			<?foreach($image_list as $img):?>
				<img style='width: 70px' src="<?echo base_url('upload/product/').$img?>">
			<?endforeach;?>
			<?endif;?>
		</div>
		<p class="help-block">Kích cỡ ảnh lưu ý (300 x 300)px.</p>
	</div>
	
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
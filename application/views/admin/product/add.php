
<div class="graphs">
<h3 class="blank1">Thêm thuốc</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("product/add")?>" class="btn btn-success">Thêm danh mục</a>
	<a style="margin:5px 0px" href="<?echo admin_url("product")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên thuốc:</label>
		<input type="text" name="name" class="form-control" id="name" value="<?echo set_value('name')?>">
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
						<option class="my_option" value="<?echo $last_val->id?>">----<?echo $last_val->name?></option>
					<?endforeach;?>
				<?endforeach;?>
		<?endforeach;?>
	  </select>
	  <div style="color:red ; font-size:10px"><?echo form_error('id_cat')?></div>
	</div>
	<div class="form-group">
	  <label for="provider">Nhà cung cấp:</label>
	  <select class="form-control" name="provider" id="sel1">
	  	<option value="0" selected="selected">Chọn nhà cung cấp</option>
	  	<?foreach($list_provider as $provider):?>							      
		        <option value="<?echo $provider->id?>"><?echo $provider->name?></option>
		<?endforeach;?>
	  </select>
	   <div style="color:red ; font-size:10px"><?echo form_error('provider')?></div>
	</div>
	<div class="form-group">
		<label for="price">Gía:</label>
		<input type="text" name="price" class="form-control" value="<?echo set_value('price')?>" id="price">
		<div style="color:red ; font-size:10px"><?echo form_error('price')?></div>
	</div>
	<div class="form-group">
		<label for="discount">Giảm giá:</label>
		<input type="text" name="discount" class="form-control" id="discount" value="<?echo set_value('discount')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('discount')?></div>
	</div>
	<div class="form-group">
		<label for="quantity">Số lượng:</label>
		<input type="text" name="quantity" class="form-control" id="quantity" value="<?echo set_value('quantity')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('quantity')?></div>
	</div>
	<div class="form-group">
		<label for="style">Quy cách:</label>
		<input type="text" name="style" class="form-control" id="style" value="<?echo set_value('style')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('style')?></div>
	</div>
	<div class="form-group">
		<label for="origin">Xuất sứ:</label>
		<input type="text" name="origin" class="form-control" id="origin" value="<?echo set_value('origin')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('origin')?></div>
	</div>
	<div class="form-group">
		<label for="element">Thành phần:</label>
		<input type="text" name="element" class="form-control" id="element" value="<?echo set_value('element')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('element')?></div>
	</div>
	<div class="form-group">
		<label for="uses">Công dụng:</label>
		<input type="text" name="uses" class="form-control" id="uses" value="<?echo set_value('uses')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('uses')?></div>
	</div>
	<div class="form-group">
		<label for="usage_medicine">Liều dùng:</label>
		<input type="text" name="usage_medicine" class="form-control" id="usage_medicine" value="<?echo set_value('usage_medicine')?>">
		<div style="color:red ; font-size:10px"><?echo form_error('usage_medicine')?></div>
	</div>
	<div class="form-group">
	  <label for="content">Nội dung:</label>
	  <textarea class="form-control" name="content" rows="5" id="content"><?echo set_value('content')?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('content')?></div>
	   <script>CKEDITOR.replace( 'content',{
			filebrowserBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserUploadUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserImageBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=1&editor=ckeditor&akey=<?echo md5('123456')?>&fldr='
		});</script>
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
		<label for="exampleInputFile">Chọn hình</label>
		<input type="file" name="image" id="image">
		<p class="help-block">Kích cỡ ảnh lưu ý (300 x 300)px.</p>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Hình ảnh đính kèm</label>
		<input type="file" name="image_list[]" id="image" multiple="">
		<p class="help-block">Kích cỡ ảnh lưu ý (300 x 300)px.</p>
	</div>
	
	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>
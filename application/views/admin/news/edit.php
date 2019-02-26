
<div class="graphs">
<h3 class="blank1">Cập nhật tin tức</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("news/add")?>" class="btn btn-success">Thêm tin tức</a>
	<a style="margin:5px 0px" href="<?echo admin_url("news")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên tin tức:</label>
		<input type="text" name="name" class="form-control" value="<?echo $info_news->name?>" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
	  <label for="keyword">Từ khóa (seo):</label>
	  <textarea class="form-control" name="keyword" rows="5" id="keyword"><?echo $info_news->keyword?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Mô tả (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"><?echo $info_news->description?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>
	<div class="form-group">
	  <label for="content">Nội dung :</label>
	  <textarea class="form-control" name="content" rows="5" id="content"><?echo $info_news->content?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('content')?></div>
	   <script>
	   CKEDITOR.replace( 'content',{
			filebrowserBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserUploadUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=2&editor=ckeditor&akey=<?echo md5('123456')?>&fldr=',
			filebrowserImageBrowseUrl : '<?echo base_url()?>public/admin/filemanager/dialog.php?type=1&editor=ckeditor&akey=<?echo md5('123456')?>&fldr='
		});</script>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input type="file" name="image" id="image" style="display: inline-block;">
		<div style="display: inline-block; width: 30%"><img style='width: 100px' src="<?echo base_url('upload/news/').$info_news->image?>"></div>
		<p class="help-block">Example block-level help text here.</p>
	</div>
	
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
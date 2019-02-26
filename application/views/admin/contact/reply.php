<div class="graphs">
<h3 class="blank1">Trả lời cho khách hàng</h3>
<p>
	<a style="margin:5px 0px" href="<?echo admin_url("contact")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="email">Email khách hàng:</label>
		<input type="text" readonly value="<?echo $info_cus->email?>" name="email" class="form-control" id="email">
	</div>
	<div class="form-group">
		<label for="email">Ý kiến của khách hàng:</label>
		<textarea readonly class="form-control" name="contact" rows="5" id="contact"><?echo $info_cus->content?></textarea>
	</div>
	<div class="form-group">
		<label for="title">Tiêu đề:</label>
		<input type="text" value="<?echo set_value('title')?>" name="title" class="form-control" id="title">
		<div style="color:red ; font-size:10px"><?echo form_error('title')?></div>
	</div>
	<div class="form-group">
	  <label for="content">Nội dung:</label>
	  <textarea class="form-control" name="content" rows="5" id="content"></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('content')?></div>
	</div>
	<input type="submit" name="submit" value="Gửi" class="btn-success btn">
</form>
</div>
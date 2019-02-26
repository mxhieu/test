<div class="graphs">
<h3 class="blank1">Quản lý thông tin website bán thực phẩm chức năng H&T</h3>
<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="title">Tiêu đề web site:</label>
		<input type="text" name="title" class="form-control" id="title" value="<?echo $info_web->title?>">
		<div style="color:red ; font-size:10px"><?echo form_error('title')?></div>
	</div>
	<div class="form-group">
		<label for="domain">Tên miền:</label>
		<input readonly type="text" name="domain" class="form-control" id="domain" value="<?echo base_url()?>">
		<div style="color:red ; font-size:10px"><?echo form_error('domain')?></div>
	</div>
	<div class="form-group">
		<label for="slogan">Slogan:</label>
		<input type="text" name="slogan" class="form-control" id="slogan" value="<?echo $info_web->slogan?>">
		<div style="color:red ; font-size:10px"><?echo form_error('slogan')?></div>
	</div>
	<div class="form-group">
		<label for="keyword">Từ khóa:</label>
		<input type="text" name="keyword" class="form-control" id="keyword" value="<?echo $info_web->keyword?>">
		<div style="color:red ; font-size:10px"><?echo form_error('keyword')?></div>
	</div>
	<div class="form-group">
	  <label for="description">Mô tả (seo):</label>
	  <textarea class="form-control" name="description" rows="5" id="description"><?echo $info_web->description?></textarea>
	  <div style="color:red ; font-size:10px"><?echo form_error('description')?></div>
	</div>
	<div class="form-group">
		<label for="address">Địa chỉ:</label>
		<input type="text" name="address" class="form-control" id="address" value="<?echo $info_web->address?>">
		<div style="color:red ; font-size:10px"><?echo form_error('address')?></div>
	</div>
	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" name="email" class="form-control" id="email" value="<?echo $info_web->email?>">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="phone">Điện thoại:</label>
		<input type="text" name="phone" class="form-control" id="phone" value="<?echo $info_web->phone?>">
		<div style="color:red ; font-size:10px"><?echo form_error('phone')?></div>
	</div>
	<div class="form-group">
		<label for="phone">Fanpage:</label>
		<input type="text" name="fanpage" class="form-control" id="fanpage" value="<?echo $info_web->fanpage?>">
		<div style="color:red ; font-size:10px"><?echo form_error('fanpage')?></div>
	</div>
	<div class="form-group">
		<label for="hotline">Hotline:</label>
		<input type="text" name="hotline" class="form-control" id="hotline" value="<?echo $info_web->hotline?>">
		<div style="color:red ; font-size:10px"><?echo form_error('hotline')?></div>
	</div>
		<div class="form-group">
		<label for="fax">Fax:</label>
		<input type="text" name="fax" class="form-control" id="fax" value="<?echo $info_web->fax?>">
		<div style="color:red ; font-size:10px"><?echo form_error('fax')?></div>
	</div>
	<div class="form-group">
		<label for="account_email">Tài khoản mail:</label>
		<input type="text" name="account_email" class="form-control" id="account_email" value="<?echo $info_web->emailuser?>">
		<div style="color:red ; font-size:10px"><?echo form_error('account_email')?></div>
	</div>
	<div class="form-group">
		<label for="pass_email">Mật khẩu email:</label>
		<input type="password" name="pass_email" class="form-control" id="pass_email" value="<?echo $info_web->emailpwd?>">
		<div style="color:red ; font-size:10px"><?echo form_error('pass_email')?></div>
	</div>
	<div class="form-group">
		<label for="logo">Logo website</label>
		<input style="display: inline-block;width: 33.5%;" type="file" name="logo" id="logo">
		<div style="display: inline-block; width: 30%"><img style='width: 70px' src="<?echo base_url('upload/info/').$info_web->logo?>"></div>
		<p class="help-block">Kích cỡ ảnh lưu ý(295 x 74)px.</p>
	</div>
	<input type="submit" name="submit" value="Chấp nhận" class="btn-success btn">
</form>
</div>
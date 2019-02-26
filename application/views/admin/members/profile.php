
<div class="graphs">
<h3 class="blank1">Thông tin tài khoản</h3>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên:</label>
		<input type="text" value="<?echo $info_member->name?>" name="name" class="form-control" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" readonly name="username" class="form-control" value="<?echo $info_member->username?>" id="username">
		<div style="color:red ; font-size:10px"><?echo form_error('username')?></div>
	</div>
	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" value="<?echo $info_member->email?>" name="email" class="form-control" id="email">
		<div style="color:red ; font-size:10px"><?echo form_error('email')?></div>
	</div>
	<div class="form-group">
		<label for="password">Mật khẩu (nhập thông tin để thay đổi mật khẩu):</label>
		<input type="password" name="password" class="form-control" id="password">
		<div style="color:red ; font-size:10px"><?echo form_error('password')?></div>
	</div>
	<div class="form-group">
		<label for="repassword">Nhập lại mật khẩu:</label>
		<input type="password" name="repassword" class="form-control" id="repassword">
		<div style="color:red ; font-size:10px"><?echo form_error('repassword')?></div>
	</div>
	<div class="form-group">
		<label for="exampleInputFile">Chọn hình</label>
		<input type="file" name="image" id="image">
		<p class="help-block">Example block-level help text here.</p>
		<div><img style="width: 100px;" src="<?echo base_url("upload/member/").$info_member->image?>"></div>
	</div>
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
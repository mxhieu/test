
<div class="graphs">
<h3 class="blank1">Cập nhật tài khoản</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("members/add")?>" class="btn btn-success">Thêm tài khoản</a>
	<a style="margin:5px 0px" href="<?echo admin_url("members")?>" class="btn btn-success">Quản lý chung</a>
</p>

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
	<?if($info_member->id != 1):?>
	<div class="form-group">
		<label style="margin-bottom: 100px;" for="permissions">Chọn quyền :</label>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Admin cao nhất: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" <?if($info_member->id_group == 0) echo 'checked';?> name="permissions" value="master_admin">
				<span class="checkmark"></span>
			</label>
		</div>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Người dùng admin: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" <?if($info_member->id_group == 2) echo 'checked';?> name="permissions" value="user_admin">
				<span class="checkmark"></span>
			</label>
		</div>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Nhân viên quản lý order: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" <?if($info_member->id_group == 1) echo 'checked';?> name="permissions" value="order">
				<span class="checkmark"></span>
			</label>
		</div>
	</div>
	<?endif;?>
	<input type="submit" name="submit" value="Cập nhật" class="btn-success btn">
</form>
</div>
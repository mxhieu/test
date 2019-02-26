
<div class="graphs">
<h3 class="blank1">Thêm tài khoản</h3>
<p>
	<a style="margin:5px" href="<?echo admin_url("members/add")?>" class="btn btn-success">Thêm tài khoản</a>
	<a style="margin:5px 0px" href="<?echo admin_url("members")?>" class="btn btn-success">Quản lý chung</a>
</p>

<form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<label for="name">Tên:</label>
		<input type="text" name="name" class="form-control" value="<?echo set_value('name')?>" id="name">
		<div style="color:red ; font-size:10px"><?echo form_error('name')?></div>
	</div>
	<div class="form-group">
		<label for="username">Tài khoản:</label>
		<input type="text" name="username" value="<?echo set_value('username')?>" class="form-control" id="username">
		<div style="color:red ; font-size:10px"><?echo form_error('username')?></div>
	</div>
	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" value="<?echo set_value('email')?>" name="email" class="form-control" id="email">
		<div style="color:red ; font-size:10px"><?echo form_error('email')?></div>
	</div>
	<div class="form-group">
		<label for="password">Mật khẩu:</label>
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
		<p class="help-block"></p>
	</div>
	<div class="form-group">
		<label style="margin-bottom: 100px;" for="permissions">Chọn quyền :</label>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Admin cao nhất: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" checked name="permissions" value="master_admin">
				<span class="checkmark"></span>
			</label>
		</div>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Người dùng admin: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" name="permissions" value="user_admin">
				<span class="checkmark"></span>
			</label>
		</div>
		<div style="width:30%;display:inline-block">
			<div class="checkbox_left">
			<b style="margin-right:30px">Nhân viên quản lý order: </b>
			</div>
			<label class="my_checkbox">
				<input type="radio" name="permissions" value="order">
				<span class="checkmark"></span>
			</label>
		</div>
	</div>

	<input type="submit" name="submit" value="Thêm mới" class="btn-success btn">
</form>
</div>

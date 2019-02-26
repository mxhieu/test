
<!DOCTYPE HTML>
<html>
<head>
<title>Trang Admin website bán thuốc(đồ án tốt nghiệp)</title>
<?$this->load->view('admin/head')?>
</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Đăng nhập vào </span> <a href="<?echo admin_url('login')?>"> Trang quản trị</a></p>
						</div>
						<div class="signin">

						<form action="" method="post" name="login">
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" class="user" name="username" value="Tài khoản" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Tài khoản:';}"/>
								</div>
								<?echo form_error('username')?>

								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" name="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address:';}"/>
								</div>
								<?echo form_error('password')?>

								<div class="clearfix"> </div>
							</div>
							<?echo form_error('login')?>
							<input type="submit" value="Đăng nhập">
						</form>	 
						</div>
						
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			   <p>2018 Xuân Hiếu & Minh Thiệt</p>
			</footer>
        <!--footer section end-->
	</section>

</body>
</html>
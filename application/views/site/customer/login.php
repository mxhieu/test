<main>

<style>

</style>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
			<form action="<?echo base_url().'index.php/customer/login'?>" method="post" >
			<div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="username" style="margin-bottom:10px" type="text" id="username" class="form-control" placeholder="Nhập tài khoản" required autofocus>
                <input name="password" style="width:100%;margin-bottom: 10px;" type="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                <?echo form_error('login')?>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng nhập</button>
            </form><!-- /form -->
            <a href="<?echo base_url('index.php/quen-mat-khau.html')?>" class="forgot-password">
                Quên mật khẩu?
            </a>
        </div><!-- /card-container -->
		
		
			</form>		
		</div>
</div>
</main>

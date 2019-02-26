<main>

<style>

</style>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-content">
		<div class="container" >
			<form action="<?echo base_url().'index.php/customer/forget_password'?>" method="post" >
			<div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input name="email" style="margin-bottom:10px" type="email" id="email" class="form-control" placeholder="Nhập email đăng kí" required autofocus>
                <?echo form_error('check_email_not_exists')?>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Lấy lại mật khẩu</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
		
		
			</form>		
		</div>
</div>
</main>

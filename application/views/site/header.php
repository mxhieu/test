 <script type="text/javascript">
	$(function() {
	$( "#search_p" ).autocomplete({
		source: "<?echo base_url('index.php/product/get_autocomplete')?>",
	});
});
</script>
<div class="main-header">
	<div class="container">
		<div class="row">
			<header>
				<div class="col-xs-12 col-sm-3 logo">
					<a href="<?echo base_url()?>">
						<img src="<?echo base_url('upload/info/').$logo?>" alt="">
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 form-search">
    <div id="navbar" class="navbar-collapse collapse1">
        <ul class="nav navbar-nav search-nav">
            <li>
                <form type="search" class="expanding-search-form" name="search_product" action="<?echo base_url('index.php/tim-kiem?')?>" method="get" autocomplete="off">
                    <div class="item-left">
                        <input id="search_p"class="search-input ui-autocomplete-input" name="keysearch" value="<?echo $key;?>" type="search" placeholder="Bạn cần tìm gì ?" role="textbox" aria-autocomplete="list" aria-haspopup="true">
						<div class="my-drop-down" id="option">
							<select id="sel2" name="search-product" class="form-control my-form-control">
							  <option value="0">Tất cả <i class="fal fa-caret-down"></i></option>
							  <?foreach($list_parent_cat as $parent_cat):?>
							  <option value="<?echo $parent_cat->id?>" <?if($parent_cat->id==$id_cat) echo 'selected'?>><?echo $parent_cat->name?></option>
							  <?endforeach;?>
							</select>
                        </div>
                    </div>
                    <button id="search-submit" class="button search-button" type="submit" onclick="return search_empty()">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg><!-- <i class="fas fa-search"></i> -->
                    </button>
                </form>
				
            </li>
        </ul>

        <div class="clearfix"></div>
        <div id="result" class="result" style="display: block">
            <ul class="search-suggestion"></ul>
        </div>
    </div>
</div>				



				<div class="col-xs-12 col-sm-3 pppp">
					<div style="float: right;
    margin-top: 10px;">
						
						
						
					</div>	
				</div>
			
			
			

</header>
		</div>
	</div>

	<div class="w3-sidebar w3-bar-block w3-mau w3-animate-left" style="display:none; top:0; z-index: 100;" id="mySidebar">
		<button class="w3-bar-item w3-large text-right" onclick="w3_close()"> <p class="pull-right">×</p></button>
		<a href="<?echo base_url()?>"><img src="<?echo base_url('upload/info/').$logo?>" alt=""></a>
		<a href="<?echo base_url()?>" class="w3-bar-item w3-button home">Trang chủ</a>
		<?echo $toggle?>
		<?if(!empty($carts)):?>
		<a href="<?echo base_url('index.php/').'thanh-toan.html'?>" class="w3-bar-item w3-button"><i class="fas fa-shopping-cart"></i> Giỏ hàng có <span style="color:#ef8434"><?echo count($carts)?></span> sản phẩm</a>
		<?endif;?>
		<?if(isset($_SESSION['cus_login'])):?>
		<a class="w3-bar-item w3-button" href="<?echo base_url('index.php/customer/info_cus')?>">Chào mừng: <?echo $_SESSION['cus_name']?></a>
		<a class="w3-bar-item w3-button" href="<?echo base_url('index.php/customer/logout')?>">Thoát</a>
	
		<?else:?>
		<a href="<?echo base_url('index.php/customer/register')?>" class="w3-bar-item w3-button"><i class="far fa-registered"></i> Đăng kí</a>
		<a href="<?echo base_url('index.php/customer/login')?>" class="w3-bar-item w3-button"><i class="fas fa-user"></i> Đăng nhập</a>
		<?endif;?>
	</div>
	
	
	<button class="  show1 w3-xxlarge" id="show" onclick="w3_open()">
	<span>☰<?if(!empty($carts)):?><i class="my_total_cart">1</i><?endif;?>
	</span>
		<a href="<?echo base_url()?>"><img src="<?echo base_url('upload/info/').$logo?>" alt=""></a>
	</button> 

	<nav class="navbar navbar-default" role="navigation">
		<div class="container"> 
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" style="display:inline-block!important; width: 89%;">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?echo base_url()?>">Trang Chủ</a></li>
					<?echo $menu?>
					<!--<li><a href="<?echo base_url()?>/duoc-my-pham">Dược Mỹ phẩm</a></li>-->
					<li><a href="<?echo base_url('index.php/').'bai-viet'?>">Tin tức</a></li>
					<li><a href="<?echo base_url('index.php/').'lien-he.html'?>">Liên hệ</a></li>
					<?if(isset($_SESSION['cus_login'])):?>
					<li><a href="<?echo base_url('index.php/thong-tin-tai-khoan.html')?>">Chào mừng: <?echo $_SESSION['cus_name']?></a></li>
					<li><a href="<?echo base_url('index.php/customer/logout')?>">Thoát</a></li>
					<?else:?>
					<li><a href="<?echo base_url('index.php/dang-ki.html')?>">Đăng kí</a></li>
					<li><a href="<?echo base_url('index.php/dang-nhap.html')?>" >Đăng nhập</a></li>
					<?endif;?>
				</ul>
			</div> 
			<div class="shopping-cart">
				<a href='<?echo base_url('index.php/').'thanh-toan.html'?>' class='btn btn-danger'><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
			</div>
	</nav>
</div>

<div class="menu-mobile">
	<ul>
	<?foreach($menu_mobile as $row):?>
		<li><a href="<?echo base_url('index.php/').$row->slug.'-c'.$row->id?>"><?echo $row->name?></a></li>
	<?endforeach;?>
		<li><a href="<?echo base_url('index.php/').'bai-viet'?>">Tin tức</a></li>
		<li><a href="<?echo base_url('index.php/').'lien-he.html'?>">Liên hệ</a></li>
		<?if(isset($_SESSION['cus_login'])):?>
		<li><a href="<?echo base_url('index.php/customer/info_cus')?>">Chào mừng: <?echo $_SESSION['cus_name']?></a></li>
		<li><a href="<?echo base_url('index.php/customer/logout')?>">Thoát</a></li>
		<?else:?>
		<li><a href="<?echo base_url('index.php/dang-ki.html')?>">Đăng kí</a></li>
		<li><a href="<?echo base_url('index.php/customer/login')?>" >Đăng nhập</a></li>
		<?endif;?>
	</ul>
</div>



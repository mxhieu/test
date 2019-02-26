

<!--logo and iconic logo start-->
<div class="logo">
	<h1><a href="<?echo admin_url()?>">Trang <span>quản trị</span></a></h1>
</div>
<!--logo and iconic logo end-->
<div class="left-side-inner">
	<!--sidebar nav start-->
		<ul class="nav nav-pills nav-stacked custom-nav">
			<li <?if($active == 'home') echo 'class="active"';?> ><a href="<?echo admin_url('home')?>"><i class="fas fa-home"></i><span>Trang chủ</span></a></li>
			<li class="menu-list"><a href="#"><i class="fas fa-users"></i>
				<span>Quản lý tài khoản</span></a>
				<ul class="sub-menu-list">
					<li><a href="<?echo admin_url('members/load_members')?>">Tài khoản admin</a></li>
					<li><a href="<?echo admin_url('customer/load_customer')?>">Tài khoản khách hàng</a></li>
				</ul>
			</li>
			<li <?if($active == 'catalog') echo 'class="active"';?> ><a href="<?echo admin_url("catalog/load_catalog")?>"><i class="fas fa-list"></i><span>Danh mục thuốc</span></a></li>
			<li class="menu-list"><a href="#"><i class="fas fa-capsules"></i>
				<span>Quản lý thuốc</span></a>
				<ul class="sub-menu-list">
					<li><a href="<?echo admin_url("product/load_product")?>">Thuốc đang bán</a> </li>
					<li><a href="<?echo admin_url("product/load_out_of_product")?>">Thuốc hết số lượng</a></li>
				</ul>
			</li>
			<li <?if($active == 'provider') echo 'class="active"';?> ><a href="<?echo admin_url("provider/load_provider")?>"><i class="fas fa-warehouse"></i><span>Nhà cung cấp</span></a></li>
			<li <?if($active == 'news') echo 'class="active"';?> ><a href="<?echo admin_url("news/load_news")?>"><i class="far fa-newspaper"></i><span>Tin tức</span></a></li>
			<li <?if($active == 'orders') echo 'class="active"';?> ><a href="<?echo admin_url("orders/load_order_index")?>"><i class="fas fa-shopping-cart"></i><span>Đơn đặt hàng</span></a></li> 			
			<li <?if($active == 'slide') echo 'class="active"';?> ><a href="<?echo admin_url("slide/load_slide")?>"><i class="fas fa-sliders-h"></i><span>Slide</span></a></li>
			<li <?if($active == 'contact') echo 'class="active"';?> ><a href="<?echo admin_url("contact/load_contact")?>"><i class="fas fa-envelope"></i><span>Ý kiến của khách hàng</span></a></li>	
			<li <?if($active == 'info') echo 'class="active"';?> ><a href="<?echo admin_url("info")?>"><i class="fas fa-info"></i><span>Thông tin website</span></a></li>		
		</ul>

	<!--sidebar nav end-->
</div>

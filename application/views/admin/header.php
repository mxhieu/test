<div class="header-section">
			<a class="toggle-btn"><i class="fa fa-bars"></i></a>
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
						<ul class="nofitications-dropdown">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge"><?echo $total_contact?></span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>Bạn có <?echo $total_contact?> ý kiến mới</h3>
												</div>
											</li>
											
											<?foreach($list_contact as $contact):?>
											<li>
											<a href="<?echo admin_url('contact/reply/').$contact->id?>">
											   <div class="notification_desc">
											
												</div>
											   <div class="clearfix"></div>	
											 </a>
											 </li>
											 <?endforeach;?>
											<li>
												<div class="notification_bottom">
													<a href="<?echo admin_url('contact')?>">Xem tất cả ý kiến mới</a>
												</div> 
											</li>
										</ul>
							</li>
							<li class="login_box" id="loginContainer">
									<div class="search-box">
										<div id="sb-search" class="sb-search">
											<?if($action!='index'):?>
											<form method="post" action="<?echo admin_url().$table.'/'.$action?>">
											<?else:?>
											<form method="post" action="<?echo admin_url().$table?>">
											<?endif;?>
												<input class="sb-search-input" value="<?echo $search_text?>" placeholder="Nhập từ khóa tìm kiếm..." type="search" name="s" id="search">
												<input class="sb-search-submit" name="submit" type="submit" value="">
												<span class="sb-icon-search"> </span>
											</form>
										</div>
									</div>
										<!-- search-scripts -->
										<script src="<?echo public_url("admin/")?>js/classie.js"></script>
										<script src="<?echo public_url("admin/")?>js/uisearch.js"></script>
											<script>
												new UISearch( document.getElementById( 'sb-search' ) );
											</script>
										<!-- //search-scripts -->
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue count"><?echo $total_orders?></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<h3>Bạn có <?echo $total_orders?> đơn đặt hàng mới</h3>
											</div>
										</li>
										<?foreach($list_order_header as $orders):?>
										<li>
											<a href="<?echo admin_url().'orders/detail/'.$orders->id?>" target="blank">
											  <div class="notification_desc dropdown-menu-orders">
										
											</div>
											  <div class="clearfix"></div>	
											</a>
										 </li>
										<?endforeach;?>
										<li>
											<div class="notification_bottom">
												<a href="<?echo admin_url('orders')?>">Xem tất cả đơn hàng</a>
											</div> 
										</li>
									</ul>
							</li>	
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1"><?echo $total_o_p ?></span></a>
									<ul class="dropdown-menu">
										<li>
											<div class="notification_header">
												<h3>Có <?echo $total_o_p ?> hết số lượng</h3>
											</div>
										</li>
										<?foreach($list_out_of_p as $row):?>
										<li>
											<a href="<?echo admin_url('product/add_quantity/').$row->id?>">
											   <div class="notification_desc">
												<p>Tên SP: <?echo $row->name?></p>
				
												</div>
											   <div class="clearfix"></div>	
											 </a>
										 </li>
										 <?endforeach;?>
										 <li>
											<div class="notification_bottom">
												<a href="<?echo admin_url('product/out_of_product')?>">Xem tất cả sản phẩm hết số lượng</a>
											</div> 
										</li>
									</ul>
							</li>		   							   		
							<div class="clearfix"></div>	
						</ul>
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop" style="width: 100%;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span style="background:url(<?echo base_url().'upload/member/'.$_SESSION['image']?>) no-repeat center"> </span> 
										 <div class="user-name" >
											<p><?echo $_SESSION['name']?><span>Quản trị viên</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="<?echo admin_url('members/profile')?>"><i class="fa fa-user"></i>Hồ sơ</a> </li> 
									<li> <a href="<?echo base_url('index.php/admin/home/logout')?>"><i class="fa fa-sign-out"></i> Đăng xuất</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
					            	
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			
			</div>

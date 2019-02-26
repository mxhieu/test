<?$this->load->view('site/slide')?>
<?$this->load->view('admin/message')?>
<div class="category">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2>Danh mục nổi bật</h2>
			</div>
			<div class="clearfix"></div>
			<?foreach($list_catalog as $catalog):?>
			<div class="col-xs-6 col-sm-2">
				<a href="<?echo base_url("index.php/").$catalog->slug.'-c'.$catalog->id?>" class="thumbnail">
					<img src="<?echo base_url('upload/catalog/').$catalog->image?>" alt="<?echo $catalog->name?>">
					<div class="caption">
						<h4><?echo $catalog->name?></h4>
					</div>
				</a>
			</div>
			<?endforeach;?>
		</div>
	</div>
</div>


<!-- SP Bán chạy-->
<div class="ss-product">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 top">
				<h3 class="float-left">Bán Chạy Nhất</h3>
				<a class="float-right" href="<?echo base_url('index.php/').'san-pham-ban-chay'?>" style="color: #337ab7;">Xem thêm <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right"></i> --></a>
			</div>
			<div class="clearfix"></div>
			<?foreach($list_hot_pro as $hot_pro):?>
			<?$name_cat = convert($hot_pro->id_cat,'catalog_model','','slug',$catalog = false);?>
			<div class="col-xs-6 col-sm-15 ">
				<a href="<?echo base_url('index.php/').$name_cat.'/'.$hot_pro->slug.'-c'.$hot_pro->id_cat.'p'.$hot_pro->id?>.html">
					<div class="thumbnail">
						<img src="<?echo base_url('upload/product/').$hot_pro->image?>" alt="<?echo $hot_pro->name?>">
						<div class="caption">
							<h3><?echo $hot_pro->name?></h3>
							<p>
								<?echo $hot_pro->style?> 
							</p>
							<div class="price">
								<?if($hot_pro->quantity > 0){echo number_format($hot_pro->price).' ₫';}else echo "Đã hết số lượng";?><u></u>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?endforeach;?>
			<div class="viewmore text-center">
				<a href="<?echo base_url('index.php/').'san-pham-ban-chay'?>">
					Xem thêm bán chạy nhất
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 top">
				<h3 class="float-left">Mới nhất</h3>
				<a class="float-right" href="<?echo base_url('index.php/').'san-pham-moi'?>" style="color: #337ab7;">Xem thêm <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right"></i> --></a>
			</div>
			<div class="clearfix"></div>
			<?foreach($list_new_pro as $new_pro):?>
			<?$name_cat = convert($new_pro->id_cat,'catalog_model','','slug',$catalog = false);?>
			<div class="col-xs-6 col-sm-15 ">
				<a href="<?echo base_url('index.php/').$name_cat.'/'.$new_pro->slug.'-c'.$new_pro->id_cat.'p'.$new_pro->id?>.html">
					<div class="thumbnail">
						<img src="<?echo base_url('upload/product/').$new_pro->image?>" alt="<?echo $new_pro->name?>">
						<div class="caption">
							<h3><?echo $new_pro->name?></h3>
							<p>
								<?echo $new_pro->style?> 
							</p>
							<div class="price">
								<?if($new_pro->quantity > 0){echo number_format($new_pro->price).' ₫';}else echo "Đã hết số lượng";?><u></u>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?endforeach;?>
			<div class="viewmore text-center">
				<a href="<?echo base_url('index.php/').'san-pham-moi'?>">
					Xem thêm bán chạy nhất
				</a>
			</div>
		</div>
	
	</div>
</div>

<!--Tin tức -->
<div class="health">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 top">
                <h3 class="float-left">Góc sức khỏe</h3>
                <a class="float-right" href="<?echo base_url('index.php/').'bai-viet'?>" style="color: #337ab7;">
                    Xem thêm <svg class="svg-inline--fa fa-chevron-right fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right"></i> -->
                </a>
            </div>
            <div class="clearfix"></div>
				<?foreach($list_news as $news):?>
                <div class="col-sm-4 col-xs-12 new1 a1">
                    <a href="<?echo base_url('index.php/').'bai-viet/'.$news->slug.'-n'.$news->id?>.html" class="chunga">
                        <div class="mau">
                            <img src="<?echo base_url('upload/news/').$news->image?>" alt="<?echo $news->name?>">
                            <div class="tren">
                                <div class="desc">
                                    <h3><?echo $news->name?></h3>
                                    <span><?echo date('d-m-Y',$news->created)?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
				<?endforeach;?>
            <div class="clearfix"></div>

            <div class="wrapper-h">
					<?foreach($list_news as $news):?>
                    <div style="width: 180px; height: 150px;display:inline-block">
                        <a href="<?echo base_url('index.php/').'bai-viet/'.$news->slug.'-n'.$news->id?>.html">
                            <img src="<?echo base_url('upload/news/').$news->image?>" alt="<?echo $news->name?>">
                            <p><?echo $news->name?></p>
                        </a>
                    </div>
					<?endforeach;?>
			</div>

            <div class="viewmore text-center">
                <a href="<?echo base_url('index.php/').'bai-viet'?>">
                    Xem thêm bài viết
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->
<div class="banner">
    <div class="container">
		<a href="#"><img alt="Nhà thuốc Long Châu" class="img1" src="<?echo public_url('img/')?>1514885463-ads-desktop.png"></a>
		<a href="#"><img alt="Nhà thuốc Long Châu" class="img2" src="<?echo public_url('img/')?>1524025120-mobile-top.png"></a>
	</div>
</div>

<!-- Cái icon phía dưới -->
<div class="group">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-xs-6 g1">
					<img src="<? echo public_url('img/')?>group-16@2x.png" alt="Luôn đủ thuốc">
					<p class="text-center">Luôn đủ thuốc</p>
				</div>
				<div class="col-sm-3 col-xs-6 g1">
					<img src="<? echo public_url('img/')?>group-17@2x.png" alt="Đổi trả dễ dàng">
					<p class="text-center">Đổi trả dễ dàng</p>
				</div>
				<div class="col-sm-3 col-xs-6 g1">
					<img src="<? echo public_url('img/')?>group-18@2x.png" alt="Giao hàng tận nơi">
					<p class="text-center">Giao hàng tận nơi</p>
				</div>
				<div class="col-sm-3 col-xs-6 g1">
					<img src="<? echo public_url('img/')?>group-19@2x.png" alt="Sản phẩm chất lượng">
					<p class="text-center">Sản phẩm chất lượng</p>
				</div>
			</div>
		</div>
	</div>
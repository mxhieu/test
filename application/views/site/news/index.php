
<main>
<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-chuyende-content">
		<div class="container">
			<div class="row r1">
				<?foreach($list_hot_news as $hot_news):?>
				<div class="img-hover">
					<div class="col-sm-6 col-xs-12 new1 a1">
						<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html" class="chunga">
							<div class="mau">
								<img src="<?echo base_url().'upload/news/'.$hot_news->image?>" alt="<?echo $hot_news->name?>">
								<div class="tren" >
									<div class="desc">
										<h3><?echo $hot_news->name?></h3>
										<span>Lúc <?echo date('h:i:s',$hot_news->created)?>, Ngày <?echo date('d/m/Y',$hot_news->created)?></span>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<?endforeach;?>
				<!--Mobile-->
				<?foreach($list_hot_news as $hot_news):?>
				<div class="slider">
					<div>
						<img src="<?echo base_url().'upload/news/'.$hot_news->image?>" alt="<?echo $hot_news->name?>">
						<div class="nd">
							<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html"><h4><?echo $hot_news->name?></h4></a>
							<span>
								Lúc <?echo date('h:i:s',$hot_news->created)?>, Ngày <?echo date('d/m/Y',$hot_news->created)?>
							</span>
							<p><?echo $hot_news->description?></p>
						</div>
					</div>
				</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
	<div class="ss-chuyende-news">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-xs-12 news-left">
					<h2>Bài viết</h2>
					
					<?if(is_array($list_news)):?>
					<?foreach($list_news as $news):?>
						<article class="t-news">
							<div class="img-hover">
								<div>
									<a href="<?echo base_url('index.php/').'bai-viet/'.$news->slug.'-n'.$news->id?>.html">
										<figure><img src="<?echo base_url().'upload/news/'.$news->image?>" alt="<?echo $news->name?>"></figure>
									</a>
								</div>
							</div>
							<a class="nw" href="<?echo base_url('index.php/').'bai-viet/'.$news->slug.'-n'.$news->id?>.html">Tin tức</a>
							<a href="<?echo base_url('index.php/bai-viet/').$news->slug.'-n'.$news->id?>.html" class="title"><h3><?echo $news->name?></h3></a>
							<span class="date">Lúc <?echo date('h:i:s',$news->created)?>, Ngày <?echo date('d/m/Y',$news->created)?></span>
							<p><?echo $news->description?></p>
						</article>
						<?endforeach;?>
						<ul class="pagination">
					
								<?echo $this->pagination->create_links()?>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											
						</ul>
				</div>
				
				<div class="col-sm-4 col-xs-12 new-right">

					<div class="wrap2 row">
						<h3>Bài nổi bật</h3>
						<?if(is_array($list_hot_news)):?>
						<?foreach($list_hot_news as $hot_news):?>
							<div class="col-sm-12 thumb">
								<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html"><img src="<?echo base_url().'upload/news/'.$hot_news->image?>" alt="<?echo $hot_news->name?>"></a>
								<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html"><h3><?echo $hot_news->name?></h3></a>
								<span>Lúc <?echo date('h:i:s',$hot_news->created)?>, Ngày <?echo date('d/m/Y',$hot_news->created)?></span>
								<p>
									<?echo $hot_news->description?>
								</p>
								<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html">Đọc tiếp</a>
							</div>
						<?endforeach;?>																																																																																																									</div>
						<?endif;?>
						<?endif;?>
				</div>
			</div>
		</div>
	</div>
</main>
	<main>
	<?$this->load->view('site/breadcrumb',$this->data)?>
	<div class="ss-chuyende-article-detail">
		<div class="container">
			<div class="row r1">
				<div class="col-sm-7 col-xs-12 col-sm-push-1 new-left post-detail">
					<div class="r1-1">
						<h1><?echo $info_news->name?></h1>
						<div class="detail">
							<p><?php echo "Lúc ".date("h:i:s",$info_news->created).', '.'Ngày '.date("d/m/Y",$info_news->created)?>
							</p>
						</div>

						<div class="list-title">
							<ul>
							<?foreach($list_related_news as $related_news):?>
								<li><a href="<?echo base_url('index.php/').'bai-viet/'.$related_news->slug.'-n'.$related_news->id?>.html"><?echo $related_news->name?></a></li>
							<?endforeach;?>
							</ul>
						</div>
						<h2><strong><?echo $info_news->description?></strong></h2>

						<?echo $info_news->content?>

						<p style="text-align:right;"><strong><?$info_news->author?></strong></p>
						<div class="clearfix"></div>
						<div class="tag">
							<i class="fas fa-tags"></i>
							<ul>
								<?echo $tag_keyword?>
							</ul>
						</div>
											</div>
					<div class="clearfix"></div>

					<div class="r1-2">
						<div class="post-bottom">
							<h3>Bài viết liên quan</h3>
							<div class="row">
							<?foreach($list_related_news as $related_news):?>
								<div class="news-item">
									<div class="thumbnail">
										<a href="<?echo base_url('index.php/').'bai-viet/'.$related_news->slug.'-n'.$related_news->id?>.html"><img src="<?echo base_url().'upload/news/'.$related_news->image?>" alt="Cần làm gì khi có cảm giác khô mắt?"></a>
										<div class="caption">
											<a href="<?echo base_url('index.php/').'bai-viet/'.$related_news->slug.'-n'.$related_news->id?>.html"><h3><?echo $related_news->name?></h3></a>
											<p>Lúc <?echo date('h:i:s',$related_news->created)?>, Ngày <?echo date('d/m/Y',$related_news->created)?> </p>
										</div>
									</div>
								</div>
							<?endforeach;?>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4 col-xs-12 col-sm-push-1 new-right">
					<div class="clearfix"></div>
					<div class="wrap2 row">
						<h3>Bài nổi bật</h3>
						<?foreach($list_hot_news as $hot_news):?>
						<div class="col-sm-12 thumb">
							<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html"><img src="<?echo base_url().'upload/news/'.$hot_news->image?>" alt="Đánh bay triệu chứng mắt khô buồn ngủ với những cách đơn giản"></a>
							<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html"><h4>Đánh bay triệu chứng mắt khô buồn ngủ với những cách đơn giản</h4></a>
							<span>Lúc <?echo date('h:i:s',$hot_news->created)?>, Ngày <?echo date('d/m/Y',$hot_news->created)?></span>
							<p>
								<?echo $hot_news->description?>
							</p>
							<a href="<?echo base_url('index.php/').'bai-viet/'.$hot_news->slug.'-n'.$hot_news->id?>.html">Đọc tiếp</a>
						</div>
						<?endforeach;?>
						
					</div>
						
				</div>
			</div>
		</div>
	</div>
</main>
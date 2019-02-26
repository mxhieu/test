<div class="carousel crs1 desktop">
	<?foreach($list_slide as $slide):?>
	<div>
		<a href="<?echo $slide->link?>">
			<img src="<?echo base_url('upload/slide/').$slide->image?>">
		</a>
	</div>
	<?endforeach;?>
</div>

<div class="carousel crs2 mobile">
<?foreach($list_slide as $slide):?>
	<div>
		<a href="#">
			<img src="<?echo base_url('upload/slide/').$slide->image?>">
		</a>
	</div>
<?endforeach;?>
</div>

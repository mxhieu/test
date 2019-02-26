<!DOCTYPE html>
<html>
<head>
	<?$this->load->view('admin/head.php')?>
</head>

<body class="sticky-header left-side-collapsed">
	<section>
		<div class="left-side sticky-left-side">
	 		<?$this->load->view('admin/menu.php')?>
	 	</div>
		
	 	<div class="main-content">
	 		<?$this->load->view('admin/header.php')?>

	 		<!--content -->
	 		<div id="page-wrapper">
	 			<?$this->load->view($temp)?>
	 		</div>
	 		<?$this->load->view('admin/footer.php')?>
	 	</div>
	</section>

	<script src="<?echo public_url("admin/")?>js/jquery.nicescroll.js"></script>
	<script src="<?echo public_url("admin/")?>js/scripts.js"></script>
	
</body>
</html>
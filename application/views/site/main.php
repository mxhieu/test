
<html>
<head>
	<?$this->load->view('site/head')?>
</head>


<!-- Your customer chat code -->

<body>
<!-- Load Facebook SDK for JavaScript -->
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&autoLogAppEvents=1&version=v3.0&appId=459572874491816';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Load Facebook SDK for JavaScript -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '1699485983451659',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.11'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/vi_VN/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-customerchat" page_id="140633999879286"></div>
	<div id="overlay-full"></div>
	<?$this->load->view('site/header')?>
	<?$this->load->view($temp)?>
	<?$this->load->view('site/footer')?>
</body>
</html>
<title><?php if (!empty($title)) echo $title.' :: '; ?> Sakukode</title>
<!-- Bootstrap -->
<?php echo add_css(array(
	'frontend/css/bootstrap.min'
));?>
<!--font-Awesome-->
	<?php echo add_css('frontend/fonts/css/font-awesome.min'); ?>
<!--font-Awesome-->
<link href='https://fonts.googleapis.com/css?family=Kreon:300,400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>assets/frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
<?php echo $css; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo $meta; ?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- start plugins -->
<?php echo add_js('frontend/js/jquery.min');?>

	<script>
		$(document).ready(function() {
			
			// this bit needs to be loaded on every page where an ajax POST may happen
		    $.ajaxSetup({
		        data: {
		            "<?php echo $this->config->item('csrf_token_name');?>": $.cookie("<?php echo $this->config->item('csrf_cookie_name');?>")
		        }
		    });

		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-57617774-1', 'auto');
		  ga('send', 'pageview');


			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();
			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
	</script>
<script src="https://www.google.com/recaptcha/api.js"></script>
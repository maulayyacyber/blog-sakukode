
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
	<!-- Head-->
	<?php echo $head; ?>
	<!--/.Head-->
	<style type="text/css">
	.recent-post li{
		font-size: 14px;
		font-weight: 600;
	}
	.recent-post li a{
		text-decoration: none;
		color: #2EB398;
	}
	.recent-post li a:hover{
		color: #3b3b3b;
	}
	.badge-tag {
		border-radius: 0;
	}
	.recent-post li{
		line-height: 30px;
	}
	.contact_right h3 {
		font-family: 'Kreon', serif;
		font-size: 24px;
		color: #ffffff;
		text-transform: capitalize;
	}
	.contact_right {
		margin-top: 7px;
	}
	.contact_right .address {
		margin-top: 12%;
	}
	.linked-post {
		text-decoration: none;
		color: #2EB398;
	}
	.linked-post h4 {
		padding-top: 10px;
	}
	</style>
</head>
<body>
<div class="header_bg" id="home"><!-- start header -->
<div class="container">
	<div class="row header text-center specials">
		<!-- navbar -->
		<?php echo $navbar; ?>
		<!--/.navbar-->
	</div>
</div>
</div>
<div class="blog"><!-- start main -->
	<div class="container">
		<div class="main row">
			<div class="col-md-8 blog_left">
				<!--Content-->
				<?php echo $content; ?>
				<!--/.Content-->
			</div>
			<div class="col-md-4 blog_right">
				<!--Sidebar-->
				<?php echo $sidebar; ?>
				<!--/.Sidebar-->
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div><!-- end main -->
<div class="footer_bg" id="contact"><!-- start footer -->
<div class="container">
	<!--Contact Form-->
	<?php echo $contact; ?>
	<!--/.Contact Form-->
</div>
</div>
<div class="footer1_bg"><!-- start footer1 -->
	<div class="container">
		<div class="row  footer">
			<div class="copy text-center">
				<p class="link"><span><?php echo company('company_name');?> &#169; All rights reserved | Template by&nbsp;<a href="http://w3layouts.com/"> W3Layouts</a></span></p>
				<a href="#home" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"> </span></a>
			</div>
		</div>
		<!-- Scripts -->
		<?php echo $script; ?>
		<!--/.Scripts-->	
	</div>
</div>
<script>
		$(document).ready(function(){
			$('pre.code').highlight({source:1, zebra:1, indent:'space', list:'ol',attribute: 'data-language'});
		});
</script>
</body>
</html>
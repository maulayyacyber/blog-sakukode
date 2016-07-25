
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
</head>
<body>
<div class="header_bg" id="home"><!-- start header -->
<div class="container">
	<div class="row header text-center specials">
		<div class="row header text-center specials">
		<!-- navbar -->
		<?php echo $navbar; ?>
		<!--/.navbar-->
	</div>
	</div>
</div>
</div>
<div class="blog"><!-- start main -->
	<div class="container">
		<div class="main row">
			<!--Content-->
			<?php echo $content; ?>
			<!--/.Content-->
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
</body>
</html>
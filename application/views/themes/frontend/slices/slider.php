<div class="wmuSlider example1"><!-- start wmuSlider example1 -->
	<div class="wmuSliderWrapper">
		<article style="position: absolute; width: 100%; opacity: 0;"> 
			<div class="slider_img text-center">
				<ul class="list-unstyled list_imgs">
					<li><img src="<?php echo base_url();?>assets/frontend/images/slider.jpg" alt="" class="responsive"/></li>
				</ul>
			</div>
		</article>
		<article style="position: relative; width: 100%; opacity: 1;"> 
			<div class="slider_img text-center">
				<ul class="list-unstyled list_imgs">
					<li><img src="<?php echo base_url();?>assets/frontend/images/slider1.jpg" alt="" class="responsive"/></li>
				</ul>
			</div>
		</article>
	</div>
	<ul class="wmuSliderPagination">
		<li><a href="#" class="">0</a></li>
		<li><a href="#" class="">1</a></li>
	</ul>
	<script src="<?php echo base_url();?>assets/frontend/js/jquery.wmuSlider.js"></script> 
	<script>
	$('.example1').wmuSlider();         
	</script>
</div><!-- end wmuSlider example1 -->
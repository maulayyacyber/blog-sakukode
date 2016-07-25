				<!--
				<ul class="ads_nav list-unstyled">
					<h4>Ads 125 x 125</h4>
						<li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="<?php echo base_url();?>assets/frontend/images/ads_pic.jpg" alt=""> </a></li>
					<div class="clearfix"></div>
				</ul> -->
				<div class="news_letter">
						<form method="GET" action="<?php echo site_url('blog/search');?>">
							<span><input type="text" name="key" placeholder="Search Post"></span>
						</form>
				</div>
				<ul class="tag_nav list-unstyled">
		        	<h4>Categories</h4>
		        	<?php
		        	$categories = category();
		        	if($categories != NULL):
		        	foreach($categories as $row):
		        	?>
		        	<li><a href="<?php echo site_url('blog/category/'.$row->category_url);?>"><?php echo $row->category_name;?></a></li>
		        	<?php
		        	endforeach;
		        	endif;
		        	?>
		        	<div class="clearfix"></div>
		        </ul>
		        <ul class="recent-post list-unstyled">
		        	<h4>Recent Posts</h4>
		        	<?php
		        	$posts = post(5);
		        	if($posts != NULL):
		        	foreach($posts as $row):
		        	$slug = generate_slug($row->updated_at,$row->article_url);
		        	?>
		        	<li><a href="<?php echo site_url($slug);?>"> <?php echo word_limiter($row->article_title,5);?></a></li>
		        	<?php
		        	endforeach;
		        	endif;
		        	?>
		        </ul>
		        <!--
				<ul class="tag_nav list-unstyled">
					<h4>tags</h4>
						<li><a href="#">art</a></li>
						<li><a href="#">awesome</a></li>
						<li><a href="#">classic</a></li>
						<li><a href="#">photo</a></li>
						<li><a href="#">wordpress</a></li>
						<li><a href="#">videos</a></li>
						<li><a href="#">standard</a></li>
						<li><a href="#">gaming</a></li>
						<li><a href="#">photo</a></li>
						<li><a href="#">music</a></li>
						<li><a href="#">data</a></li>
						<div class="clearfix"></div>
				</ul>
				<!-- start social_network_likes
				<div class="social_network_likes">
				      		 <ul class="list-unstyled">
				      		 	<li><a href="#" class="tweets"><div class="followers"><p><span>2k</span>Followers</p></div><div class="social_network"><i class="twitter-icon"> </i> </div></a></li>
				      			<li><a href="#" class="facebook-followers"><div class="followers"><p><span>5k</span>Followers</p></div><div class="social_network"><i class="facebook-icon"> </i> </div></a></li>
				      			<li><a href="#" class="email"><div class="followers"><p><span>7.5k</span>members</p></div><div class="social_network"><i class="email-icon"> </i></div> </a></li>
				      			<li><a href="#" class="dribble"><div class="followers"><p><span>10k</span>Followers</p></div><div class="social_network"><i class="dribble-icon"> </i></div></a></li>
				      			<div class="clear"> </div>
				    		</ul>
		        </div> -->
				<div class="news_letter">
					<h4>news letter</h4>
						<form>
							<span><input type="text" placeholder="Your email address"></span>
							<span  class="pull-right fa-btn btn-1 btn-1e"><input type="submit" value="subscribe"></span>
						</form>
				</div>
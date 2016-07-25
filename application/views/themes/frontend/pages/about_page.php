<div class="row about">
	<div class="col-md-3 about_img">
		<img src="<?php echo base_url();?>uploads/img/app/user-saku.jpg" alt="" class="responsive"/>
	</div>
	<div class="col-md-9 about_text">
		<h3>Welcome To Sakukode</h3>
		<p>
			<?php echo nl2br(company('profile')); ?>
		</p>
		<div class="soc_icons navbar-right">
			<ul class="list-unstyled text-center">
				<?php
				$socmeds = socmed();
				if($socmeds != NULL):
				foreach($socmeds as $row):
				?>
				<li><a href="<?php echo $row->url;?>" target="_BLANK"><i class="<?php echo $row->icon;?>"></i></a></li>
				<?php
				endforeach;
				endif;
				?>
			</ul>	
		</div>
	</div>
</div>
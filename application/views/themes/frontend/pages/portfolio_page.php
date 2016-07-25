	<h2 class="style">list of projects</h2>

	<?php
	if($portfolios != NULL):
	$i = 1;
	?>
	<div class="grids_of_4 row">
		<?php foreach($portfolios as $row): ?>
		<div class="col-md-3 images_1_of_4">
			<div class="fancyDemo">
				<a rel="group" title="" href="<?php echo base_url('uploads/img/works/full/'.$row->picture);?>"><img src="<?php echo base_url('uploads/img/works/thumb/'.$row->picture);?>" alt="<?php echo $row->portofolio_name;?>" class="img-responsive"/></a>
			</div>
			<h3><a href="<?php echo $row->url;?>"><?php echo $row->portofolio_name;?></a></h3>
			<p class="para"><?php echo $row->description;?></p>
			<h4><a href="<?php echo $row->url;?>">Live Preview</a> </h4>
		</div>
		<?php
		if($i%4 == 0):
		?>
		<div class="clear"></div>
	</div>
	<div class="grids_of_4 row">
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="clear"></div>
	</div>
	<?php
		else:
			echo "<h3>No Portfolio</h3>";
	endif;
	?>
	
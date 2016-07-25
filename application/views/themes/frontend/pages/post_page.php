
<style type="text/css">
.content-post {
	font-size: 15px !important;
}
.para a{
	font-size: 1.5em;
	color: #3b3b3b;
	text-decoration: none;
}
.para a:hover{
	color: #2EB398;
}
.para span.newest{
	float: right;
}
.keyword {
	color: #2EB398;
}
</style> 

<h2 class="style">our recent blogs</h2>
<?php
if(isset($keyword)) {
	echo "<h3>Search Results by <span class='keyword'>".$keyword."</span></h3>";
	echo "<br>";	
}

if($posts != NULL):
foreach($posts as $row): 
$slug = generate_slug($row->updated_at,$row->article_url);
?>
<div class="blog_main">
	<?php if($row->picture != ''): ?>
	<a href=""><img src="<?php echo base_url('uploads/img/blogs/full/'.$row->picture);?>" alt="<?php echo $row->article_title;?>" class="blog_img img-responsive"/></a>
	<?php endif; ?>
	<h4><a href="<?php echo site_url($slug);?>"><?php echo $row->article_title;?> </a></h4>
	<div class="blog_list pull-left">
		<ul class="list-unstyled">
			<li><i class="fa fa-calendar-o"></i><span><?php $newdate = date("F j, Y",strtotime($row->updated_at)); echo $newdate;?></span></li>
			<li><i class="fa fa-user"></i><span><?php echo $row->first_name.' '.$row->last_name;?></span></li>
			<li>
				<i class="fa fa-tags"></i>
				<span>
					<?php 
					if($row->keyword != NULL):
					$tags = explode(",", $row->keyword);
					foreach($tags as $k => $v):
					?>
					<small class="badge badge-tag"><?php echo $v;?></small>
					<?php
					endforeach;
					endif;
					?>
				</span>
			</li>
		</ul>
	</div>
	<div class="clearfix"></div>
	<div class="content-post">
		<?php 
			$content 		= read_more($row->content);
			//$content	= htmlspecialchars_decode($row->content);

			echo htmlspecialchars_decode($content);
		?>
	</div>
	<div class="read_more btm">
		<a href="<?php echo site_url($slug);?>">view more</a>
	</div>	
</div>
<!-- pagination -->
<?php 
endforeach;
	echo $pagination;
else:
?>
<div class="blog_main">
	<h3>No Post</h3>
</div>
<?php endif; ?>


		
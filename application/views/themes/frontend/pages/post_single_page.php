
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
</style> 

<?php
if($post != NULL):
?>
<h2 class="style"><?php echo $post->article_title;?></h2>
<div class="blog_main">
	<?php if($post->picture != ''): ?>
	<a href=""><img src="<?php echo base_url('uploads/img/blogs/full/'.$post->picture);?>" alt="<?php echo $post->article_title;?>" class="blog_img img-responsive"/></a>
	<?php endif; ?>
	<div class="blog_list pull-left">
		<ul class="list-unstyled">
			<li><i class="fa fa-calendar-o"></i><span><?php $newdate = date("F j, Y",strtotime($post->updated_at)); echo $newdate;?></span></li>
			<li><i class="fa fa-user"></i><span><?php echo $post->first_name.' '.$post->last_name;?></span></li>
			<li>
				<i class="fa fa-tags"></i>
				<span>
					<?php 
					if($post->keyword != NULL):
					$tags = explode(",", $post->keyword);
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
			$result = str_replace("&amp;lt;!--more--&amp;gt;", "", $post->content);
			$content = htmlspecialchars_decode($result);
			
			echo $content;
		?>	
	</div>
</div>
	<a href="#" class="btn btn-facebook btn-share btn-lg"><i class="fa fa-facebook"></i>  Share on Facebook</a>
	<a href="#" class="btn btn-twitter btn-share btn-lg"><i class="fa fa-twitter"></i>  Share on Twitter</a>
	<a href="#" class="btn btn-google btn-share btn-lg"><i class="fa fa-google-plus"></i>  Share on Google</a>
	
	<?php
	if($linkedpost != NULL):
	?>
	<div>
		<h3>Related Post</h3>
		<?php 
		foreach($linkedpost as $row):
		$slug = generate_slug($row->updated_at,$row->slug);
		?>
			<div class="media">
			  <a class="pull-left" href="#">
			  	<?php if($row->picture != NULL): ?>
			    <img class="media-object" src="<?php echo base_url('uploads/img/blogs/thumb/'.$row->picture);?>" width="70%">
				<?php else: ?>
				<img class="media-object" src="<?php echo base_url('uploads/img/blogs/thumb/default.jpg');?>" width="70%">
				<?php endif; ?>
			  </a>
			  <div class="media-body">
			    <a href="<?php echo site_url($slug);?>" class="linked-post"><h4 class="media-heading"><?php echo $row->title;?></h4></a>
			  </div>
			</div>
		<?php endforeach;?>
	</div>
	<br>
	<?php endif; ?>
	<div class="clearfif"></div>
	<div class="read_more">
		<a href="<?php echo site_url('blog');?>"><i class="fa fa-angle-left"></i> &nbsp;&nbsp;Back to Blog</a>
	</div>
<div class="blog_main">
<!-- block Comments-->
	<?php echo $disqus; ?>
<!--./comments-->
</div>
<?php 
else:
?>
<div class="blog_main">
	<h3>Post Not Found</h3>
</div>
<?php endif; ?>


		


	
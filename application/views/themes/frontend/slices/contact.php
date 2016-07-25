<style type="text/css">
.text-error {
	color: #a94442 !important;
}
.notif {
	font-size: 14px;
	border-radius: 0;
	opacity: 0.7;
}
</style>			
			<div class="row footer">
			<div class="col-md-8 contact_left">
				<h3>get in touch</h3>
				<p>In order to get in touch use the contact form below:</p>
					<?php if($this->session->flashdata('msg_success')): ?>
					<div class="alert alert-success notif"><?php echo $this->session->flashdata('msg_success');?></div>
					<?php endif; ?>
					<div class="alert alert-danger notif" id="div-error" style="display:none;border-radius:0;">
					
					</div>
					<?php 
					//$attributes = array('id' => 'contact-form');
					//echo form_open('home/send_message',$attributes); ?>
					<form method="post" id="contact-form" action="<?php echo site_url('home/send_message');?>">
						<input type="text" name="name"  placeholder="Name (Required)">
						<input type="text" name="email" placeholder="Email (Required)">
						<input type="text" name="subject" placeholder="Subject">
						<textarea name="message" placeholder="Your Message Here.."></textarea>
						<span class="pull-right"><input type="submit" value="submit us"></span>
					</form>
			</div>
			<div class="col-md-4  contact_right">
				<h3>Contact Info</h3>
					<ul class="list-unstyled address">
						<li><i class="fa fa-map-marker"></i><span> <?php echo company('address');?></span></li>
						<li><i class="fa fa-phone"></i><span> <?php echo company('hp');?></span></li>
						<li><i class="fa fa-envelope"></i><a href="#"> <?php echo company('email');?></a></li>
					</ul>
			</div>		
			</div>
<script>
$(document).ready(function() {
	$("#contact-form").submit(function(event) {
		/* Act on the event */
		$("#div-error").slideUp();
		$("#div-error").html("");
		event.preventDefault();
		$.post(this.action,$(this).serialize(), function(data) {
			/*optional stuff to do after success */
			if(data.check == false) {
				console.log(data);
				$("#div-error").html(data.msg);
				$("#div-error").slideDown();
			}else if(data.check == true) {
				location.reload();
			}else {
				
			}
		},"json");
	});
});
</script>
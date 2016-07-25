<style type="text/css">
.form-control .input-email{
    border: none !important;
    border-bottom: 2px solid #eee !important;
}
</style>

<!-- Main content -->
<section class="content">
    <!-- MAILBOX BEGIN -->
    <div class="mailbox row">
        <div class="col-xs-12">
            <div class="box box-solid" style="min-height:500px">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                            This is an example of having the box header within the box body -->
                                          
                                            <!-- compose message btn -->
                                            <a class="btn btn-block btn-primary" href="<?php echo site_url('sk-admin/contact/compose');?>"><i class="fa fa-pencil"></i> Compose Message</a>
                                            <!-- Navigation - folders-->
                                            <?php
                                                $inbox = (inbox()) ? '('.inbox().')' : '';
                                                $draft = (draft($this->ion_auth->get_user_id())) ? '('.draft($this->ion_auth->get_user_id()).')' : '';
                                                $sent = (sent($this->ion_auth->get_user_id())) ? '('.sent($this->ion_auth->get_user_id()).')' : '';
                                                $trash = (trash()) ? '('.trash().')' : '';
                                            ?>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                    <li><a href="<?php echo site_url('sk-admin/contact/inbox');?>"><i class="fa fa-inbox"></i> Inbox <?php echo $inbox; ?></a></li>
                                                    <li><a href="<?php echo site_url('sk-admin/contact/draft');?>"><i class="fa fa-pencil-square-o"></i> Drafts <?php echo $draft; ?></a></li>
                                                    <li><a href="<?php echo site_url('sk-admin/contact/sent');?>"><i class="fa fa-mail-forward"></i> Sent <?php echo $sent; ?></a></li>
                                                    <li><a href="<?php echo site_url('sk-admin/contact/trash');?>"><i class="fa fa-folder"></i> Trash <?php echo $trash; ?></a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <!--form-->
                                            <form role="form" id="form-email" method="POST" action="<?php echo site_url('sk-admin/contact/save');?>">
                                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
                                                <div class="form-group">
                                                    <input style="border:none;border-bottom:1px solid #eee" value="<?php echo $email; ?>" type="text" name="email" class="form-control" placeholder="To"/>
                                                </div>
                                                <div class="form-group">
                                                    <input style="border:none;border-bottom:1px solid #eee" value="<?php echo $subject; ?>" type="text" name="subject" class="form-control" placeholder="Subject"/>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="content" id="content-email" style="border:none;border-bottom:1px solid #eee" class="form-control" rows="10"><?php echo $content; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <div class="alert alert-danger alert-dismissable" id="error-form-email" style="display:none">
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" value="send" class="btn btn-success btn-flat">Send Email</button>
                                                    <button type="submit" name="submit" value="draft" class="btn bg-maroon btn-flat">Save as Draft</button>
                                                </div>
                                            </form>

                                            <!--end form-->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                 <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none" id="overlay-load"></div>
                                <div class="loading-img" id="animate-load" style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->

                <!-- page script -->
                <script type="text/javascript">
                $(document).ready(function() {
            
                    $("#form-email").submit(function(event) {
                        animateLoad();
                        event.preventDefault();
                        var formData = new FormData($(this)[0]);
                        clearError();
                        $.ajax({
                        url:$(this).attr("action"),
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        async: false,
                        success: function (data) {
                            if(data.status == false){
                                animateHide();
                                showError(data.msg);
                            }else if(data.status == true){
                                var url = "<?php echo site_url('sk-admin/contact');?>";
                                window.location.href = url;
                            }else{
                                animateHide();
                                alert('Error System');
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                        });
                        return false; 
                    });

                 //bootstrap WYSIHTML5 - text editor
                 $("#content-email").wysihtml5();

                 });

                function clearError()
                {
                    $("#error-form-email").html("");
                    $("#error-form-email").slideUp("fast");
                }

                function showError(msg){
                    var icon = '<i class="fa fa-times"></i>';
                    $("#error-form-email").html(icon+msg);
                    $("#error-form-email").slideDown();
                }

                function animateLoad()
                {
                    $("#overlay-load").show();
                    $("#animate-load").show();
                }

                function animateHide()
                {
                    $("#overlay-load").hide();
                    $("#animate-load").hide();
                }
                
                </script>
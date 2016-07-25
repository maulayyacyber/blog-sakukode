<script>
    $(document).ready(function(){
        var base = '<?php echo base_url("sk-admin/contact/");?>';
        var page = location.pathname;
            url = page.split('/');

            //alert(base+'/'+url[4]);
       
            $('a[href="' + base +'/'+url[4]+'"').parent('li').addClass('active');
        /**
        else if(url[2] == 'admin'){
            $('a[href="' + base + url[2] +'/'+ url[3] + '"]').parent('li').addClass('active');
        }else {
            $('a[href="' + base + url[2] +'"]').parent('li').addClass('active');
        } **/
       
    });
    </script>


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
                                            <?php
                                            if(!empty($data)): ?>
                                            <div class="table-responsive">
                                                <!-- body message-->
                                                <div class="box-body chat" id="chat-box">
                                                    <!-- message item -->
                                                    <div class="item" style="min-height:300px">
                                                        <img src="<?php echo base_url();?>uploads/img/app/avatar.jpg" alt="user image" class="img-responsive"/>
                                                       
                                                        <p class="message">
                                                            <a href="#" class="name">
                                                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo dateindo($data->date);?></small>
                                                                    <?php echo $data->subject;?> < <?php echo $data->email_to;?> >
                                                            </a>
                                                            <br>
                                                            <hr>
                                                            <br>
                                                            <?php echo htmlspecialchars_decode($data->content); ?>
                                                        </p>
                                                      
                                                    </div><!-- /.item -->
                                                    <!-- message item -->
                                                    <hr>
                                                </div><!-- /.body message -->
                                            </div>
                                            <div class="table-responsive"> 
                                                <a href="<?php echo site_url('sk-admin/contact/edit_email/'.$data->email_id);?>" class="btn btn-success btn-flat"> Edit</a>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="#" id="<?php echo $data->email_id;?>" class="btn btn-danger btn-flat btn-delete"> Delete</a>
                                            </div>
                                            <?php 
                                            else:
                                                echo "<h4> Message not found</h4>";
                                            endif; ?>
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->

                  <script>
                    $(document).ready(function() {
                        $('.btn-delete').click(function(e) {
            
                            e.preventDefault();
                            var id = $(this).attr('id');

                            swal({
                               title: "Are you sure?",
                               text: "Your will not be able to recover this data!",   
                               type: "warning",   
                               showCancelButton: true,   
                               confirmButtonColor: "#DD6B55",   
                               confirmButtonText: "Yes, delete it!",   
                               closeOnConfirm: false 
                            }, 
                            function(){

            
                                   $.ajax({
                                   type: "GET",
                                   url: "<?php echo site_url('sk-admin/contact/delete_email');?>",
                                   dataType : "json",
                                   data: "id="+id,
                                   success: function(data){
                                       if(data.status == true) {
                                           var url = "<?php echo site_url('sk-admin/contact');?>";
                                           window.location.href = url;
                                       }else if(data.status == false) {
                                           swal("Error!", data.msg, "error");
                                       }else {
                                           swal("Error!", "Error System", "error"); 
                                       }
                                   }
                                   });
                                
                            });
                        });
                    });
                </script>



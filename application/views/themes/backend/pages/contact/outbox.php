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
                            <div class="box box-solid">
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
                                             <!--notice success-->
                                            <?php
                                            if($this->session->flashdata('notif-success')):
                                            ?>
                                            <br>
                                            <div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <b>Success!</b> <?php echo $this->session->flashdata('notif-success'); ?>
                                            </div>
                                            <?php endif ?>
                                            <!--notice error-->
                                            <?php
                                            if($this->session->flashdata('notif-error')):
                                            ?>
                                            <br>
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-times"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <b>Error!</b> <?php echo $this->session->flashdata('notif-error'); ?>
                                            </div>
                                            <?php endif ?>
                                              <div class="row pad">
                                                <div class="col-sm-6">
                                                    <label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all" onkeypress="checkAll()"/>
                                                    </label>
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" id="delete-all">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <form action="#" class="text-right">
                                                        <div class="input-group">                                                            
                                                            <input type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>                                                     
                                                    </form>
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="table-responsive">
                                                <?php echo $body_content; ?>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="pull-right">
                                        <small>Showing <?php echo $start.'-'.$finish;?>/<?php echo $total; ?></small>
                                        <?php echo $pagination; ?>
                                    </div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->

<script type="text/javascript">
  $(document).ready(function() {
        $('#delete-all').click(function(e) {
            
            e.preventDefault();

            swal({
               title: "Are you sure?",
               text: "Your will not be able to recover this data!",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, delete it!",   
               closeOnConfirm: false 
            }, 
            function(isConfirm){

                if(isConfirm) {
                    var idArray = $('.table-mailbox input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                    }).get();
                
                    if(idArray != ''){
                        $.post("<?php echo site_url('sk-admin/contact/delete_many_email');?>",{data:idArray},function(data){
                        if(data.status == true)
                        {
                            location.reload();
                        }
                        },"json");
                    }else{
                        swal("Error!", "No Data selected", "error"); 
                    }
                }
            });
        });
});

</script>


 <style type="text/css">
        .box-header{
            border-bottom: 1px solid #eee !important;
        }
        .item .item-sub{
            margin-left: 50px !important;
        }
        .form-control .form-popover{
            width:120px;
        }
        .popover {
            max-width:400px;
        }
</style>
                              
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <?php
                        if(!empty($post)): ?>
                        <!-- detail post -->
                        <div class="col-xs-12" id="post">
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $post->article_title; ?></h3>
                                    <div class="box-tools pull-right">
                                        <div class="box-tools pull-right">
                                        <i class="fa fa-user"></i> <span class="text-info">by : <?php echo (!empty($post->users->username)) ? $post->users->username : 'No User';?></a></span>&nbsp;&nbsp;
                                        <i class="fa fa-calendar"></i> <?php echo dateindo($post->date); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
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
                                    <p>
                                        <?php
                                            $content = html_entity_decode($post->content);
                                            echo $content; 
                                        ?>
                                    </p>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                  <p class="text-primary">
                                    Categories : 
                                    <?php 
                                      if($categories != NULL):
                                        foreach($categories as $row):
                                    ?>
                                    <small class="badge"><?php echo $row->category_name;?></small>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?> 
                                  </p>
                                </div>
                                <div class="box-footer">
                                  <p class="text-primary">
                                    Tags :
                                  <?php
                                    if($post->keyword != NULL):
                                      $tags = explode(",", $post->keyword);
                                      foreach($tags as $k => $v):
                                  ?>
                                  <small class="badge"><?php echo $v;?></small>
                                  <?php
                                      endforeach;
                                    endif;
                                  ?>
                                  </p>
                                </div>
                                <div class="box-footer">
                                  <p class="text-primary">Linked Post</p>
                                  <table class="table">
                                    <?php
                                    if($linkedpost != NULL):
                                      foreach($linkedpost as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $row->title;?></td>
                                    </tr>
                                    <?php
                                      endforeach;
                                    endif;
                                    ?>
                                  </table>
                                </div>
                                <div class="box-footer" id="footer-post">
                                    <?php $slug = generate_slug($post->updated_at,$post->article_url); ?>
                                    <a class="btn btn-default btn-xs" href="<?php echo site_url('sk-admin/post/');?>">Back</a>
                                    <a class="btn btn-primary btn-xs" href="<?php echo site_url($slug);?>" target="_BLANK">Preview</a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('sk-admin/post/edit/'.$post->article_id);?>">Edit</a>
                                    <button class="btn btn-xs bg-purple btn-status" data-placement="top" data-toggle="popover" data-title="change status" data-container="body" type="button" data-html="true">Change status</button>
                                    <a class="btn btn-danger btn-xs btn-delete" id="<?php echo $post->article_id; ?>">Delete</a>
                                    <span class="badge bg-purple pull-right" data-toggle="tooltip" title="Status"><?php echo $post->status; ?></span>
                                    
                               
                                    <div id="popover-content" class="hide">
                                      <form class="form-inline form-status" role="form" method="POST" action="<?php echo site_url('sk-admin/post/change_status');?>">
                                        <div class="form-group">
                                          <input type="hidden" name="id" value="<?php echo $post->article_id; ?>">
                                          <select class="form-control form-popover" name="status">
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                          </select>                                  
                                        </div>
                                         <button type="submit" class="btn btn-primary bg-purple">Update</button> 
                                      </form>
                                    </div>
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>
                        <!--end post -->
                   
                        <?php
                        else:
                            echo '<div class="col-xs-12">';
                            echo '<p>post not found!.</p>';
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                </section><!-- /.content -->
                   

<script>
    $(document).ready(function(){

        $( document ).on( "click", ".btn-delete", function() {

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
            function(isConfirm){

               if(isConfirm) {
                   $.ajax({
                   type: "GET",
                   url: "<?php echo site_url('sk-admin/'.$this->router->fetch_class().'/delete');?>",
                   dataType : "json",
                   data: "id="+id,
                   success: function(data){
                       if(data.status == true) {
                            var url = "<?php echo site_url('sk-admin/'.$this->router->fetch_class()); ?>";
                            window.location.href = url;
                       }else if(data.status == false) {
                           swal("Error!", data.msg, "error");
                       }else {
                           swal("Error!", "Error System", "error"); 
                       }
                   }
                   });
               }
            });
        });



        $(".btn-status").popover({
            html: true, 
            content: function() {
                  return $('#popover-content').html();
                }
        });

        $('#footer-post').bind('.form-status','submit',function(event){
            event.preventDefault();
            $.post(this.action,$(this).serialize(), function(data) {
                console.log(this.serialize());
            },"json");
            return false;
        });


    });

function clearError()
{
    $("#error-comment").html("");
    $("#error-comment").slideUp("fast");
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-comment").html(icon+msg);
    $("#error-comment").slideDown();
}


function animateLoad()
{
    $("#overlay-load").fadeIn('fast');
    $("#animate-load").fadeIn('fast');
}

function animateHide()
{
    $("#overlay-load").fadeOut('fast');
    $("#animate-load").fadeOut('fast');
}
</script>
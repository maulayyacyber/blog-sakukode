                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                             <!-- Primary box -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">User Profile</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-info btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-info btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <?php
                                    if(!empty($data)):
                                ?>
                                <div class="box-body table-responsive no-padding">
                                     <table class="table table-hover">
                                        <?php 
                                        foreach($data as $k => $v): ?>
                                        <tr>
                                            <td width="35%"><?php echo $k; ?></td>
                                            <td width="5%">:</td>
                                            <td width ="60%"><?php echo $v; ?></td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    else:
                                        echo "<div class='box-body'><h4>Data tidak ditemukan!</h4>";
                                        endif;
                                        ?>                                        
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <?php
                                    if(!empty($data)):
                                    ?>
                                    <a href="<?php echo site_url('sk-admin/dashboard/edit-profile'); ?>" class="btn bg-olive btn-flat">Edit</a>
                                     <a href="<?php echo site_url('sk-admin/dashboard/change-password'); ?>" class="btn bg-navy btn-flat">Change Password</a>
                                    <a href="<?php echo site_url('sk-admin/dashboard');?>" class="btn btn-primary btn-flat">Go Back Dashboard</a>
                                    <?php endif; ?>
                                </div><!-- /.box-footer-->
                                 <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none"></div>
                                <div class="loading-img" style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box -->
                        </div>
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

    });
</script>
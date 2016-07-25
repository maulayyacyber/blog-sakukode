                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Edit User</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                   <?php if($check == TRUE): ?>
                                   <!-- form -->
                                   <form role="form" method="POST" id="form-user" action="<?php echo site_url('sk-admin/user/update');?>">
                                        <input type="hidden" name="user-id" id="user-id" value="<?php echo $user_id;?>"/>
                                        <!--body form-->
                                        <br />
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-user" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-user" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                        </div>
                                        <div class="row">
                                            <!-- left column form -->
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" value="<?php echo $username;?>" name="username" type="text" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <?php
                                                    $active     = ($status == 1) ? 'selected' : '';
                                                    $inactive   = ($status == 0) ? 'selected' : '';
                                                    ?>
                                                    <select class="form-control" name="active">
                                                        <option value="1" <?php echo $active;?>>ACTIVE</option>
                                                        <option value="0" <?php echo $inactive;?>>INACTIVE</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Group</label>
                                                    <select class="form-control" name="group">
                                                        <?php 
                                                        foreach($groups as $row):
                                                            if($row->id == $group_id):
                                                        ?>
                                                        <option value="<?php echo $row->id;?>" selected><?php echo $row->name;?></option>
                                                        <?php else: ?>
                                                        <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                                        <?php 
                                                            endif;
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                                
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
                                                
                                            </div><!--end right-column-form-->
                                        </div><!--end-body-form-->
                                       
                                        
                                   
                                   
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                               
                                                <button type="submit" name="submit" value="0" class="btn btn-success btn-flat">Update</button>
                                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat">Update and go back list</button>
                                                <a href="<?php echo site_url('sk-admin/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                                    
                                 </form><!-- end form -->
                                 <?php
                                   else:
                                        echo '<h4>Data tidak ditemukan!';
                                    endif;
                                    ?>
                                 </div><!-- /.box-footer-->
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="display: none" id="overlay-load"></div>
                                <div class="loading-img" id="animate-load"style="display:none"></div>
                                <!-- end loading -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->

<!-- submit form-->

<script>
$(document).ready(function(){
    $("#form-user").submit(function(event){
        event.preventDefault();
        animateLoad();
        clearError();
        clearNotif();
        var formData = new FormData($(this)[0]);
         $.ajax({
        url:$(this).attr("action"),
        type: 'POST',
        dataType: 'json',
        data: formData,
        async: false,
        success: function (data) {
           if(data.status == false){
                animateHide();
                clearNotif();
                showError(data.msg);
            }else if(data.status == true){
                if(data.load == 0){
                    animateHide();
                    if(data.clearform == true){
                      
                    }
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('sk-admin/user');?>";
                    window.location.href = url;
                }
            }  
        },
        cache: false,
        contentType: false,
        processData: false
        });
        return false;
    });
});

function clearError()
{
    $("#error-form-user").html("");
    $("#error-form-user").slideUp("fast");
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-user").html(icon+msg);
    $("#error-form-user").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-user").html(icon+msg);
    $("#success-form-user").slideDown();
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
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

function clearNotif()
{
    $("#success-form-user").html("");
    $("#success-form-user").slideUp("fast");
}
</script>
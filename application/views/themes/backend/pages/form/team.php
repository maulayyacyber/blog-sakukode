                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                        </div>
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Data</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                   <?php if($check == TRUE): ?>
                                   <!-- form -->
                                   <form role="form" method="POST" id="form-team" action="<?php echo site_url('sk-admin/team/save');?>">
                                        <input type="hidden" name="team-id" id="team-id" value="<?php echo $teamid;?>"/>
                                        <!--body form-->
                                        <br />
                                        <div class="row">
                                            <!--notif success form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-success alert-dismissable" id="success-form-team" style="display: none">
                                                    
                                                </div>
                                            </div>
                                            <!--end notif success form-->
                                            <!--notif error form-->
                                            <div class="col-xs-12">
                                                <div class="alert alert-danger alert-dismissable" id="error-form-team" style="display :none">
                                                                                                        
                                                </div>
                                            </div>
                                            <!--end notif error form-->
                                        </div>
                                        <div class="row">
                                            <!-- left column form -->
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                        <input name="fname" value="<?php echo $fname; ?>" type="text" class="form-control" placeholder="nama depan"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                        <input name="lname" value="<?php echo $lname; ?>" type="text" class="form-control" placeholder="nama belakang"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                        <input name="email" value="<?php echo $email; ?>" type="text" class="form-control" placeholder="email"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Job</label>
                                                        <input name="job" value="<?php echo $job; ?>" type="text" class="form-control" placeholder="Pekerjaan"/>
                                                </div>    
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Facebook</label>
                                                        <input name="fb" value="<?php echo $fb; ?>" type="text" class="form-control" placeholder="facebook"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Twitter</label>
                                                        <input name="twitter" value="<?php echo $twitter; ?>" type="text" class="form-control" placeholder="twitter"/>
                                                </div>
                                                <?php if(empty($teamid)): ?>
                                                <div class="form-group">
                                                    <label for="picture">Picture/Photo</label>
                                                    <input name="picture" type="file" id="">
                                                </div>
                                                <?php 
                                                else:
                                                    echo '<div class="form-group">';
                                                    echo '<label>Picture/Photo</label><br>';
                                                    echo '<p class="text-primary"><a href="'.site_url('sk-admin/team/change-picture/'.$teamid).'" data-toggle="tooltip" data-placement="top" title="change picture">'.$picture.' </a></p>';
                                                    echo '</div>';
                                                endif; ?>
                                                <div class="form-group">
                                                    <label>Testimony</label>
                                                    <textarea name="desc" class="form-control" rows="4" placeholder="Testimoni"><?php echo $desc; ?></textarea>
                                                </div>
                                            </div><!--end right-column-form-->
                                        </div><!--end-body-form-->
                                       
                                        
                                   
                                   
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                               
                                                <button type="submit" name="submit" value="0" class="btn btn-success btn-flat"><?php echo $btn_submit; ?></button>
                                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat"><?php echo $btn_submit; ?> and go back list</button>
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
    $("#form-team").submit(function(event){
        event.preventDefault();
        animateLoad();
        var formData = new FormData($(this)[0]);
        clearError();
        clearNotif();
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
            }else if(data.status == 'error-upload'){
                animateHide();
                clearNotif();
                showError(data.msg);
            }else if(data.status == true){
                if(data.load == 0){
                    animateHide();
                    if(data.clearForm == true){
                        resetForm($('#form-team'));
                    }
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('sk-admin/team');?>";
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
    $("#error-form-team").html("");
    $("#error-form-team").slideUp("fast");
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-team").html(icon+msg);
    $("#error-form-team").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-team").html(icon+msg);
    $("#success-form-team").slideDown();
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
    $("#success-form-team").html("");
    $("#success-form-team").slideUp("fast");
}
</script>
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
                               <!-- form -->
                                   <form role="form" method="POST" id="form-user" action="<?php echo site_url('sk-admin/user/save');?>">
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
                                                    <label>First Name</label>
                                                        <input name="first-name" value="" type="text" class="form-control" placeholder="Nama depan"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                        <input name="last-name" value="" type="text" class="form-control" placeholder="Nama belakang"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                        <input name="email" type="text" class="form-control" placeholder="email"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                        <input name="username" type="text" class="form-control" placeholder="username"/>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Group</label>
                                                        <select class="form-control" name="group">
                                                            <?php foreach($groups as $group): ?>
                                                            <option value="<?php echo $group->id;?>"><?php echo $group->name;?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                </div>
                                            </div><!--end left-column-form-->
                                            <!--right column form-->
                                            <div class="col-lg-6 col-xs-12">
                                                 <div class="form-group">
                                                    <label>Job</label>
                                                        <input name="job" type="text" class="form-control" placeholder="pekerjaan"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                        <input name="phone" type="text" class="form-control" placeholder="telepon"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                        <input name="password" type="password" class="form-control" placeholder="password"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                        <input name="conf-password" type="password" class="form-control" placeholder="konfirmasi password"/>
                                                </div>
                                            </div><!--end right-column-form-->
                                        </div><!--end-body-form-->
                                       
                                      
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                               
                                                <button type="submit" name="submit" value="0" class="btn btn-success btn-flat">Save</button>
                                                <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat">Save and go back list</button>
                                                <a href="<?php echo site_url('sk-admin/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                                    
                                 </form><!-- end form -->
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
                        resetForm($('#form-user'));
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
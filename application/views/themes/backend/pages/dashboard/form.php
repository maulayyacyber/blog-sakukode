<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

        </div>
        <div class="col-md-12">
            <!-- Primary box -->
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <h3 class="box-title">Form Profile</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                 <?php if($check == TRUE): ?>
                 <!-- form -->
                 <form role="form" method="POST" id="form-company" action="<?php echo site_url('sk-admin/dashboard/update_company');?>">
                    <input type="hidden" name="company-id" id="company-id" value="<?php echo $company_id;?>"/>
                    <!--body form-->
                    <br />
                    <div class="row">
                        <!--notif success form-->
                        <div class="col-xs-12">
                            <div class="alert alert-success alert-dismissable" id="success-form-company" style="display: none">
                                
                            </div>
                        </div>
                        <!--end notif success form-->
                        <!--notif error form-->
                        <div class="col-xs-12">
                            <div class="alert alert-danger alert-dismissable" id="error-form-company" style="display :none">
                                
                            </div>
                        </div>
                        <!--end notif error form-->
                    </div>
                    <div class="row">
                        <!-- left column form -->
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input name="company-name" value="<?php echo $company_name; ?>" type="text" class="form-control" placeholder="Nama Perusahaan"/>
                            </div>
                            <div class="form-group">
                                <label>Tagline</label>
                                <input name="tagline" value="<?php echo $tagline; ?>" type="text" class="form-control" placeholder="Tagline"/>
                            </div> 
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" value="<?php echo $email; ?>" type="text" class="form-control" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label>Url</label>
                                <input name="url" value="<?php echo $url; ?>" type="text" class="form-control" placeholder="Url"/>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="4" placeholder="Alamat"><?php echo $address; ?></textarea>
                            </div>    
                        </div><!--end left-column-form-->
                        <!--right column form-->
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input name="phone" id="phone" value="<?php echo $phone; ?>" type="text" class="form-control" placeholder="Telepon"/>
                            </div>
                            <div class="form-group">
                                <label>Hp</label>
                                <input id="hp" name="hp" value="<?php echo $hp; ?>" type="text" class="form-control" placeholder="Hp"/>
                            </div>
                            <div class="form-group">
                                <label>Profile</label>
                                <textarea name="profile" class="form-control" rows="4" placeholder="Profil"><?php echo $profile; ?></textarea>
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

    //$("#phone").inputmask("mask", {"mask": "(9999) -999999"}); //specifying fn & options
    //$("#hp").inputmask({"mask": "99-9999999"}); //specifying options only
    $("#form-company").submit(function(event){
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
                    showNotif(data.msg);
                }else{
                    var url = "<?php echo site_url('sk-admin/dashboard');?>";
                    window.location.href = url;
                }
            }else{
                alert('Error System');
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
    $("#error-form-company").html("");
    $("#error-form-company").slideUp("fast");
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-company").html(icon+msg);
    $("#error-form-company").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-company").html(icon+msg);
    $("#success-form-company").slideDown();
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
    $("#success-form-company").html("");
    $("#success-form-company").slideUp("fast");
}
</script>
<div class="form-box" id="login-box">
            <div class="header"><?php echo lang('login_heading');?></div>
            <?php echo form_open("auth/login");?>
                <div class="body bg-gray">
                    <p><?php echo $message;?></p>
                    <div class="form-group">
                        <label><?php echo lang('login_identity_label', 'identity');?></label>
                        <?php echo form_input($identity);?>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label><?php echo lang('login_password_label', 'password');?></label>
                        <?php echo form_input($password);?>
                        <span></span>
                    </div>        
                    <div class="form-group">
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> <?php echo lang('login_remember_label', 'remember');?>
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block"><?php echo lang('login_submit_btn');?></button>  
                    
                  
                </div>
                <?php echo form_close();?>
                <div class="margin text-center">
                    <span>&copy; Angmin Software 2014 All right reserved</span>
                 </div>
</div>
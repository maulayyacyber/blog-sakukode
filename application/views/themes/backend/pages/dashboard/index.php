
            <!-- Main content -->
            <section class="content">
                <!--notice success-->
                                <?php
                                if($this->session->flashdata('notif-success')):
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <i class="fa fa-check"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <b>Success!</b> <?php echo $this->session->flashdata('notif-success'); ?>
                                </div>
                                <?php endif ?>
              
                   <!-- Small boxes (Stat box) -->
         
                <h4 class="page-header">
                    Total Reports
                </h4>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    <?php echo $total_article; ?>
                                </h3>
                                <p>
                                    Post
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?php echo site_url('sk-admin/post');?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>
                                    <?php echo $total_product; ?>
                                </h3>
                                <p>
                                    Products
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-images"></i>
                            </div>
                            <a href="<?php echo site_url('sk-admin/product');?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>
                                    <?php echo $total_team; ?>
                                </h3>
                                <p>
                                    Our Teams
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-friends"></i>
                            </div>
                            <a href="<?php echo site_url('sk-admin/team');?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>
                                    <?php echo $total_message; ?>
                                </h3>
                                <p>
                                    Messages
                                </p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-chatbubble-working"></i>
                            </div>
                            <a href="<?php echo site_url('sk-admin/message');?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div><!-- ./col -->
                </div><!-- /.row -->

                <!-- top row -->
                <div class="row">
                    <div class="col-xs-12 connectedSortable">
                        
                    </div><!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->
                <div class="row">                       
                      <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Company Profile</h3>
                                
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <td width="200">Company Name</td>
                                        <td>:</td>
                                        <td><?php echo company('company_name');?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo company('email');?></td>
                                    </tr>
                                    <tr>
                                        <td>Website</td>
                                        <td>:</td>
                                        <td><?php echo company('url');?></td>
                                    </tr>
                                    <tr>
                                        <td>Tagline</td>
                                        <td>:</td>
                                        <td><?php echo company('tagline');?></td>
                                    </tr>
                                    <tr>
                                        <td>Adress</td>
                                        <td>:</td>
                                        <td><?php echo company('address');?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone / Hp</td>
                                        <td>:</td>
                                        <td><?php echo company('phone');?> / <?php echo company('hp');?></td>
                                    </tr>
                                    <tr>
                                        <td>Profile</td>
                                        <td>:</td>
                                        <td><?php echo nl2br(company('profile'));?></td>
                                    </tr>
                                    <tr>
                                        <td>Since </td>
                                        <td>:</td>
                                        <td><?php echo dateindo(company('date'));?></td>
                                    </tr>
                                    <tr>
                                        <td>Logo </td>
                                        <td>:</td>
                                        <td><img src="<?php echo base_url('uploads/img/logo/'.company('logo'));?>" alt="logo sakukode"/></td>
                                    </tr>

                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    </div>
                    <div class="col-xs-12">
                        <?php 
                            $id = company('company_id');
                        ?>
                        <a href="<?php echo site_url('sk-admin/dashboard/edit-company/'.$id);?>" class="btn bg-olive btn-flat">Edit Profile</a>
                        <a href="<?php echo site_url('sk-admin/dashboard/change-logo/'.$id);?>" class="btn bg-maroon btn-flat">Change Logo</a>
                    </div>
                </div><!-- /.row (main row) -->

            </section><!-- /.content -->
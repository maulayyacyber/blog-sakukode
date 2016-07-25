<a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo company('company_name');?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown tasks-menu">
                            <a href="<?php echo site_url();?>" target="_BLANK">
                                <i class="ion ion-android-earth"></i> <span>visit site</span>
                            </a>
                        </li>
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"><?php echo inbox(); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                $messages = new_messages();
                                $inbox    = (count($messages)) ? ''.count($messages).' messages' : 'no message';
                                ?>
                                <li class="header"><?php echo $inbox; ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php
                                        if(!empty($messages)):
                                            foreach($messages as $msg):
                                            if($msg->status == 'unread'):
                                        ?>
                                        <li><!-- start message -->
                                            <a href="<?php echo site_url('ang-admin/contact/view/'.$msg->message_id);?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url();?>uploads/img/app/avatar.jpg" class="img-circle" alt="<?php echo $msg->name;?>"/>
                                                </div>
                                                <h4 class="text-light-blue">
                                                    <?php echo $msg->name;?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo dateindo($msg->date);?></small>
                                                </h4>
                                                <p class="text-light-blue"><?php echo word_limiter($msg->message,5);?></p>
                                            </a>
                                        </li><!-- end message -->
                                        <?php
                                        else: ?>
                                        <li><!-- start message -->
                                            <a href="<?php echo site_url('ang-admin/contact/view/'.$msg->message_id);?>">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url();?>uploads/img/app/avatar.jpg" class="img-circle" alt="<?php echo $msg->name;?>"/>
                                                </div>
                                                <h4>
                                                    <?php echo $msg->name;?>
                                                    <small><i class="fa fa-clock-o"></i> <?php echo dateindo($msg->date);?></small>
                                                </h4>
                                                <p><?php echo word_limiter($msg->message,5);?></p>
                                            </a>
                                        </li><!-- end message -->
                                        <?php endif; endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="<?php echo site_url('ang-admin/contact');?>">See All Messages</a></li>
                            </ul>
                        </li>
                    
                    
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->ion_auth->get_user_info('username');?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <p>
                                        <?php echo $this->ion_auth->get_user_info('username');?> - <?php echo $this->ion_auth->get_user_info('job');?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('ang-admin/dashboard/user-profile');?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('auth/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
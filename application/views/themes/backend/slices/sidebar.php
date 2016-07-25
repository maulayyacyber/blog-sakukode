<!-- Sidebar user panel -->
                    <?php  
                        $id = $this->ion_auth->get_user_id();
                    ?>
                    <div class="user-panel">
                        
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->ion_auth->get_user_info('first_name');?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <?php                       
                        $groups = $this->ion_auth->get_users_groups($id)->row();
                        $group_id = $groups->id;
                        $menus = menu_group(TRUE,$group_id);
                        if(!empty($menus))
                        {
                            foreach($menus as $parent)
                            {
                                if($parent->parent_id == 0 && $parent->path != '#')
                                {
                                    echo "<li>
                                              <a href='".site_url($parent->path)."'>
                                              <i class='ion ion-ios7-folder'></i> <span>".$parent->name."</span>
                                              </a>
                                          </li>";
                                }
                                elseif($parent->parent_id == 0 && $parent->path == '#')
                                {
                                    echo "<li class='treeview'>
                                        <a href='#'>
                                        <i class='ion ion-ios7-folder'></i>
                                        <span>".$parent->name."</span>
                                        <i class='fa fa-angle-left pull-right'></i>
                                        </a>
                                        <ul class='treeview-menu'>";

                                        foreach($menus as $child)
                                        {
                                            if($child->parent_id != 0 && $child->parent_id == $parent->menu_id)
                                            {
                                                echo "<li><a href='".site_url($child->path)."'><i class='fa fa-angle-right'></i> ".$child->name."</a></li>";
                                            }
                                        }

                                        echo "</ul></li>";
                                }else
                                {

                                }
                            }
                        }
                        ?>                      
                    </ul>
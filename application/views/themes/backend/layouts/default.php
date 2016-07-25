<!DOCTYPE html>
<html>
    <head>
       <?php echo $head; ?>
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
           <?php echo $header?>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php echo $sidebar; ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">   
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url('sk-admin');?>"><i class="fa fa-dashboard"></i> home</a></li>
                        <li><a href="<?php echo site_url('sk-admin/'.$this->router->fetch_class());?>"><?php echo $this->router->fetch_class();?></a></li>
                        <?php if(!empty($this->uri->segment(3))): ?><li class="active"><?php echo $this->uri->segment(3);?></li><?php endif;?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php echo $content; ?>
                </section><!-- /.content -->             
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


       
       
        <?php echo add_js('backend/js/bootstrap.min'); ?>
        <!-- AdminLTE App -->
        <?php echo add_js('backend/js/AdminLTE/app'); ?>
        <?php echo $js; ?>
        
       <!-- Page script -->
        <script type="text/javascript">
    
        </script>
    </body>
</html>
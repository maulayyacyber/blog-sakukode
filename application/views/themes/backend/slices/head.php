        <meta charset="UTF-8">
        <title><?php if (!empty($title)) echo $title.' | '; ?> Admin by Sakukode</title>
        <?php echo chrome_frame(); ?>
        <?php echo view_port(); ?>
        <?php echo $meta; ?>
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/icons/favicon-32.ico">   
        <!-- bootstrap 3.0.2 -->
        <?php echo add_css('backend/css/bootstrap.min'); ?>
        <!-- font Awesome -->
        <?php echo add_css('backend/css/font-awesome.min'); ?>
        <!-- Ionicons -->
        <?php echo add_css('backend/css/ionicons.min'); ?>
        <!-- Theme style -->
        <?php echo add_css('backend/css/AdminLTE'); ?>
        <?php echo add_css('backend/css/sweet-alert'); ?>
        <?php echo $css; ?>

        <?php echo add_js('backend/js/vendor/jquery-1.9.1.min'); ?>
        <?php echo add_js('backend/js/sweet-alert.min'); ?>
        <!--
        <?php echo jquery('2.0.2'); ?> -->
        

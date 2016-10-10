<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords'); ?>">
    <meta name="author" content="<?php echo $__env->yieldContent('meta_author'); ?>">
    
    <!-- Styles -->
    <?php echo e(Html::style( '/css/all.css' )); ?>


    
    <?php echo $__env->yieldPushContent('styles'); ?>

    <!-- Javascript -->
    <script>
        
        // Global Javascript Variables
        var baseUrl = '<?php echo e(URL::to('/')); ?>';

        // Register Routes
        <?php if( isset($routes) ): ?>
            var routes = JSON.parse( '<?php echo json_encode( $routes ); ?>' );
        <?php endif; ?>

        // Register Token
        var csrfToken = '<?php echo e(csrf_token()); ?>';

    </script>

    <?php echo e(Html::script( '/js/all.js' )); ?>


</head>
<body class="topnav-fixed">

    <!-- WRAPPER -->
    <div id="wrapper" class="wrapper">
        
        <?php echo $__env->make( 'includes.topnav' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       
        <!-- MAIN CONTENT WRAPPER -->
        <div id="main-content-wrapper" class="content-wrapper">
            
            
            <?php echo $__env->make( 'includes.maincontent' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
            
            <?php echo $__env->make( 'includes.footer' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
        <!-- END CONTENT WRAPPER -->

    </div>

    <!-- JavaScripts -->
    <?php echo $__env->yieldPushContent( 'scripts' ); ?>
    
    <?php echo e(Html::script( '/js/script.min.js' )); ?>

    
</body>
</html>
<!DOCTYPE html>
<html lang="<?php echo e($lang); ?>" prefix="og: http://ogp.me/ns#">
<head>
<title><?php echo e($app_name); ?> &rarr; <?php echo e($page_title); ?></title>
<?php echo $__env->make('sections/head/meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('sections/head/css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->   
</head>
<body class="mobile-shift">
<?php echo $__env->make('sections/body/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/body/form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/body/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>     
<?php $__env->startSection('scripts'); ?>
<?php echo $__env->yieldSection(); ?> 
</body>
</html>

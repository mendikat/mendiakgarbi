<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $__env->yieldContent('title'); ?></title>
<?php echo $__env->make('sections/head/meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('sections/head/css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->yieldContent('css'); ?> 
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->   
</head>
<body class="mobile-shift">
<?php echo $__env->make('sections/body/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/body/featured', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/body/grid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/body/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php echo $__env->make('sections/scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>     
<?php echo $__env->yieldContent('scripts'); ?> 
</body>
</html>

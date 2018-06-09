 
<?php $__env->startSection('scripts'); ?>
<script src="resources/js/create.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($app_google_maps_key); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/simple', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
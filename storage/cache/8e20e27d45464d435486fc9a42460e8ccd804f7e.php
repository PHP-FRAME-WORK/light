
<h1> This is list </h1>

<ul>
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <li> <?php echo e($user->name); ?> </li>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul><?php /**PATH D:\LARAVEL_PROJECT\light\views/admin/order/list.blade.php ENDPATH**/ ?>
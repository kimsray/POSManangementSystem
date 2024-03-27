<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('breadcrumb'); ?>
    <li class="active">Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body text-center">
                <h1>WELCOME,</h1>
                <h2>You are logged in as CASHIER</h2>
                <br><br>
                <a href="<?php echo e(route('transaksi.baru')); ?>" class="btn btn-success btn-lg">New Transaction</a>
                <br><br><br>
            </div>
        </div>
    </div>
</div><!-- visit "codeastro" for more projects! -->
<!-- /.row (main row) -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PointofSale-Laravel\resources\views/kasir/dashboard.blade.php ENDPATH**/ ?>
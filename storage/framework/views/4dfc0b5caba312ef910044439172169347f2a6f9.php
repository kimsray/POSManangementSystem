<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
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
</div>
<!-- /.row (main row) -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/kasir/dashboard.blade.php ENDPATH**/ ?>
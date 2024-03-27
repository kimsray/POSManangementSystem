<?php $__env->startSection('title'); ?>
    Sales Transactions
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
    <li class="active">Sales Transactions</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body">
                <div class="alert alert-success alert-dismissible">
                    <i class="fa fa-check icon"></i>
                    Transaction Data has been completed.
                </div>
            </div>
            <div class="box-footer">
                <?php if($setting->tipe_nota == 1): ?>
                <button class="btn btn-warning btn-flat" onclick="notaKecil('<?php echo e(route('transaksi.nota_kecil')); ?>', 'Nota Kecil')">Print Invoice</button>
                <?php else: ?>
                <button class="btn btn-warning btn-flat" onclick="notaBesar('<?php echo e(route('transaksi.nota_besar')); ?>', 'Nota PDF')">Print Invoice</button>
                <?php endif; ?>
                <a href="<?php echo e(route('transaksi.baru')); ?>" class="btn btn-primary btn-flat">New Transaction</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // add to delete cookie innerHeight first
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
    function notaKecil(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function notaBesar(url, title) {
        popupCenter(url, title, 900, 675);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
        const dualScreenTop  = window.screenTop  !==  undefined ? window.screenTop  : window.screenY;

        const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left       = (width - w) / 2 / systemZoom + dualScreenLeft
        const top        = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow  = window.open(url, title, 
        `
            scrollbars=yes,
            width  = ${w / systemZoom}, 
            height = ${h / systemZoom}, 
            top    = ${top}, 
            left   = ${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/penjualan/selesai.blade.php ENDPATH**/ ?>
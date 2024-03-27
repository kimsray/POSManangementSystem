<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Income Report</title>

    <link rel="stylesheet" href="<?php echo e(asset('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
</head>
<body>
    <h3 class="text-center">Income Report</h3>
    <h4 class="text-center">
        Date <?php echo e(tanggal_indonesia($awal, false)); ?>

        s/d
        Date <?php echo e(tanggal_indonesia($akhir, false)); ?>

    </h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Date</th>
                <th>Sale</th>
                <th>Purchase</th>
                <th>Expenses</th>
                <th>Income</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($col); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/laporan/pdf.blade.php ENDPATH**/ ?>
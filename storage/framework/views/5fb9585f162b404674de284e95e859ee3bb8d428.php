<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Notes</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td rowspan="4" width="60%">
                <img src="<?php echo e(public_path($setting->path_logo)); ?>" alt="<?php echo e($setting->path_logo); ?>" width="120">
                <br>
                <?php echo e($setting->alamat); ?>

                <br>
                <br>
            </td>
            <td>Date</td>
            <td>: <?php echo e(tanggal_indonesia(date('Y-m-d'))); ?></td>
        </tr>
        <tr>
            <td>Member Code</td>
            <td>: <?php echo e($penjualan->member->kode_member ?? ''); ?></td>
        </tr>
    </table>

    <table class="data" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo e($key+1); ?></td>
                    <td><?php echo e($item->produk->nama_produk); ?></td>
                    <td><?php echo e($item->produk->kode_produk); ?></td>
                    <td class="text-right"><?php echo e(format_uang($item->harga_jual)); ?></td>
                    <td class="text-right"><?php echo e(format_uang($item->jumlah)); ?></td>
                    <td class="text-right"><?php echo e($item->diskon); ?></td>
                    <td class="text-right"><?php echo e(format_uang($item->subtotal)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><b>Total Price</b></td>
                <td class="text-right"><b><?php echo e(format_uang($penjualan->total_harga)); ?></b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Discount</b></td>
                <td class="text-right"><b><?php echo e(format_uang($penjualan->diskon)); ?></b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Total Pay</b></td>
                <td class="text-right"><b><?php echo e(format_uang($penjualan->bayar)); ?></b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Received</b></td>
                <td class="text-right"><b><?php echo e(format_uang($penjualan->diterima)); ?></b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Return</b></td>
                <td class="text-right"><b><?php echo e(format_uang($penjualan->diterima - $penjualan->bayar)); ?></b></td>
            </tr>
        </tfoot>
    </table>

    <table width="100%">
        <tr>
            <td><b>Thank you for shopping. We hope to see you again!</b></td>
            <td class="text-center">
                Kasir
                <br>
                <br>
                <?php echo e(auth()->user()->name); ?>

            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/penjualan/nota_besar.blade.php ENDPATH**/ ?>
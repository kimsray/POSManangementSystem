<?php $__env->startSection('title'); ?>
Income Report <?php echo e(tanggal_indonesia($tanggalAwal, false)); ?> -- <?php echo e(tanggal_indonesia($tanggalAkhir, false)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
    <li class="active">Report</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="updatePeriode()" class="btn btn-primary btn-flat"><i class="fa fa-plus-circle"></i> Change Date</button>
                <!-- <a href="<?php echo e(route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir])); ?>" target="_blank" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a> -->
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th>Date</th>
                        <th>Sale</th>
                        <th>Purchase</th>
                        <th>Expenses</th>
                        <th>Income</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if ($__env->exists('laporan.form')) echo $__env->make('laporan.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '<?php echo e(route('laporan.data', [$tanggalAwal, $tanggalAkhir])); ?>',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'penjualan'},
                {data: 'pembelian'},
                {data: 'pengeluaran'},
                {data: 'pendapatan'}
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function updatePeriode() {
        $('#modal-form').modal('show');
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/laporan/index.blade.php ENDPATH**/ ?>
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
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?php echo e($category); ?></h3>

                <p>Total Categories</p>
            </div>
            <div class="icon">
                <i class="fa fa-cube"></i>
            </div>
            <a href="<?php echo e(route('category.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col --><!-- visit "codeastro" for more projects! -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?php echo e($product); ?></h3>

                <p>Total Product</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="<?php echo e(route('product.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo e($member); ?></h3>

                <p>Total Member</p>
            </div>
            <div class="icon">
                <i class="fa fa-id-card"></i>
            </div>
            <a href="<?php echo e(route('member.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
                <h3><?php echo e($supplier); ?></h3>

                <p>Total Supplier</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <a href="<?php echo e(route('supplier.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo e($sales); ?></h3>

                <p>Sales</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="<?php echo e(route('sales.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo e($expense); ?></h3>

                <p>Total Expenses</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="<?php echo e(route('expense.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <!-- visit "codeastro" for more projects! -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo e($purchase); ?></h3>

                <p>Total Purchase</p>
            </div>
            <div class="icon">
                <i class="fa fa-dollar"></i>
            </div>
            <a href="<?php echo e(route('purchase.index')); ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <!-- visit "codeastro" for more projects! -->
</div>
<!-- Main row -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chart">
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 280px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- ChartJS -->
<script src="<?php echo e(asset('AdminLTE-2/bower_components/chart.js/Chart.js')); ?>"></script>
<script>
$(function() {
    // Get context with jQuery - using jQuery's .get() method.
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas);

    var salesChartData = {
        labels: <?php echo e(json_encode($data_date)); ?>,
        datasets: [
            {
                label: 'Income',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                
            }
        ]
    };

    var salesChartOptions = {
        pointDot : false,
        responsive : true
    };

    salesChart.Line(salesChartData, salesChartOptions);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PointofSale-Laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
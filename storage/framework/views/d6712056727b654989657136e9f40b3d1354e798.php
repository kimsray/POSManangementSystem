<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(url(auth()->user()->foto ?? '')); ?>" class="img-circle img-profil" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(auth()->user()->name); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="<?php echo e(route('dashboard')); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if(auth()->user()->level == 1): ?>
            <li class="header">MASTER</li>
            <li>
                <a href="<?php echo e(route('category.index')); ?>">
                    <i class="fa fa-cube"></i> <span>Category</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('product.index')); ?>">
                    <i class="fa fa-cubes"></i> <span>Product</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('member.index')); ?>">
                    <i class="fa fa-id-card"></i> <span>Member</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('supplier.index')); ?>">
                    <i class="fa fa-truck"></i> <span>Supplier</span>
                </a>
            </li>
            <li class="header">TRANSACTION</li>
            <li>
                <a href="<?php echo e(route('expense.index')); ?>">
                    <i class="fa fa-money"></i> <span>Expenses</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('purchase.index')); ?>">
                    <i class="fa fa-download"></i> <span>Purchase</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('sales.index')); ?>">
                    <i class="fa fa-dollar"></i> <span>Sales List</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('transaction.new')); ?>">
                    <i class="fa fa-cart-plus"></i> <span>New Transaction</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('transaction.index')); ?>">
                    <i class="fa fa-cart-arrow-down"></i> <span>Active Transaction</span>
                </a>
            </li>
            
            <li class="header">REPORT</li>
            <li>
                <a href="<?php echo e(route('report.index')); ?>">
                    <i class="fa fa-file-pdf-o"></i> <span>Income</span>
                </a>
            </li>
            <li class="header">SYSTEM</li>
            <li>
                <a href="<?php echo e(route('user.index')); ?>">
                    <i class="fa fa-users"></i> <span>User</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route("setting.index")); ?>">
                    <i class="fa fa-cogs"></i> <span>Settings</span>
                </a>
            </li>
            <?php else: ?>
            <li>
                <a href="<?php echo e(route('transaction.new')); ?>">
                    <i class="fa fa-cart-plus"></i> <span>New Transaction</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('transaction.index')); ?>">
                    <i class="fa fa-cart-arrow-down"></i> <span>Active Transaction</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside><!-- visit "codeastro" for more projects! --><?php /**PATH C:\xampp\htdocs\PointofSale-Laravel\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>
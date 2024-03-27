<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Supplier</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-supplier table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Address</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td width="5%"><?php echo e($key+1); ?></td>
                                <td><?php echo e($item->nama); ?></td>
                                <td><?php echo e($item->telepon); ?></td>
                                <td><?php echo e($item->alamat); ?></td>
                                <td>
                                    <a href="<?php echo e(route('pembelian.create', $item->id_supplier)); ?>" class="btn btn-primary btn-xs btn-flat">
                                        <i class="fa fa-check-circle"></i>
                                        Select
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\codeastro\Laravel\PointofSale-Laravel\resources\views/pembelian/supplier.blade.php ENDPATH**/ ?>
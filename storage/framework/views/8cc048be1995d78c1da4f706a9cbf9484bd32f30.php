<div class="modal fade" id="modal-member" tabindex="-1" role="dialog" aria-labelledby="modal-member">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Members</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-member table-hover">
                    <thead>
                        <th width="5%">#</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Address</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td width="5%"><?php echo e($key+1); ?></td>
                                <td><?php echo e($item->nama); ?></td>
                                <td><?php echo e($item->telepon); ?></td>
                                <td><?php echo e($item->alamat); ?></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs btn-flat"
                                        onclick="pilihMember('<?php echo e($item->id_member); ?>', '<?php echo e($item->kode_member); ?>')">
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
</div>
<!-- visit "codeastro" for more projects! --><?php /**PATH C:\xampp\htdocs\PointofSale-Laravel\resources\views/penjualan_detail/member.blade.php ENDPATH**/ ?>
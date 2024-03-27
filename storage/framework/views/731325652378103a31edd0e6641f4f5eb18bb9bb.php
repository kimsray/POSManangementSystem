<?php $__env->startSection('login'); ?>
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo">
            <!-- <a href="<?php echo e(url('/')); ?>">
                <?php if($setting && $setting->path_logo): ?>
                    <img src="<?php echo e(url($setting->path_logo)); ?>" alt="logo.png" width="100">
                <?php else: ?>
                    <img src="<?php echo e(url('/')); ?>" alt="Default Logo" width="100">
                <?php endif; ?>
            </a> -->
            POS -System
        </div>

        <form action="<?php echo e(route('login')); ?>" method="post" class="form-login">
            <?php echo csrf_field(); ?>
            <div class="form-group has-feedback <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo e(old('email')); ?>" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="help-block"><?php echo e($message); ?></span>
                <?php else: ?>
                <span class="help-block with-errors"></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group has-feedback <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="help-block"><?php echo e($message); ?></span>
                <?php else: ?>
                    <span class="help-block with-errors"></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block btn-flat">Log In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div><!-- visit "codeastro" for more projects! -->
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PointofSale-Laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>
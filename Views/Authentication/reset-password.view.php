<div class="login-box">
    <div class="login-logo">
        <a href="../index2.html"><b>Reset your password</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">We require you to reset your password.. don't worry this won't be asked again</p>
            <form action="#" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="New password" value="<?= old('password') ?>"> 
                        <div class="input-group-text"><span class="bi bi-eye"></span></div>
                    </div>
                    
                    <?php if (isset($errors['password'])) : ?>
                        <div class="invalid-feedback d-block"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" value="<?= old('confirm_password') ?>"> 
                        <div class="input-group-text"><span class="bi bi-eye"></span></div>
                    </div>
                    
                    <?php if (isset($errors['confirm_password'])) : ?>
                        <div class="invalid-feedback d-block"><?= $errors['confirm_password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>MVC PHP</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Please sign into the portal</p>
            <form action="/auth/login" method="post">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= old('email') ?>"> 
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>
                    
                    <?php if (isset($errors['email'])) : ?>
                        <div class="invalid-feedback d-block"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" />
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    <?php if (isset($errors['password'])) : ?>
                        <div class="invalid-feedback d-block"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

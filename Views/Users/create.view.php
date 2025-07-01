<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">New user</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><div class="card-title">New user</div></div>
                    <form method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="firstNameInput" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user['first_name'] ?? '' ?>">
                                <?php if (isset($errors['first_name'])) : ?>
                                    <p class="text-danger small mt-1"><?= $errors['first_name'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="lastNameInput" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user['last_name'] ?? '' ?>">
                                <?php if (isset($errors['last_name'])) : ?>
                                    <p class="text-danger small mt-1"><?= $errors['last_name'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?? '' ?>">
                                <?php if (isset($errors['email'])) : ?>
                                    <p class="text-danger small mt-1"><?= $errors['email'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/users" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">New client</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header"><div class="card-title">New client</div></div>
                    <form method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="clientNameInput" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $client['name'] ?? '' ?>">
                                <?php if (isset($errors['name'])) : ?>
                                    <p class="text-danger small mt-1"><?= $errors['name'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="clientUserIdForm" class="form-label">Owner</label>
                                <select class="form-select" id="clientUserIdForm" required="" name="user_id">
                                    <option selected="" disabled="" value="">Choose the owner</option>
                                    <?php foreach ($users as $user) : ?>
                                        <option value="<?= $user['id'] ?>"
                                            <?= ($_SESSION['user']['id'] == $user['id']) ? 'selected' : '' ?>
                                        > 
                                            <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/clients" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-content-header">
    <div class="container-fluid">
        <?php include base_path("Views/Layouts/alerts/alert.php") ?>
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Client profile</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p>Name: <?= htmlspecialchars($client['name']) ?></p>
                <p>Owned by <?= $client['user_first_name'] . ' ' . $client['user_last_name'] ?></p>

                <footer class="mt-6 d-flex gap-x-1">
                    <a href="/client/edit?id=<?= $client['id'] ?>" class="btn btn-primary">Edit client</a>
                </footer>
            </div>
        </div>
    </div>
</div>

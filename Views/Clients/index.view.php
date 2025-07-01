<div class="app-content-header">
    <div class="container-fluid">
        <?php include base_path("Views/Layouts/alerts/alert.php") ?>
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Clients</h3></div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List of clients</h3>
                        <div class="card-tools">
                            <a href="/clients/create" class="btn btn-primary">Add new client</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table" role="table">
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Owned by</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $client) : ?>
                                    <tr class="align-middle">
                                        <td><?= $client['name'] ?></td>
                                        <td><?= $client['user_first_name'] . ' ' . $client['user_last_name'] ?></td>
                                        <td>
                                            <a class="text-info-emphasis hover-underline text-decoration-none" href="/client?id=<?= $client['id'] ?>">
                                                View Profile
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

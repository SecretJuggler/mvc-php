<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline"><?= $_SESSION['user']['first_name'] ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <p>
                            <?= $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?>
                        </p>
                    </li>
                    <li class="user-footer">
                        <form method="POST" action="/logout" class="m-0">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-default btn-flat float-endt">Log out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
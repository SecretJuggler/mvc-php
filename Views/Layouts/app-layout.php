<?php
require_once 'header.php';
?>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <?php require_once 'nav/top-nav.php'; ?>
        <?php require_once 'nav/side-nav.php'; ?>
        
        <main class="app-main">
            <?= $content; ?>
        </main>
    </div>

<?php
require_once 'footer.php';
<?php if (isset($_SESSION['_flash']['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($_SESSION['_flash']['success']) ?>
    </div>
<?php endif; ?>
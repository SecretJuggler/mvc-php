<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($name) ?>!</h1>
    <p>A user has been created for you!</p>
    <p>Email: <?= htmlspecialchars($email) ?></p>
    <p>Password: <?= htmlspecialchars($password)?></p>   
    <p>When you first log in you will be asked to change your password, this is a one time thing!</p>
    <a href="<?= $_SESSION['app_base_url'] ?? '#' ?>">Log in now</a>
</body>
</html> 
<?php 

if (isset($_GET['delete'])) {
    if (unlink(__FILE__)) {
        echo "setup.php deleted. <br />";
    } else {
        echo "Could not delete setup.php. Please delete manually. <br />";
    }
    exit;
}

require 'index.php';

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$tableCheck = $db->query("SHOW TABLES LIKE 'notes'");

$table = "CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `email` varchar(255) DEFAULT NULL,
    `first_name` varchar(100) DEFAULT NULL,
    `last_name` varchar(100) DEFAULT NULL,
    `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
    `reset_password` tinyint NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_IDX` (`email`) USING BTREE
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
$db->exec($table);

$table = "CREATE TABLE `clients` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) DEFAULT NULL,
    `user_id` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
$db->exec($table);

$db->query("INSERT INTO users (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password)", [
    'first_name' => 'admin',
    'last_name' => 'admin',
    'email' => 'admin@admin.com',
    'password' => password_hash('password', PASSWORD_BCRYPT),
]); 
echo "User created <br />";
echo "Email: admin@admin.com <br />";
echo "Password: password <br />";

echo "<br><a href='?delete=1'>Click here to delete setup.php</a>";
A lightweight and straightforward Customer Relationship Management (CRM) system built with PHP.

REQUIREMENTS
PHP 8.2 or higher, 
MySQL, 
Apache Web Server, 
Composer

There is a config.php for storing database credentials and mail settings for sending emails. 

Set Up the Web Server

Make sure the project folder is accessible via your local server.

Example for Apache: point a VirtualHost to the project’s public directory.

If you use VSCode running php -S localhost:8888 -t public will work just fine. 

RUN composer install

copy .env.example and create an .env file

Will need to create a database before running the temp file.

### run temp.php

There is a temp.php file that generates users, clients table and a user record

When you log in for the first time it will request you to change the password :)
please delete the file manually if the script was unable to delete the file.

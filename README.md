<p align="center">
    <a href="https://www.php.net/" target="_blank">
        <img src="https://www.freepnglogos.com/uploads/php-logo-png/php-logo-php-elephant-logo-vectors-download-5.png"/>
    </a>
</p>

---
# Blog PHP in POO using MVC structure
# Requirements
- PHP:v7.4
- Composer:v2.0
- Apache:v2.4
- MySQL:v5.7
# Installation
* Clone repository using `git clone`
* Install dependencies using `composer install`
* Copy the blog.sql file to the sql folder in your database management system
* Update Database configuration in file DBManager.php:`self::$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'your login', 'your password');`

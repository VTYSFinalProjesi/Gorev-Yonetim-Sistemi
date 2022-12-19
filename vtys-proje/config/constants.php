<?php
    //Oturum başlatılması
    session_start();

    //Veritabanı bilgilerini kaydetmek için sabitler oluşturulması
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'task_manager');

    define('SITEURL', 'http://localhost/vtys-proje/');
?>
<?php
include "config.php";

   
    $kon =new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME.";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
    $kon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $kon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



?>
<?php
    $dsn =  'mysql:host=localhost;dbname=vglib';
    $username_db = 'php';
    $password_db = 'admin';
    
    try{
        $pdo = new PDO($dsn, $username_db, $password_db);
    }

    catch(PDOException $e){
        die("connection failed");
    }

    
   
    
    session_start();
    
    
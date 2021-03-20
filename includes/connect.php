<?php 
    $db_dsn = array( 
        'host' => 'us-cdbr-east-03.cleardb.com',
        'dbname' => 'db_LRG',
        'charset' => 'utf8'
    );

    $dsn = 'mysql:'.http_build_query($db_dsn, '', ';');

    //This is the DB credentials

    $db_user = 'b35f4ec6336ae2';
    $db_pass = '890970fb';

    try{
        $pdo = new PDO($dsn, $db_user, $db_pass);
        //var_dump($pdo);
        // echo (in this case) is almost like console.log
        // echo "you're in! enjoy the show";
    } catch (PDOException $exception){
        echo 'Connection Error:'.$exception->getMessage();
        exit();
    }
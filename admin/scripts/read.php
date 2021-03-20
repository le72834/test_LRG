<?php 
$tbl = 'tbl_user';
//get the database
function getAllData($tbl){
    $pdo = Database::getInstance()->getConnection();

    $queryData = 'SELECT * FROM tbl_user';
    $data = $pdo->query($queryData);

    if($data){
        return $data;
    }else{
        return '<p>There was a problem accessing the data</p>';
    }
};


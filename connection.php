<?php

date_default_timezone_set('Asia/Manila');

function db_connect(){

    //Connection as static to avoid connecting more than once
    static $connection;

    // Try and connect to the database, if a connection has not been established
    if(!isset($connection)){
        //load config as an array
        $config = parse_ini_file('config.ini');
        $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);

    }

    //If connection was not successful
    if($connection === false){
        return mysqli_connect_error();
    }
    return $connection;
}

function db_query($query){
    // Connect to the database
    $connection = db_connect();

    //Query the database
    $result = mysqli_query($connection, $query);

    return $result;

}

function db_error(){
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_select($query){
    $rows = array();
    $result = db_query($query);

    //If query failed, return false
    if($result === false){
        return false;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;

}

function db_quote($value){
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection, $value) . "'";
}
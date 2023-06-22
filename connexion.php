<?php
    $dbhost = "tuxa.sme.utc";
    $dbuser = 'nf92p044';
    $dbpass = '9HjRD55HJnni';
    $dbname = 'nf92p044';

    $connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die("Failed to connect mysqli");

    mysqli_set_charset($connect,'utf8');
?>
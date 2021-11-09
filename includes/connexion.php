<?php
       /*
    * Change the value of $password if you have set a password on the root userid
    * Change NULL to port number to use DBMS other than the default using port 3306
    *
    */
    $user = 'root';
    $password = ''; //To be completed if you have set a password to root
    $database = 'projet_iot'; //To be completed to connect to a database. The database must exist.
    $port = 3306; //Default must be NULL to use default port
    $mysqli = new mysqli('127.0.0.1', $user, $password, $database, $port);

    if ($mysqli->connect_error) {
        die('Connect Error(' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

?>
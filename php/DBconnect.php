<?php
/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 07.04.2016
 * Time: 22:16
 */

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$con = new mysqli($servername, $username, $password);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$con->select_db("upmoon")
or die("Could not select Database");


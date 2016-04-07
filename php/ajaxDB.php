<?php
/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 07.04.2016
 * Time: 21:22
 */

require_once "DBconnect.php";

if(isset($_POST['value'])){
    if(!is_numeric($_POST['value'])){
        return;
    }

    if($_POST['value'] > 5 || $_POST['value'] < 1){
        return;
    }

    $mood = $_POST['value'];

    $sql = "INSERT INTO mood_table (user_xid, sleep_xid, mood)
VALUES ('test', 'test', $mood)";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}else{

}


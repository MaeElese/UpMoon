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

    $user = $_POST['xid'];
    $sleep = $_POST['sleep'];
    $mood = $_POST['value'];
    $uOrI = "";

    $select = $con->prepare("SELECT mood FROM mood_table WHERE sleep_xid = ?");
    $select->bind_param('s', $sleep);

    $select->execute();

    $result = $select->get_result();
    while ($row = $result->fetch_assoc()) {
        $uOrI = $row['mood'];
    }

    if($uOrI != ""){
        $update = $con->prepare("UPDATE mood_table SET mood = ? WHERE sleep_xid = ?");
        $update->bind_param('is', $mood, $sleep);

        $update->execute();

    }else{
        $insert = $con->prepare("INSERT INTO mood_table (user_xid, sleep_xid, mood) VALUES (?, ?, ?)");
        $insert->bind_param('ssi', $user, $sleep, $mood);

        $insert->execute();
    }
}else{

}


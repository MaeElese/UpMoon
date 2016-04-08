<?php
/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 07.04.2016
 * Time: 21:22
 */

require_once "DBconnect.php";

if(isset($_POST['sleep'])){

    $user = $_POST['xid'];
    $sleep = ($_POST['sleep']);

    $select = $con->prepare("SELECT mood FROM mood_table WHERE sleep_xid = ?");
    $select->bind_param('s', $sleep);

    $select->execute();

    $result = $select->get_result();
    while ($row = $result->fetch_assoc()) {
        echo $row['mood'];
    }
}else{

}


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

    $delete = $con->prepare("DELETE FROM mood_table WHERE sleep_xid = ?");
    $delete->bind_param('s', $sleep);

    $delete->execute();
}else{

}


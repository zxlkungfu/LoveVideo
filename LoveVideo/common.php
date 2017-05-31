<?php

require_once 'sql.php';

function returnData($data, $error, $link = flase, $message = "false")
{
    if(is_object($link)) {
        closeDB($link);
    }
    $output = array("message" => $message, "error" => $error, "data" => $data);
    exit(json_encode($output));
    //    echo json_encode($output);
}


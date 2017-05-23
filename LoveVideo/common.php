<?php


function returnData($data, $error, $message = "false")
{
    $output = array("message" => $message, "error" => $error, "data" => $data);
    exit(json_encode($output));
    //    echo json_encode($output);
}


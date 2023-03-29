<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('settings.php');

    // $allArr = [];

    $sql_count = "SELECT COUNT(*) AS total FROM quotes";
    $sql_total = $conn->query($sql_count);
   

    if ($sql_total->num_rows > 0) {
        while($row_total = $sql_total->fetch_assoc()) {
            $total = $row_total['total'];
            echo $total;
        } 
    }
    $conn->close();
    // print_r($allArr);
    // echo json_encode($allArr, JSON_UNESCAPED_UNICODE);
    
?>
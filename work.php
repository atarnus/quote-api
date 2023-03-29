<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('settings.php');

    $workArr = [];
    $additions = "";

    // Get the total row count of distinct work
    $sql_count = "SELECT COUNT(DISTINCT work) AS total FROM quotes";
    $result_count = $conn->query($sql_count);
    
    if ($result_count->num_rows > 0) {
        while($row_count = $result_count->fetch_assoc()) {
            $total = $row_count['total'];
        } 
    }

    // Check if limit parameter exists and apply if the value is greater than 0
    if (isset($_GET['limit']) && $_GET['limit'] > 0) {
        $additions .= " LIMIT ".$_GET['limit'];
    // If no proper limit set, use max (offset requires limit)
    } 
    else {
        $additions .= " LIMIT ".$total+1;
    }
    // Check if offset parameter exists and apply if the value is smaller than the total rows
    if (isset($_GET['offset']) && $_GET['offset'] < $total) {
        $additions .= " OFFSET ".$_GET['offset'];
    }

    // Get the results
    $sql = "SELECT DISTINCT work FROM quotes ORDER BY work".$additions;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Output data of each row
        while($row = $result->fetch_assoc()) {

            array_push($workArr, $row["work"]);
        }
    }

    $allArr = ['total' => intval($total), 'results' => $workArr];

    $conn->close();
    // print_r($allArr);

    echo json_encode($allArr, JSON_UNESCAPED_UNICODE);
    
?>
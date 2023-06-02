<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');
    require_once('function.php');

    $search = '';
    $str = 'series';
    $total = intval(getTotalRows($conn, $str, $search));
    $add = '';

    // Check if limit parameter exists and apply if the value is greater than 0
    if (isset($_GET['limit']) && $_GET['limit'] > 0) {
        $add .= " LIMIT ".$_GET['limit'];
    // If no proper limit set, use max (offset requires limit)
    } else {
        $add .= " LIMIT ".$total+1;
    }
    // Check if offset parameter exists and apply if the value is smaller than the total rows
    if (isset($_GET['offset']) && $_GET['offset'] < $total) {
        $add .= " OFFSET ".$_GET['offset'];
    }

    // Get the author array
    $arr = listArray($conn, $str, $add);

    // Compile the printable array
    $finalArr = ['total' => $total, 'results' => $arr];
    $conn->close();

    echo json_encode($finalArr, JSON_UNESCAPED_UNICODE);
    
?>
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');
    require_once('function.php');

    $search = '';
    $str = 'char1,char2';

    $add = '';

    // Get total row count
    $sql = "SELECT COUNT(*) FROM (SELECT char1 FROM QUOTES WHERE char1 IS NOT NULL UNION SELECT char2 FROM QUOTES WHERE char2 IS NOT NULL) AS total";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $total = ($row['COUNT(*)']);
        } 
    }

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

    $arr = [];
    $sql = "SELECT char1 AS chars FROM quotes WHERE char1 IS NOT NULL UNION SELECT char2 FROM quotes WHERE char2 IS NOT NULL ORDER BY chars".$add;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Output data of each row
        while($row = $result->fetch_assoc()) {

            array_push($arr, $row['chars']);
        }
    }

    // Compile the printable array
    $finalArr = ['total' => $total, 'results' => $arr];
    $conn->close();

    echo json_encode($finalArr, JSON_UNESCAPED_UNICODE);
    
?>
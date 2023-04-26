<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');
    require_once('function.php');

    $str = 'id';
    $add = '';
    $arr = [];

    // Get max ID
    $max = intval(getMax($conn, $str));

    // Get total row count
    $total = intval(getTotalRows($conn, $str));

    // Check if offset parameter exists and apply it if the value is smaller than the max id
    if (isset($_GET['offset']) && $_GET['offset'] < $max) {
        $add .= " WHERE id>".$_GET['offset'];
    }
    // Check if limit parameter exists and apply it if the value is greater than 0
    if (isset($_GET['limit']) && $_GET['limit'] > 0) {
        $add .= " LIMIT ".$_GET['limit'];
    }

    // Get the results
    $sql = "SELECT * FROM quotes".$add; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Output data of each row
        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char1"], $row["char2"]];
            } else if ($row["char1"] != "") {
                $charArr = [$row["char1"]];
            }

            array_push($arr, ['id' => intval($row["id"]), 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr]);
        }
    }

    $conn->close();

    // Check the lowest and highest ID present on array
    $showing = $arr[0]['id']." - ".$arr[count($arr)-1]['id'];


    // Compile the printable array and encode to JSON
    $finalArr = ['total' => intval($total), 'showing ids' => $showing, 'results' => $arr];
    // print_r($finalArr);
    echo json_encode($finalArr, JSON_UNESCAPED_UNICODE);
    
?>
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('settings.php');

    $quoteArr = [];
    $additions = "";

    // Check the max id value
    $sql_max = "SELECT MAX(id) AS max FROM quotes";
    $result_max = $conn->query($sql_max);

    if ($result_max->num_rows > 0) {
        while($row_max = $result_max->fetch_assoc()) {
            $max = $row_max['max'];
        }
    }

    // Check if offset parameter exists and apply it if the value is smaller than the max id
    if (isset($_GET['offset']) && ($_GET['offset']) < $max) {
        $additions .= " WHERE id>".$_GET['offset'];
    }
    // Check if limit parameter exists and apply it if the value is greater than 0
    if (isset($_GET['limit']) && ($_GET['limit']) > 0) {
        $additions .= " LIMIT ".$_GET['limit'];
    }

    // Get the total row count of the table
    $sql_count = "SELECT COUNT(*) AS total FROM quotes";
    $result_count = $conn->query($sql_count);
   
    if ($result_count->num_rows > 0) {
        while($row_count = $result_count->fetch_assoc()) {
            $total = $row_count['total'];
        } 
    }

    // Get the results
    $sql = "SELECT * FROM quotes".$additions; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Output data of each row
        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char"], $row["char2"]];
            } else if ($row["char"] != "") {
                $charArr = [$row["char"]];
            }

            array_push($quoteArr, ['id' => intval($row["id"]), 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr]);
        }
    }

    $showing = $quoteArr[0]['id']." - ".$quoteArr[count($quoteArr)-1]['id'];
    $allArr = ['total' => intval($total), 'showing ids' => $showing, 'results' => $quoteArr];

    $conn->close();
    // print_r($allArr);

    echo json_encode($allArr, JSON_UNESCAPED_UNICODE);
    
?>
<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once('settings.php');

    $allArr = [];

    $sql = "SELECT * FROM quotes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char"], $row["char2"]];
            } else if ($row["char"] != "") {
                $charArr = [$row["char"]];
            }

            array_push($allArr, ['id' => $row["id"], 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr]);
        }
    }
    $conn->close();
    // print_r($allArr);
    echo json_encode($allArr, JSON_UNESCAPED_UNICODE);
    
?>
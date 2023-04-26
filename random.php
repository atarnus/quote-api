<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');

    $arr = [];

    $sql = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char1"], $row["char2"]];
            } else if ($row["char1"] != "") {
                $charArr = [$row["char1"]];
            }

            $arr = ['id' => intval($row["id"]), 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr];
        }
    }

    $conn->close();
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

?>
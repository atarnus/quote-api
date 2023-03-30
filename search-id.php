<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');

    $sql = "SELECT * FROM quotes WHERE id=".mysqli_real_escape_string($conn, $_GET['id']);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char"], $row["char2"]];
            } else if ($row["char"] != "") {
                $charArr = [$row["char"]];
            }

            $arr = ['id' => intval($row["id"]), 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr];
        }
    }

    $conn->close();
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

?>
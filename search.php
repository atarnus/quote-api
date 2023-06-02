<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');

    $search = '';

    if ($_GET['author']) {
        $search = " WHERE author LIKE %".mysqli_real_escape_string($conn, $_GET['author'])."%";
    } else if ($_GET['work']) {
        $search = "work".mysqli_real_escape_string($conn, $_GET['work']);
    } else if ($_GET['series']) {
        $search = "series".mysqli_real_escape_string($conn, $_GET['series']);
    } else if ($_GET['quote']) {
        $search = "quote".mysqli_real_escape_string($conn, $_GET['quote']);
    } else if ($_GET['char']) {
        $search = mysqli_real_escape_string($conn, $_GET['char']);
    }

    // id=".mysqli_real_escape_string($conn, $_GET['id'])

    $sql = "SELECT * FROM quotes".$search;
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
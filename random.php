
<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('settings.php');

    $randomArr = [];

    $sql = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {

            // No empty spaces for characters
            $charArr = [];
            if ($row["char2"] != "") {
                $charArr = [$row["char"], $row["char2"]];
            } else if ($row["char"] != "") {
                $char = 'characters';
                $charArr = [$row["char"]];
            }

            $randomArr = ['id' => $row["id"], 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $charArr];
        }
    }

    $conn->close();
    // print_r($allArr);
    echo json_encode($randomArr, JSON_UNESCAPED_UNICODE);

    // $multiArr = [];
    // array_push($multiArr, ['id' => '2', 'name' => 'Humppa', 'age' => '25']);
    // print_r($multiArr);
    // echo json_encode($multiArr);

?>
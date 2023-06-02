<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');
    require_once('function.php');

    $search = '';
    $str = 'id';
    $add = '';
    $arr = [];

    if (isset($_GET['author'])) {
        $search = " WHERE author LIKE '%".mysqli_real_escape_string($conn, $_GET['author'])."%'";
    } else if (isset($_GET['work'])) {
        $search = " WHERE work LIKE '%".mysqli_real_escape_string($conn, $_GET['work'])."%'";
    } else if (isset($_GET['series'])) {
        $search = " WHERE series LIKE '%".mysqli_real_escape_string($conn, $_GET['series'])."%'";
    } else if (isset($_GET['quote'])) {
        $search = " WHERE quote LIKE '%".mysqli_real_escape_string($conn, $_GET['quote'])."%'";
    } else if (isset($_GET['char'])) {
        $search = " WHERE (char1 LIKE '%".mysqli_real_escape_string($conn, $_GET['char'])."%' OR char2 LIKE '%".mysqli_real_escape_string($conn, $_GET['char'])."%')";
    } else if (isset($_GET['search'])) {
        $search = " WHERE concat(author,' ',work,' ',series,' ',char1,' ',char2,' ',quote) LIKE '%".mysqli_real_escape_string($conn, $_GET['search'])."%'";
    }

    // Get max ID
    $max = intval(getMax($conn, $str));

    // Get total row count
    $total = intval(getTotalRows($conn, $str, $search));

    // Check if limit parameter exists
    if (isset($_GET['limit']) && $_GET['limit'] > 0) {
        $add .= " LIMIT ".$_GET['limit'];
    } else {
        $add .= " LIMIT 1000";
    }

    // Check if offset parameter exists
    if (isset($_GET['offset']) && $_GET['offset'] < $total) {
        $add .= " OFFSET ".mysqli_real_escape_string($conn, $_GET['offset']);
    }

    // If search parameter gives 0 results, cancel it
    if ($total == 0) {
        $finalArr = ['total' => intval($total)];
    } else {
    
        // Query
        $sql = "SELECT * FROM quotes".$search.$add;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // Output data of each row
            while($row = $result->fetch_assoc()) {

                // No empty spaces for characters
                $charArr = [];
                if ($row["char2"] != "") {
                    $charArr = [$row["char1"], $row["char2"]];
                    $char = $charArr;
                } else if ($row["char1"] != "") {
                    $charArr = [$row["char1"]];
                    $char = $charArr;
                } else {
                    $char = $row["char1"];
                }

                array_push($arr, ['id' => intval($row["id"]), 'author' => $row["author"], 'work' => $row["work"], 'series' => $row["series"], 'quote' => $row["quote"], 'characters' => $char]);
            }
        }

        $conn->close();

        // Check the lowest and highest ID present on array
        $showing = $arr[0]['id']." - ".$arr[count($arr)-1]['id'];

        // Compile the printable array and encode to JSON
        $finalArr = ['total' => intval($total), 'showing ids' => $showing, 'results' => $arr];

    }
    echo json_encode($finalArr, JSON_UNESCAPED_UNICODE);
    
?>
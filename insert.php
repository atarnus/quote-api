<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    // header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');

// COLLECT AND CLEAN DATA

    // Takes raw data from the request
    $json = file_get_contents('php://input');

    // $json = '{
    //     "author" : 1,
    //     "work" : 2,
    //     "series" : 3,
    //     "char1" : 4,
    //     "char2" : "",
    //     "quote" : 6,
    //     "id" : 36
    //     }';

    // If no data object, redirect to index page (no direct entry to address)
    if (!$json) {
        header('location:index.html');
        exit();
    }

    // Converts it into a PHP object
    $data = json_decode($json, true);

    // Cleaning function for user inserts
	function clean($conn, $str) {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        $str = mysqli_real_escape_string($conn, $str);
        return $str;
    }

    // Clean user inputs
    $author = clean($conn, $data['author']);
    $work = clean($conn, $data['work']);
    $series = clean($conn, $data['series']);
    $char1 = clean($conn, $data['char1']);
    $char2 = clean($conn, $data['char2']);
    $quote = clean($conn, $data['quote']);

// BUILD SQL QUERY

    $cols = "";
    $values = "";

    if ($series !== "") {
        $cols.=", series";
        $values.=",'".$series."'";
    }
    if ($char1 !== "") {
        $cols.=", char1";
        $values.=",'".$char1."'";
    }
    if ($char2 !== "") {
        $cols.=", char2";
        $values.=",'".$char2."'";
    }

    // Create INSERT query
    $sql = "INSERT INTO quotes(author, work, quote".$cols.") VALUES('".$author."','".$work."','".$quote."'".$values.")";
    $result = $conn->query($sql);
    
    //Check whether the query was successful or not
    if($result) {
        echo json_encode('Success');
    } else {
        echo json_encode('Failed');
    }

?>
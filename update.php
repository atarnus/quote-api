<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    // header('Content-Type: application/json; charset=utf-8');
    require_once('settings.php');

// COLLECT AND CLEAN DATA

    // Takes raw data from the request
    $json = file_get_contents('php://input');
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
    $id = clean($conn, $data['id']);

// BUILD SQL QUERY

    // Optional value to SQL query
    function check($col, $val) {
        if ($val != "") {
            return ", $col = '$val'";
        } else {
            return ", $col = NULL";
        }
    }

    // Check if optional values are null
    $c_series = check('series', $series);
    $c_char1 = check('char1', $char1);
    $c_char2 = check('char2', $char2);

    // Create INSERT query
    $sql = "UPDATE quotes SET author = '$author', work = '$work', quote = '$quote'".$c_series.$c_char1.$c_char2." WHERE id='$id'";
    $result = $conn->query($sql);

    //Check whether the query was successful or not
    if($result) {
        echo json_encode('Success');
    } else {
        echo json_encode('Failed');
    }

?>
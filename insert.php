<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json; charset=utf-8');
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

// BUILD SQL QUERY

    // Optional insert to SQL query
    function check($str) {
        if ($str != "") {
            return ",".$str;
        } else {
            return $str;
        }
    }

    // Optional value to SQL query
    function pick($str) {
        if ($str != "") {
            return ",'".$str."'";
        } else {
            return $str;
        }
    }

    // Check if optional values are present and add them to SQL query
    $inserts = check($series).check($char1).check($char2);
    $values = pick($series).pick($char1).pick($char2);

    // Create INSERT query
    $sql = "INSERT INTO quotes(author, work, quote".$inserts.") VALUES('".$author."','".$work."','".$quote."'".$values.")";
    $result = $conn->query($sql);
    
    //Check whether the query was successful or not
    if($result) {
        echo json_encode('Success');
    } else {
        echo json_encode('Failed');
    }

?>
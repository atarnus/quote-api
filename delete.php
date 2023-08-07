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
        $str = mysqli_real_escape_string($conn, $str);
        return $str;
    }

    // Clean user inputs
    $id = clean($conn, $data['id']);

// BUILD SQL QUERY

    // Create DELETE query
    $sql = "DELETE FROM quotes WHERE id='$id'";
    $result = $conn->query($sql);

    //Check whether the query was successful or not
    if($result) {
        echo json_encode('Success');
    } else {
        echo json_encode('Failed');
    }

?>
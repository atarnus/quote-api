<?php

// Get the max value
function getMax($conn, $str) {
    $sql = "SELECT MAX(".$str.") AS max FROM quotes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['max'];
        }
    }
}

// Get the total row count of distinct rows
function getTotalRows($conn, $str, $search) {
    $sql = "SELECT COUNT(DISTINCT ".$str.") AS total FROM quotes".$search;
    // echo $sql;
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['total'];
        } 
    }
}

// Create a list array
function listArray($conn, $str, $add) {
    $arr = [];
    $sql = "SELECT DISTINCT ".$str." FROM quotes ORDER BY ".$str.$add;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Output data of each row
        while($row = $result->fetch_assoc()) {

            array_push($arr, $row[$str]);
        }
    }
    return $arr;
}
?>
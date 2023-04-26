<?php
	// Start session
	// session_start();
	
	// Include database connection details
	require_once('../settings.php');

    let data = {
        author: 
        work:
    }
  
  fetch('https://jsonplaceholder.typicode.com/posts', {
    method: "POST",
    body: JSON.stringify(_data),
    headers: {"Content-type": "application/json; charset=UTF-8"}
  })
  .then(response => response.json()) 
  .then(json => console.log(json));
  .catch(err => console.log(err));

    exit();
	
    // Cleaning function for user inserts
	function clean($conn, $str) {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        $str = mysqli_real_escape_string($conn, $str);
        return $str;
    }

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

	// Sanitize text field POST values
	$author = clean($conn, $_POST['author']);
	$work = clean($conn, $_POST['work']);
    $series = clean($conn, $_POST['series']);
	$char1 = clean($conn, $_POST['char1']);
    $char2 = clean($conn, $_POST['char2']);
	$quote = clean($conn, $_POST['quote']);

    // Check if optional values are present and add them to SQL query
    $inserts = check($series).check($char1).check($char2);
    $values = pick($series).pick($char1).pick($char2);

    // Create INSERT query
    $qry = "INSERT INTO quotes(author, work, quote".$inserts.") VALUES('".$author."','".$work."','".$quote."'".$values.")";
	$result = @mysqli_query($conn, $qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: added.php");
		exit();
	} else {
		die("Query failed");
	}
?>
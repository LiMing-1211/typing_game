<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "typing_game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sentence FROM sentence ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = array("sentence" => $row["sentence"]);
    echo json_encode($response);
} else {
    echo "No sentence found";
}

$conn->close();
?>

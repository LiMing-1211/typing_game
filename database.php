<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "typing_game";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 세션에 이전에 출력한 문장의 ID가 있는지 확인
$previousSentenceId = isset($_SESSION['previous_sentence_id']) ? $_SESSION['previous_sentence_id'] : 0;

// 새로운 문장 가져오기 (이전에 출력한 문장을 제외한)
$sql = "SELECT id, sentence FROM sentence WHERE id != $previousSentenceId ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newSentenceId = $row["id"];
    $response = array("id" => $newSentenceId, "sentence" => $row["sentence"]);
    
    // 현재 출력한 문장의 ID를 세션에 저장
    $_SESSION['previous_sentence_id'] = $newSentenceId;
    
    echo json_encode($response);
} else {
    echo "No sentence found";
}

$conn->close();
?>

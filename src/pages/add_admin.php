<?php
include("db_connect.php");

$userId = $_POST['user_id'];

// Siden Admin er en boolean så vil den sette 1 for TRUE også gjøre brukeren til en admin
$stmt = $conn->prepare("UPDATE users SET admin = 1 WHERE user_id = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
  echo "User promoted to admin successfully";
} else {
  echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
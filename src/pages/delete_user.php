<?php
include("db_connect.php");
// Brukeren valgt som skal bli slettet
$userId = $_POST['user_id'];

if (!$userId) {
  echo "No user ID provided";
  exit;
}
// Gjør klar til å slette brukeren
$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");

if (!$stmt) {
  echo "Error preparing statement: " . $conn->error;
  exit;
}

$stmt->bind_param("i", $userId);
// Hvisk kode kjører uten feil, så vil brukeren bli slettet
if ($stmt->execute()) {
  if ($stmt->affected_rows > 0) {
    echo "User deleted successfully";
  } else {
    echo "No user found with ID " . $userId;
  }
} else {
  echo "Error executing statement: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
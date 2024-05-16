<?php
$userId = $_GET['id'];

// Make user an admin in the database
$query = "UPDATE users SET admin = 1 WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$success = $stmt->execute();

if ($success) {
    header('Location: /admin.php'); // Redirect back to admin.php
} else {
    echo "Failed to make user admin";
}
?>
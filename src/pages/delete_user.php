<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['id'];

// Delete user from database
$query = "DELETE FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
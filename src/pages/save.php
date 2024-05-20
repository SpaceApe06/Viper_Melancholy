<?php// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$click = $_POST['totalClicks'];
	$kills = $_POST['enemiesKilled'];
  
	// Insert data into leaderboard table
	$query = "INSERT INTO stats (click, kills) VALUES (?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('ii', $click, $kills);
	$success = $stmt->execute();
  
	if (!$success) {
	  echo "Failed to save to leaderboard";
	}
  }
?>
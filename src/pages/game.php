<?php
session_start();
include("db_connect.php");

// sjekker hvis brukeren er logget inn
if(!isset($_SESSION['user_id'])) {
    echo "You are not properly logged inn";
    exit;
};
    // sjekker hvis brukeren er en admin
    $query = "SELECT admin FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST); // Check the POST data
  
	$click = $_POST['click'];
	$kills = $_POST['kills'];
	
	// Get the id of the currently logged in user
	$userId = $_SESSION['user_id'];
  
	// Check if a record for the user exists
	$stmt = $conn->prepare("SELECT stat_id FROM stats WHERE user_id = ?");
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
	  // Record exists, update it
	  $stmt = $conn->prepare("UPDATE stats SET click = ?, kills = ? WHERE user_id = ?");
	  $stmt->bind_param("iii", $click, $kills, $userId);
	} else {
	  // Record does not exist, insert a new one
	  $stmt = $conn->prepare("INSERT INTO stats (user_id, click, kills) VALUES (?, ?, ?)");
	  $stmt->bind_param("iii", $userId, $click, $kills);
	}
  
	// Execute the query
	if ($stmt->execute()) {
	  echo "Records updated successfully";
	} else {
	  echo "Error: " . $conn->error; // Check the SQL query
	}
  
	// Close the statement and connection
	$stmt->close();
	$conn->close();
	}
// 	$userId = $_SESSION['user_id'];

// 	// Prepare and bind
// 	$stmt = $conn->prepare("SELECT click FROM stats WHERE user_id = ?");
// 	$stmt->bind_param("i", $userId);
	
// 	// Execute the query
// 	$stmt->execute();
	
// 	// Bind the result to a variable
// 	$stmt->bind_result($totalClicks);
	
// 	// Fetch the result
// 	$stmt->fetch();
	
// 	// Close the statement
// 	$stmt->close();
  
//   	if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 		$click = $_POST['click'];
// 		$kills = $_POST['kills'];
		
// 		// Add the current clicks to the total clicks
// 		$totalClicks += $click;
	
// 		// Update the record with the new total clicks
// 		$stmt = $conn->prepare("UPDATE stats SET click = ?, kills = ? WHERE user_id = ?");
// 		$stmt->bind_param("iii", $totalClicks, $kills, $userId);
  
// 	// Execute the query
// 	if ($stmt->execute()) {
// 	  echo "Records updated successfully";
// 	} else {
// 	  echo "Error: " . $conn->error; // Check the SQL query
// 	}
  
// 	// Close the statement
// 	$stmt->close();
// 	} else {
// 	// If it's a GET request, return the total clicks
// 	echo $totalClicks;
// 	}
  
//   // Close the connection
//   $conn->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>game</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>	

	<body>
		        <!-- Navbar -->
			<nav id="navBar">
				<a id="navKnapp" href="/game.php">Game</a>
				<a id="navKnapp" href="/board.php">Stats</a>
				<a id="navKnapp" href="/FAQ.php">FAQ</a>
				<!-- Hvis admin så vil denne knappen til admin siden dukke opp -->
				<?php if ($user['admin'] == 1): ?>
            		<a id="navKnapp" href="/admin.php">Admin</a>
        		<?php endif; ?>
				<a id="navKnapp" href="/index.php">Log out</a>
			</nav>

			<div id=logo_container>
				<img src="public/Viper_melancholy_logo.svg" alt="Viper Melancholy logo" id="logo" height="100px">
			</div>
		<div id="game_container">

			<div id="upgrade_list"> <!--Upgrade listen -->
				<div id="upgrade_container">
					<h1>Upgrades</h1>
					<div id="upgrade_info_container">
						<p id="upgrade_name">Double clicks</p>
						<p id="upgrade_desc">when bought you will double your damage</p>
						<div id="buy_container">
							<p id="cost">Cost: 5 V-shards</p>
							<button id="buy">Buy</button>
						</div>
					</div>
				</div>
			</div>

			<div id="enemy_container">
				<div id="enemy">
					<p id="hp">HP: 100</p>
					<p id="enemyName">Enemy 1</p>
					<img id="enemyImage" src="public\enemy\enemy1.png" draggable="false">
					<p id="counter">Current clicks: 0</p>
					<!-- <p id="totalClick">Total clicks: <//?php echo $totalClicks; ?></p> -->
				</div>
			</div>

		</div>
	</body>		
<script src="\api\game.js"></script>
</html>
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

// sjekker om form dataen er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST); 
  
	$click = $_POST['click'];
	$kills = $_POST['kills'];
	
	// får id til brukeren som er logget inn akkurat nå
	$userId = $_SESSION['user_id'];
  
	// sjekker om stats eksisterer i databasen
	$stmt = $conn->prepare("SELECT stat_id FROM stats WHERE user_id = ?");
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
	  // hvis stats eksisterer vil den oppdatere stats i databasen
	  $stmt = $conn->prepare("UPDATE stats SET click = ?, kills = ? WHERE user_id = ?");
	  $stmt->bind_param("iii", $click, $kills, $userId);
	} else {
	  // hvis stats ikke eksisterer vil den legge til i databasen
	  $stmt = $conn->prepare("INSERT INTO stats (user_id, click, kills) VALUES (?, ?, ?)");
	  $stmt->bind_param("iii", $userId, $click, $kills);
	}
  
	if ($stmt->execute()) {
	  echo "Records updated successfully";
	} else {
	  echo "Error: " . $conn->error;
	}
  
	// lukker statement og connection
	$stmt->close();
	$conn->close();
	}
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
					<p id="counter">Current clicks: 0</p> <!-- trengs endring-->
				</div>
			</div>

		</div>
	</body>		
<script src="\api\game.js"></script>
</html>
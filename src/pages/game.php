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

// sjekker hvis data fra en form er POST, denne er sendt fra js scripten til denne siden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $click = $_POST['click'];
    $kills = $_POST['kills'];
    
    // henter id til brukeren som er logget inn og legger det i en variabel
    $userId = $_SESSION['user_id'];
    
    // sjekker hvis stats allerede eksisterer for brukeren
    $stmt = $conn->prepare("SELECT click, kills FROM stats WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $existingClicks = $row['click'];
        $existingKills = $row['kills'];
    } else {
        $existingClicks = 0;
        $existingKills = 0;
    }

    // legger til antall clicks og kills til de som allerede eksisterer
    // det vil kun bli lagt til en gang per session; dette er for å unngå at brukeren får flere clicks og kills for samme fiende
    if (!isset($_SESSION['clicks_added'])) {
        $totalClicks = $existingClicks + $click;
        $_SESSION['clicks_added'] = true;
    } else {
        $totalClicks = $click;
    }
    $totalKills = $existingKills + $kills;

    // hvis brukeren har stats fra før, så vil de bli oppdatert, hvis ikke så vil de bli lagt til i databasen.
    if ($row) {
        $stmt = $conn->prepare("UPDATE stats SET click = ?, kills = ? WHERE user_id = ?");
        $stmt->bind_param("iii", $totalClicks, $totalKills, $userId);
    } else {
        $stmt = $conn->prepare("INSERT INTO stats (user_id, click, kills) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $totalClicks, $totalKills);
    }
    $stmt->execute();
}

elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // henter nåværenede antall clicks fra databasen
    $stmt = $conn->prepare("SELECT click FROM stats WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo $row['click'];
    } else {
        echo "<p id='shh'>0</p>";
    }
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
                <p id="logo_text"> Vipers's Melancholy is a clicker game where you click the enemies to kill them. 
                                   Click on the enemy on the right side to kill them</p>
                <p id="logo_text">You can also buy upgrades to increase your damage to your left.</p>
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
					<p id="enemyName">Enemy 1</p>
					<p id="hp">HP: 100</p>
					<img id="enemyImage" src="public\enemy\enemy1.png" draggable="false">
					<p id="counter">Current Clicks: 0</p>
				</div>
                <p>*PROGRESS WILL ONLY BE SAVED AFTER AN ENEMY CYCLE*</p>
			</div>

		</div>
	</body>		
<script src="\api\game.js"></script>
</html>
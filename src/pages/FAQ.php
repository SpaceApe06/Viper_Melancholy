<?php
session_start();
include("db_connect.php");

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    echo "You must be logged in to join the LAN party.";
    exit;
};
    // Check if user is admin
    $query = "SELECT admin FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
?>
<html>
<head>
	<title>game</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>	
	<body>

        <nav id="navBar">
            <a id="navKnapp" href="/game.php">Game</a>
            <a id="navKnapp" href="/board.php">Leaderboard</a>
            <a id="navKnapp" href="/FAQ.php">Guide</a>
            <!-- Hvis admin så vil denne knappen til admin siden dukke opp -->
            <?php if ($user['admin'] == 1): ?>
                <a id="navKnapp" href="/admin.php">Admin</a>
            <?php endif; ?>
            <a id="navKnapp" href="/index.php">Log out</a>
        </nav>

    <h1>Frequently asked questions</h1>
        <div id="FAQ_container">
            <h2>How to play the game?</h2>
            <p>Click on the button to earn points. The more you click, the more points you earn.</p>

            <h2>What is Stats?</h2>
            <p>Stats page shows the stats of individual players based on the multiple factor such as clicks or enemies killed they have earned.</p>

            <h2>How can I become an admin?</h2>
            <p>Admin rights are granted by the game administrators. Contact the admin for more information.</p>

            <h2>How to upgrade?</h2>    
            <p>Click on the upgrade button to upgrade yoru clicker. The more you upgrade, the more powerful you become.</p>
        </div>
    <p>For any questions send an Email to Alexandermofre@gmail.com</p>
    </body>
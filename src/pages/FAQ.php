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
?>
<html>
    <head>
        <title>FAQ</title>
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
            <!-- Hvis brukeren er en admin så vil denne knappen til admin siden dukke opp -->
            <?php if ($user['admin'] == 1): ?>
                <a id="navKnapp" href="/admin.php">Admin</a>
            <?php endif; ?>
            <a id="navKnapp" href="/index.php">Log out</a>
        </nav>
        
        <div id=logo_container>
            <img src="public/Viper_melancholy_logo.svg" alt="Viper Melancholy logo" id="logo" height="100px">
        </div>

        <div id="FAQ_container">

            <!-- Video -->
            <h2>Opplæringsvideo for nettsiden</h2>
            <video id="Video" controls src="\public\Video.mp4"></video>

            <!-- FAQ -->
            <h1>Frequently asked questions (FAQ)</h1>

            <h2>How to play the game?</h2>
            <p>Click on the enemy to do damage and to earn V-shard. The more you click, the more damage.</p>

            <h2>What is V-shard?</h2>
            <p>V-shard is the currency in the game. You can use it to upgrade your clicker.</p>

            <h2>What is Stats?</h2>
            <p>Stats page shows the stats of individual players based on the such amount of clicks or enemies killed they have earned.</p>

            <h2>How can I become an admin?</h2>
            <p>Admin rights are granted by the game administrators. Contact the admin for more information.</p>

            <h2>How to upgrade?</h2>    
            <p>Click on the upgrade button to upgrade yoru clicker. The more you upgrade, the more powerful you become.</p>
        </div>

        <h2>For any questions send an email to <a href="mailto:Alexandermofre@gmail.com">Alexandermofre@gmail.com</a></h2>
    </body>
</html>
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

    $userId = $_SESSION['user_id']; // replace this with the actual ID or username of the logged in user

    $stmt = $conn->prepare("SELECT users.username, stats.* FROM stats INNER JOIN users ON stats.user_id = users.user_id WHERE stats.user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $userStats = $result->fetch_assoc();
?>
<html>
    <head>
        <title>Stats</title>
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

        <div id="board_container">
            <h1 id=board_title>Stats</h1>
            <div id="score_container">
                <div id="score_type">
                    <p>Name</p>
                    <p>Clicks</p>
                    <!-- <p>V-shard</p>
                    <p>Upgrades</p> -->
                    <p>Enemies killed</p>
                </div>

                <div id="player_score">
                    <p><?php echo $userStats['username']; ?></p>
                    <p><?php echo $userStats['click']; ?></p>
                    <p><?//php echo $userStats['v_shard']; ?></p>
                    <p><?//php echo $userStats['upgrades']; ?></p>
                    <p><?php echo $userStats['kills']; ?></p>
                </div> 
            </div>
        </div>
    </body>
</html>
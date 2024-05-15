
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
				<a id="navKnapp" href="/index.php">Log out</a>
			</nav>
			<img src="public/Viper_melancholy_logo.svg" alt="Viper Melancholy logo" id="logo" height="100px">
				<div id="game_container">
			<div id="upgrade_list"> <!--Upgrade listen -->
				<div id="upgrade_container">
					<div id="upgrade_info_container">
						<p id="upgrade_name">name</p>
						<p id="upgrade_desc">description</p>
					</div>
					<div id="buy_container">
						<p id="cost">Cost: V-shards</p>
						<button id="buy">Buy</button>
					</div>
				</div>
			</div>
			<div id="enemy_container">
				<div id="enemy">
					<p id="hp">HP: 100</p>
					<p id="enemyName">Enemy Name</p>
					<img id="enemyImage" src="public\enemy\enemy1.png" draggable="false" onclick="clickEnemy()">
					<p id="counter">Total clicks: 0</p>
				</div>
			</div>
		</div>
		</main>		
<script src="\api\game.js"></script>
</html>
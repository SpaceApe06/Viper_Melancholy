
<html>
<head>
	<title>game</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<Layout title="game">
		<body>
			<img src="/public/VIper_melancholy_logo.svg" alt="Viper Melancholy logo" id="logo" height="100px">
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
					<p id="total_hp">hp:</p>
					<p id="hp"></p>
					<p id="name"></p>
					<img id="image" draggable="false" />
				</div>
				<p id="total_click">Total clicks:</p>
				<p id="counter">0</p>
			</div>
		</div>
		</main>		
<style>

</style>
</html>
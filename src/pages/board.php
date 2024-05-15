<html>
<head>
    <title>Leaderboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</html>
    <main>
    <nav id="navBar">
        <a id="navKnapp" href="/game.php">Game</a>
        <a id="navKnapp" href="/board.php">Leaderboard</a>
        <a id="navKnapp" href="FAQ.php">Guide</a>
        <a id="navKnapp" href="/index.php">Log out</a>
    </nav>
        <div id="board_container">
            <h1 id=board_title>Leaderboard</h1>
            <div id="score_container">
                <div id="score_type">
                    <p>Name</p>
                    <p>Clicks</p>
                    <p>V-shard</p>
                    <p>Upgrades</p>
                    <p>Enemies killed</p>
                </div>
                <div id="player_score"> </div>
            </div>
        </div>
    </main>
<style>
    #board_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        border: black solid 1px;

    }
    #score_container {
        flex-direction: column;
        /* align-items: ; */
        justify-content: flex-start;
        border: 1px solid black;
        border-radius: 5px;
        width: 50%;
    }
    #score_type {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        border-bottom: 1px solid black;
    }
    #player_score {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        border-bottom: 1px solid black;
    }
</style>